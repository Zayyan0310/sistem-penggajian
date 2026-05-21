<?php

class LaporanLemburController extends CI_Controller {

	public function __construct(){
		parent::__construct();

		// Hanya role dengan id_akses 3 (misalnya HRD) yang boleh akses
		if($this->session->userdata('id_akses') != '1'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('LoginController');
		}
	}

	public function index() {
		$data['title'] = "Laporan Lembur Pegawai";

		$this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/laporan/laporan_lembur');
		$this->load->view('template/staff/footer');
	}

	public function cetak_laporan_lembur() {
		$data['title'] = "Cetak Laporan Lembur Pegawai";

		if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan . $tahun;
		} else {
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan . $tahun;
		}

		$data['bulan'] = $bulan;
		$data['tahun'] = $tahun;

		// Ambil data lembur berdasarkan bulantahun
		$data['lap_lembur'] = $this->db->query("
			SELECT l.*, p.nama_pegawai
			FROM data_lembur l
			INNER JOIN data_pegawai p ON l.id_pegawai = p.id_pegawai
			WHERE l.bulantahun = '$bulantahun'
			ORDER BY p.nama_pegawai ASC
		")->result();

		if (empty($data['lap_lembur'])) {
			$this->session->set_flashdata('failed', 'Data lembur kosong, silakan input data lembur.');
			return redirect('Staff/LaporanLemburController');
		}

		$this->load->view('template/staff/header', $data);
		$this->load->view('staff/laporan/cetak_lembur', $data);
	}
}
?>
