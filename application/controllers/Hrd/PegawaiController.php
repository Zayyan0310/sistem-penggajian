<?php

class PegawaiController extends CI_Controller
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
			redirect('LoginController');
		}
	}

	public function index()
	{
		$data['title'] = "Data Pegawai";
		$data['pegawai'] = $this->db->select('p.*, j.nama_jabatan')
			->from('data_pegawai p')
			->join('data_jabatan j', 'j.id_jabatan = p.id_jabatan', 'left')
			->get()->result();
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/pegawai/data_pegawai', $data);
		$this->load->view('template/hrd/footer');
	}

	public function tambah_data()
	{
		$data['title'] = "Tambah Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pajak'] = $this->ModelPenggajian->get_data('data_pajak')->result();
		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/pegawai/tambah_pegawai', $data);
		$this->load->view('template/hrd/footer');
	}

	public function tambah_data_aksi()
	{
		$this->_rules();
		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$data = [
				'nama_pegawai' => $this->input->post('nama_pegawai'),
				'id_jabatan' => $this->input->post('id_jabatan'),
				'id_akses' => $this->input->post('id_akses'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
				'tanggal_masuk' => $this->input->post('tanggal_masuk'),
				'nik' => $this->input->post('nik'),
				'jenis_TER' => $this->input->post('jenis_TER'),
				'alamat' => $this->input->post('alamat'),
				'no_hp' => $this->input->post('no_hp'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password')),
				'status' => $this->input->post('status'),
				'namabank' => $this->input->post('namabank'),
				'norekening' => $this->input->post('norekening'),
				'photo' => '',
			];
			if (!empty($_FILES['photo']['name'])) {
				$config['upload_path'] = './photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$config['max_size'] = 2048;
				$config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$data['photo'] = $this->upload->data('file_name');
				} else {
					echo "Photo Gagal Diupload!";
					return;
				}
			}
			$this->ModelPenggajian->insert_data($data, 'data_pegawai');
			$this->session->set_flashdata('popup_message', '✅ Data berhasil ditambahkan!');
			redirect('Hrd/PegawaiController');
		}
	}

	public function update_data($id)
	{
		$data['title'] = "Update Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pajak'] = $this->ModelPenggajian->get_data('data_pajak')->result();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result();

		$this->load->view('template/hrd/header', $data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/pegawai/update_pegawai', $data);
		$this->load->view('template/hrd/footer');
	}

	public function update_data_aksi()
	{
		$this->_rules_update();

		if ($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('id_pegawai'));
		} else {
			$id				= $this->input->post('id_pegawai');
			$nik			= $this->input->post('nik');
			$nama_pegawai	= $this->input->post('nama_pegawai');
			$username		= $this->input->post('username');
			$email			= $this->input->post('email');
			$namabank		= $this->input->post('namabank');
			$norekening		= $this->input->post('norekening');
			$password 		= $this->input->post('password');
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$id_jabatan		= $this->input->post('id_jabatan');
			$jenis_TER 		= $this->input->post('jenis_TER');
			$alamat         = $this->input->post('alamat');
            $no_hp         	= $this->input->post('no_hp');
			$tanggal_masuk	= $this->input->post('tanggal_masuk');
			$status			= $this->input->post('status');
			$id_akses		= $this->input->post('id_akses');

			$photo = $_FILES['photo']['name'];
			if ($photo) {
				$config['upload_path'] = './photo';
				$config['allowed_types'] = 'jpg|jpeg|png|tiff';
				$config['max_size'] = 2048;
				$config['file_name'] = 'pegawai-' . date('ymd') . '-' . substr(md5(rand()), 0, 10);
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('photo')) {
					$photo = $this->upload->data('file_name');
					$this->db->set('photo', $photo);
				} else {
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nik' 			=> $nik,
				'nama_pegawai' 	=> $nama_pegawai,
				'username' 		=> $username,
				'email' 		=> $email,
				'namabank' 		=> $namabank,
				'norekening'	=> $norekening,
				'jenis_kelamin' => $jenis_kelamin,
				'id_jabatan' 	=> $id_jabatan,
				'jenis_TER' 	=> $jenis_TER,
				'alamat'        => $alamat,
                'no_hp'         => $no_hp,
				'tanggal_masuk' => $tanggal_masuk,
				'status' 		=> $status,
				'id_akses' 		=> $id_akses,
			);

			if (!empty($password)) {
				if (strlen($password) < 6) {
					$this->session->set_flashdata('error', 'Password minimal 6 karakter!');
					redirect('Hrd/PegawaiController/update_data/' . $id);
					return;
				}
				$data['password'] = md5($password);
			}

			$where = array('id_pegawai' => $id);

			$this->ModelPenggajian->update_data('data_pegawai', $data, $where);
			$this->session->set_flashdata('popup_message', 'ℹ️ Data berhasil diperbarui!');
			redirect('Hrd/PegawaiController');
		}
	}

	public function delete_data($id)
	{
		// Cek apakah pegawai ini masih memiliki data kehadiran
		$dipakai = $this->db->where('id_pegawai', $id)->count_all_results('data_kehadiran');

		if ($dipakai > 0) {
			// Jika masih digunakan, tolak penghapusan
			$this->session->set_flashdata('popup_type', 'danger');
			$this->session->set_flashdata('popup_message', '❌ Gagal menghapus! Pegawai ini masih memiliki data kehadiran.');
		} else {
			// Jika aman, lakukan penghapusan
			$hapus = $this->ModelPenggajian->delete_data(['id_pegawai' => $id], 'data_pegawai');

			if ($hapus) {
				$this->session->set_flashdata('popup_type', 'success');
				$this->session->set_flashdata('popup_message', '✅ Data pegawai berhasil dihapus!');
			} else {
				$this->session->set_flashdata('popup_type', 'danger');
				$this->session->set_flashdata('popup_message', '❌ Gagal menghapus data pegawai.');
			}
		}

		redirect('Hrd/PegawaiController');
	}


	public function _rules()
	{
		$this->form_validation->set_rules('nik', 'NIK', 'required|numeric|is_unique[data_pegawai.nik]');
		$this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required|trim');
		$this->form_validation->set_rules('username', 'Username', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
		$this->form_validation->set_rules('namabank', 'Nama Bank', 'required|trim');
		$this->form_validation->set_rules('norekening', 'No Rekening', 'required|numeric');
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required');
		$this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|numeric');
		$this->form_validation->set_rules('tanggal_masuk', 'Tanggal Masuk', 'required');
		$this->form_validation->set_rules('status', 'Status', 'required');
		$this->form_validation->set_rules('id_akses', 'ID Akses', 'required|in_list[1,2,3]');
	}

	public function _rules_update()
	{
		$this->form_validation->set_rules('password', 'Password', 'trim'); // optional
	}
}
