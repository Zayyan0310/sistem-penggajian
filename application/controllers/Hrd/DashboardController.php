<?php

class DashboardController extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('id_akses') != '3'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
		$pegawai = $this->db->query("SELECT * FROM data_pegawai");
		$akses_hrd = $this->db->query("SELECT * FROM data_pegawai WHERE id_akses = '3'");
		$jabatan = $this->db->query("SELECT * FROM data_jabatan");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
		
		$data['title'] = "Dashboard HRD";
		$data['pegawai'] = $pegawai->num_rows();
		$data['total_hrd'] = $akses_hrd->num_rows();
		$data['jabatan'] = $jabatan->num_rows();
		$data['kehadiran'] = $kehadiran->num_rows();

		$this->load->view('template/hrd/header',$data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/dashboard', $data);
		$this->load->view('template/hrd/footer');
	}
}

?>