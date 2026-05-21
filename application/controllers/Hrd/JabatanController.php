<?php

class JabatanController extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('id_akses') != '3'){
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
		$data['title'] = "Data Jabatan";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();

		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/jabatan/data_jabatan', $data);
		$this->load->view('template/hrd/footer');
	}

	public function tambah_data() 
	{
		$data['title'] = "Tambah Data Jabatan";
		
		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/jabatan/tambah_jabatan', $data);
		$this->load->view('template/hrd/footer');
	}

	public function tambah_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan		= $this->input->post('uang_makan');

			$bpjs			= $gaji_pokok * 0.05;
			$jkm			= $gaji_pokok * 0.003;
			$jkk			= $gaji_pokok * 0.0174;
			$tarif_lembur	= $gaji_pokok / 173;
			$total			= $gaji_pokok + $tj_transport + $uang_makan + $bpjs + $jkm + $jkk;

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan,
				'gaji_pokok' 	=> $gaji_pokok,
				'tj_transport' 	=> $tj_transport,
				'uang_makan' 	=> $uang_makan,
				'bpjs' 			=> floor($bpjs),
				'jkm' 			=> floor($jkm),
				'jkk' 			=> floor($jkk),
				'tarif_lembur'  => floor($tarif_lembur),
				'total'			=> floor($total)
			);

			$this->ModelPenggajian->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('popup_type', 'success');
			$this->session->set_flashdata('popup_message', '✅ Data berhasil ditambahkan!');
			redirect('Hrd/JabatanController');
		}
	}

	public function update_data($id) 
	{
		$data['title'] = "Update Data Jabatan";
		$data['jabatan'] = $this->ModelPenggajian->get_data_where('data_jabatan', ['id_jabatan' => $id])->result();

		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/jabatan/update_jabatan', $data);
		$this->load->view('template/hrd/footer');
	}

	public function update_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('id_jabatan'));
		} else {
			$id				= $this->input->post('id_jabatan');
			$nama_jabatan	= $this->input->post('nama_jabatan');
			$gaji_pokok		= $this->input->post('gaji_pokok');
			$tj_transport	= $this->input->post('tj_transport');
			$uang_makan		= $this->input->post('uang_makan');

			$bpjs			= $gaji_pokok * 0.05;
			$jkm			= $gaji_pokok * 0.003;
			$jkk			= $gaji_pokok * 0.0174;
			$tarif_lembur	= $gaji_pokok / 173;
			$total			= $gaji_pokok + $tj_transport + $uang_makan + $bpjs + $jkm + $jkk;

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan,
				'gaji_pokok' 	=> $gaji_pokok,
				'tj_transport' 	=> $tj_transport,
				'uang_makan' 	=> $uang_makan,
				'bpjs' 			=> floor($bpjs),
				'jkm' 			=> floor($jkm),
				'jkk' 			=> floor($jkk),
				'tarif_lembur'  => floor($tarif_lembur),
				'total'			=> floor($total)
			);

			$where = array('id_jabatan' => $id);

			$this->ModelPenggajian->update_data('data_jabatan', $data, $where);
			$this->session->set_flashdata('popup_type', 'info');
			$this->session->set_flashdata('popup_message', 'ℹ️ Data berhasil diperbarui!');
			redirect('Hrd/JabatanController');
		}
	}



	public function delete_data($id) {
		$pegawai = $this->db->get_where('data_pegawai', ['id_jabatan' => $id])->num_rows();

		if ($pegawai > 0) {
			$this->session->set_flashdata('popup_type', 'danger');
			$this->session->set_flashdata('popup_message', '❌ Gagal menghapus! Jabatan ini masih digunakan oleh pegawai.');
		} else {
			$hapus = $this->ModelPenggajian->delete_data(['id_jabatan' => $id], 'data_jabatan');
			if ($hapus) {
				$this->session->set_flashdata('popup_type', 'success');
				$this->session->set_flashdata('popup_message', '✅ Data jabatan berhasil dihapus!');
			} else {
				$this->session->set_flashdata('popup_type', 'danger');
				$this->session->set_flashdata('popup_message', '❌ Gagal menghapus data jabatan.');
			}
		}

		redirect('Hrd/JabatanController');
	}

	public function _rules() {
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan','required');
		$this->form_validation->set_rules('gaji_pokok','Gaji Pokok','required');
		$this->form_validation->set_rules('tj_transport','Tunjangan Transport','required');
		$this->form_validation->set_rules('uang_makan','Uang Makan','required');
	}
}

?>
