<?php

class GantiPasswordController extends CI_Controller {

	public function index() 
	{
		$data['title'] = "Form Ganti Password";

		$this->load->view('template/hrd/header',$data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/ganti_password', $data);
		$this->load->view('template/hrd/footer');
	}

	public function ganti_password_aksi()
    {
    	$this->form_validation->set_rules('passBaru', 'Password Baru', 'required|min_length[6]|trim');
    	$this->form_validation->set_rules('ulangPass', 'Ulangi Password Baru', 'required|matches[passBaru]|trim');
    
    	if ($this->form_validation->run() != FALSE) {
    		$passBaru = $this->input->post('passBaru');
    		$data = array('password' => md5($passBaru));
    		$id = array('id_pegawai' => $this->session->userdata('id_pegawai'));
    		
    		$this->ModelPenggajian->update_data('data_pegawai', $data, $id);
    		
    		$this->session->set_flashdata('success', '✅ Password berhasil diubah. Silakan login kembali.');
    		redirect('LoginController');
    	} else {
    		$data['title'] = "Form Ganti Password";
    		$this->load->view('template/hrd/header',$data);
    		$this->load->view('template/hrd/sidebar');
    		$this->load->view('hrd/ganti_password', $data);
    		$this->load->view('template/hrd/footer');
    	}
    }

}

?>