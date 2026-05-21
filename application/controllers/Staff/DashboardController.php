<?php

class DashboardController extends CI_Controller {

	public function __construct(){
		parent::__construct();

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
	public function index() 
	{
		$data['title'] = "Dashboard Staff";

		// Jumlah seluruh pegawai
		$pegawai = $this->db->get('data_pegawai');
		$data['pegawai'] = $pegawai->num_rows();

		// Jumlah pegawai dengan akses staff (id_akses = 1)
		$staff = $this->db->get_where('data_pegawai', ['id_akses' => 1]);
		$data['staff'] = $staff->num_rows();

		// Jumlah jabatan
		$jabatan = $this->db->get('data_jabatan');
		$data['jabatan'] = $jabatan->num_rows();

		// Jumlah data kehadiran
		$kehadiran = $this->db->get('data_kehadiran');
		$data['kehadiran'] = $kehadiran->num_rows();

		// Load view
		$this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/dashboard', $data);
		$this->load->view('template/staff/footer');
	}

}

?>