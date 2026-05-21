<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

	public function index()
	{
		$this->_rules();

		if ($this->form_validation->run() == FALSE) {
			$this->load->view('login');
		} else {
			$username = $this->input->post('username');
			$password = $this->input->post('password');

			$cek = $this->ModelPenggajian->cek_login($username, $password);

			if ($cek == FALSE) {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Username atau Password Salah!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('LoginController');
			} else {
				// Simpan data ke session
				$this->session->set_userdata([
					'id_pegawai'     => $cek->id_pegawai,
					'nama_pegawai'   => $cek->nama_pegawai,
					'id_akses'       => $cek->id_akses,
					'photo'          => $cek->photo,
					'nik'            => $cek->nik
				]);

				// Arahkan berdasarkan hak akses
				switch ($cek->id_akses) {
					case 1:
						redirect('Staff/DashboardController');
						break;
					case 2:
						redirect('Pegawai/DashboardController');
						break;
					case 3:
						redirect('Hrd/DashboardController');
						break;
					default:
						redirect('LoginController');
						break;
				}
			}
		}
	}

	public function _rules()
	{
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('LandingPageController');
	}
}
