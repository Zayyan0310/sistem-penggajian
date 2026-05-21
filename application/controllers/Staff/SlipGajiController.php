<?php

class SlipGajiController extends CI_Controller
{
	/**
	 * @var Pdfgenerator
	 */
	public $pdfgenerator;

	/**
	 * @var CI_Email
	 */
	public $email;

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('id_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('LoginController');
		}
	}

		private function hitungHariKerja($bulan, $tahun) {
		$jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
		$hariKerja = 0;

		for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++) {
			$tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal);
			$hari = date('N', strtotime($tgl)); // 1=Senin, 7=Minggu

			if ($hari < 6) { // Senin–Jumat
				$hariKerja++;
			}
		}

		return $hariKerja;
	}


	public function index()
	{
		$data['title'] = "Slip Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

		$this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/gaji/slip_gaji', $data);
		$this->load->view('template/staff/footer');
	}

	public function proses_slip_gaji()
	{
		$aksi = $this->input->post('aksi');

		if ($aksi == 'cetak') {
			$this->cetak_slip_gaji();
		} elseif ($aksi == 'email') {
			$this->kirim_slip_gaji();
		} else {
			show_error('Aksi tidak dikenali');
		}
	}

	public function cetak_slip_gaji()
	{
		$nama = $this->input->post('nama_pegawai');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulantahun = $bulan . $tahun;

		$data['title'] = "Cetak Slip Gaji";

		// Ambil data slip gaji dari tabel data_gaji yang sudah diproses
		$slip = $this->db->query("
			SELECT 
				g.*, p.nik, p.nama_pegawai, p.namabank, p.norekening, 
				j.nama_jabatan
			FROM data_gaji g
			JOIN data_pegawai p ON g.id_pegawai = p.id_pegawai
			JOIN data_jabatan j ON p.id_jabatan = j.id_jabatan
			WHERE p.nama_pegawai = ? AND g.bulantahun = ?
			LIMIT 1
		", [$nama, $bulantahun])->row();

		// Jika tidak ditemukan
		if (!$slip) {
			$this->session->set_flashdata('failed', 'Data gaji kosong, silakan input data kehadiran pada bulan dan tahun yang Anda pilih.');
			redirect('Staff/SlipGajiController');
			return;
		}

		// Kirim langsung ke view (tanpa hitung ulang)
		$data['slip'] = $slip;

		$this->load->view('template/staff/header', $data);
		$this->load->view('staff/gaji/cetak_slip_gaji', $data);
	}


	public function kirim_slip_gaji()
	{
		$this->load->library('pdfgenerator');
		$this->load->library('email');

		$nama = $this->input->post('nama_pegawai');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');
		$bulantahun = $bulan . $tahun;

		$data['title'] = "Slip Gaji Pegawai";
		$data['hariKerja'] = $this->hitungHariKerja((int)$bulan, (int)$tahun);

		$semuaGaji = $this->ModelPenggajian->getSlipGajiByBulanTahun($bulantahun);
		$slip = null;

		foreach ($semuaGaji as $gaji) {
			if ($gaji->nama_pegawai == $nama) {
				$slip = $gaji;
				$data['slip'] = $gaji;
				break;
			}
		}

		if (!$slip) {
			$this->session->set_flashdata('failed', 'Data slip tidak ditemukan');
			return redirect('Staff/SlipGajiController');
		}

		$lembur = $slip->jumlah_lembur * $slip->tarif_lembur;
		$potonganAlpha = $data['hariKerja'] > 0 ? ($slip->alpha / $data['hariKerja']) * $slip->gaji_pokok : 0;
		$bpjs = $slip->gaji_pokok * 0.03;
		$gaji_bruto = $slip->gaji_pokok + $slip->tj_transport + $slip->uang_makan + $lembur;

		$pegawai = $this->ModelPenggajian->get_data_where('data_pegawai', ['nama_pegawai' => $nama])->row();
		$pph21 = 0;

		if ($pegawai) {
			$pajak = $this->db->query("
				SELECT tarif_TER FROM data_pajak
				WHERE id_pajak = ? AND ? BETWEEN range_awal AND range_akhir
				LIMIT 1
			", [$pegawai->id_pajak, $gaji_bruto])->row();

			if ($pajak) {
				$pph21 = $gaji_bruto * ($pajak->tarif_TER / 100);
			}
		}

		$total_potongan = $potonganAlpha + $bpjs + $pph21;
		$gaji_bersih = $gaji_bruto - $total_potongan;

		$data['lembur'] = $lembur;
		$data['potongan_alpha'] = $potonganAlpha;
		$data['bpjs'] = $bpjs;
		$data['pph21'] = $pph21;
		$data['gaji_bruto'] = $gaji_bruto;
		$data['total_potongan'] = $total_potongan;
		$data['gaji_bersih'] = $gaji_bersih;

		$html = $this->load->view('staff/gaji/cetak_slip_gaji', $data, true);
		$pdf_content = $this->pdfgenerator->generate($html, 'slip.gaji', false);

		$config = include(APPPATH . 'config/email.php');
		$this->email->initialize($config);
		$this->email->from($config['from_email'], $config['from_name']);
		$this->email->to($slip->email); // <-- pastikan email tidak null
		$this->email->subject('Slip Gaji ' . $bulan . '-' . $tahun);
		$this->email->message('Berikut terlampir slip gaji Anda.');
		$this->email->attach($pdf_content, 'attachment', 'Slip_Gaji_'.$nama.'.pdf', 'application/pdf');

		if ($this->email->send()) {
			$this->session->set_flashdata('pesan', 'Slip gaji berhasil dikirim ke email!');
			return redirect('Staff/SlipGajiController');
		}

		echo $this->email->print_debugger(['headers']); // Tampilkan error jika gagal
		exit;
	}


}
