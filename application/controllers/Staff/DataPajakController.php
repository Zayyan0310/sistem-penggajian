<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataPajakController extends CI_Controller
{
    public function __construct(){
		parent::__construct();

        $this->load->model('PajakModel');

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
        $data['title'] = 'Data Pajak TER PPh 21';
        $data['pajak'] = $this->db->get('data_pajak')->result();
        $this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/pajak/data_pajak', $data);
		$this->load->view('template/staff/footer');
    }

    public function tambah()
    {
        $data = [
            'jenis_TER' => $this->input->post('jenis_TER'),
            'deskripsi_TER' => $this->input->post('deskripsi_TER'),
            'range_awal' => $this->input->post('range_awal'),
            'range_akhir' => $this->input->post('range_akhir'),
            'tarif_TER' => $this->input->post('tarif_TER'),
            'keterangan'      => $this->input->post('keterangan')
        ];

        $this->db->insert('data_pajak', $data);
        $this->session->set_flashdata('popup_message', [
            'tipe' => 'success',
            'pesan' => 'Data pajak berhasil ditambahkan.'
        ]);
        redirect('Staff/DataPajakController');
    }

    public function edit($id)
    {
    $data['pajak'] = $this->PajakModel->getById($id);
    $data['title'] = "Edit Data Pajak TER";

    $this->load->view('template/staff/header', $data);
    $this->load->view('template/staff/sidebar');
	$this->load->view('staff/pajak/edit_data_pajak', $data);
	$this->load->view('template/staff/footer');
    }

    public function update()
    {
    $data = [
        'jenis_TER' => $this->input->post('jenis_TER'),
        'deskripsi_TER' => $this->input->post('deskripsi_TER'),
        'range_awal' => $this->input->post('range_awal'),
        'range_akhir' => $this->input->post('range_akhir'),
        'tarif_TER' => $this->input->post('tarif_TER'),
        'keterangan'      => $this->input->post('keterangan')
    ];
    $id = $this->input->post('id_pajak');
    $this->PajakModel->update($id, $data);

    $this->session->set_flashdata('popup_message', [
        'tipe' => 'success',
        'pesan' => 'Data berhasil diperbarui.'
    ]);
    redirect('Staff/DataPajakController');
    }

    public function hapus($id)
    {
        $this->PajakModel->delete($id);
        $this->session->set_flashdata('popup_message', [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dihapus.'
        ]);
        redirect('Staff/DataPajakController');
    }

}
