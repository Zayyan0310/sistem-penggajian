<?php

class AbsensiController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		if ($this->session->userdata('id_akses') != '3') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('login');
		}
	}

	public function index()
	{
		$data['title'] = "Data Absensi Pegawai";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['absensi'] = $this->db->query("
			SELECT dk.*, dp.nama_pegawai
			FROM data_kehadiran dk
			JOIN data_pegawai dp ON dk.id_pegawai = dp.id_pegawai
			WHERE dk.bulantahun = '$bulantahun'  -- Ganti 'bulan' dengan 'bulantahun'
		")->result();

		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/absensi/data_absensi', $data);
		$this->load->view('template/hrd/footer');
	}

	public function input_absensi()
	{
		$data['title'] = "Form Input Absensi";

		// Handle Form POST
		if ($this->input->post('submit', TRUE) === 'submit') {
			$post = $this->input->post();
			$bulan = $post['bulan'];
			$tahun = $post['tahun'];
			$bulantahun = $bulan . $tahun;

			$simpan = [];

			foreach ($post['id_pegawai'] as $key => $id_pegawai) {
				$cek = $this->db->get_where('data_kehadiran', [
					'id_pegawai' => $id_pegawai,
					'bulantahun' => $bulantahun
				])->num_rows();

				if ($cek == 0 && $id_pegawai != '') {
					$simpan[] = [
						'bulantahun' => $bulantahun,
						'id_pegawai' => $id_pegawai,
						'hadir' => $post['hadir'][$key],
						'sakit' => $post['sakit'][$key],
						'alpha' => $post['alpha'][$key],
						'izin' => $post['izin'][$key],
						'bt' => $post['bt'][$key],
						'holiday' => $post['holiday'][$key],
					];
				}
			}

			if (empty($simpan)) {
				$this->session->set_flashdata('popup_message', [
					'tipe' => 'warning',
					'pesan' => '❗ Tidak ada data yang disimpan. Mungkin sudah pernah diinput atau form kosong.'
				]);
			} else {
				$this->db->insert_batch('data_kehadiran', $simpan);
				$this->session->set_flashdata('popup_message', [
					'tipe' => 'success',
					'pesan' => '✅ Data absensi berhasil disimpan!'
				]);
			}

			redirect("Hrd/AbsensiController/input_absensi?bulan=$bulan&tahun=$tahun");
			return;
		}

		// Default tampilan GET
		$bulan = $this->input->get('bulan');
		$tahun = $this->input->get('tahun');

		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;
		$data['bulantahun'] = null;
		$data['totalHari'] = 0;
		$data['hariKerja'] = 0;
		$data['sudah_ada'] = false;
		$data['input_absensi'] = [];

		if ($bulan && $tahun && ctype_digit($bulan) && ctype_digit($tahun)) {
			$int_bulan = (int)$bulan;
			$int_tahun = (int)$tahun;

			if ($int_bulan >= 1 && $int_bulan <= 12 && $int_tahun >= 2000) {
				$bulantahun = $bulan . $tahun;
				$data['bulantahun'] = $bulantahun;

				// Hitung total hari dan hari kerja
				$totalHari = cal_days_in_month(CAL_GREGORIAN, $int_bulan, $int_tahun);
				$hariKerja = 0;
				for ($i = 1; $i <= $totalHari; $i++) {
					$tanggal = "$tahun-$bulan-" . str_pad($i, 2, '0', STR_PAD_LEFT);
					$hari = date('N', strtotime($tanggal)); // 1=Senin, ..., 7=Minggu
					if ($hari >= 1 && $hari <= 5) {
						$hariKerja++;
					}
				}

				$data['totalHari'] = $totalHari;
				$data['hariKerja'] = $hariKerja;

				// Cek apakah data sudah ada
				$sudahAda = $this->db->get_where('data_kehadiran', [
					'bulantahun' => $bulantahun
				])->num_rows() > 0;
				$data['sudah_ada'] = $sudahAda;

				// Ambil data pegawai jika belum ada absensi bulan tsb
				if (!$sudahAda) {
					$data['input_absensi'] = $this->db->query("
						SELECT dp.*, dj.nama_jabatan 
						FROM data_pegawai dp
						INNER JOIN data_jabatan dj ON dp.id_jabatan = dj.id_jabatan
						WHERE NOT EXISTS (
							SELECT 1 FROM data_kehadiran 
							WHERE bulantahun = '$bulantahun' 
							AND dp.id_pegawai = data_kehadiran.id_pegawai
						)
						ORDER BY dp.nama_pegawai ASC
					")->result();
				}
			}
		}

		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/absensi/tambah_absensi', $data);
		$this->load->view('template/hrd/footer');
	}


	public function edit_absensi($bulan = null, $tahun = null) {
		// Cek jika bulan atau tahun tidak diberikan
		if (!$bulan || !$tahun) {
			redirect('Hrd/AbsensiController'); // Redirect jika parameter bulan atau tahun tidak ada
		}

		// Ambil data absensi berdasarkan bulan dan tahun
		$data['kehadiran'] = $this->ModelPenggajian->get_absensi_by_bulan_tahun($bulan, $tahun);

		// Set title untuk halaman
		$data['title'] = 'Edit Absensi Pegawai';
		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		// Gabungkan bulan dan tahun menjadi bulantahun
		$data['bulantahun'] = $bulan . $tahun;

		// Menampilkan halaman dengan header, sidebar, dan footer
		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/absensi/edit_absensi', $data);
		$this->load->view('template/hrd/footer');
	}

	public function update_kehadiran() 
	{
		// Ambil data yang dikirimkan dari form
		$id_kehadiran = $this->input->post('id_kehadiran');
		$id_pegawai = $this->input->post('id_pegawai');
		$sakit = $this->input->post('sakit');
		$izin = $this->input->post('izin');
		$alpha = $this->input->post('alpha');
		$bt = $this->input->post('bt');
		$hadir = $this->input->post('hadir');
		$holiday = $this->input->post('holiday');
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');

		// Gabungkan bulan dan tahun menjadi bulantahun
		$bulantahun = $bulan . $tahun;

		// Validasi input (misalnya, pastikan bulan dan tahun ada)
		if (empty($bulan) || empty($tahun)) {
			$this->session->set_flashdata('error', 'Bulan dan Tahun harus dipilih.');
			redirect('Hrd/AbsensiController/edit_absensi/'.$bulan.'/'.$tahun);
		}

		// Update data untuk setiap pegawai
		for ($i = 0; $i < count($id_kehadiran); $i++) {
			$data = [
				'sakit' => $sakit[$i],
				'izin' => $izin[$i],
				'alpha' => $alpha[$i],
				'bt' => $bt[$i],
				'hadir' => $hadir[$i],
				'holiday' => $holiday[$i],
				'bulantahun' => $bulantahun  // Mengupdate hanya kolom bulantahun
			];

			// Update data absensi ke database
			$this->ModelPenggajian->update_kehadiran($id_kehadiran[$i], $id_pegawai[$i], $data);
		}

		// Set flash message dan redirect setelah update
		$this->session->set_flashdata('success', 'Data absensi berhasil diperbarui.');
		redirect('Hrd/AbsensiController');
	}










}
