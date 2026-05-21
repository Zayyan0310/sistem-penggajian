<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PotonganController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ModelPotongan_Gaji');

        // Cek hak akses (1 = Staff)
        if ($this->session->userdata('id_akses') != '1') {
            $this->session->set_flashdata('pesan', 
                '<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
        $data['title'] = "Setting Potongan Gaji";
        $data['hasil'] = $this->ModelPotongan_Gaji->TampilPotongan();
        $this->load->view('template/staff/header', $data);
        $this->load->view('template/staff/sidebar');
        $this->load->view('staff/potongan_gaji/list_potongan_gaji', $data);
        $this->load->view('template/staff/footer');
    }
    
    public function form_edit_potongan_gaji($potongan)
    {
        $data['hasil'] = $this->ModelPotongan_Gaji->Getpotongan($potongan);
        $this->load->view('template/staff/header');
        $this->load->view('template/staff/sidebar');
        $this->load->view('staff/potongan_gaji/edit_potongan_gaji', $data);
        $this->load->view('template/staff/footer');
    }
    public function simpan_potongan()
    {
        $this->form_validation->set_rules('potongan', 'Nama Potongan', 'required|trim');
        $this->form_validation->set_rules('jml_potongan', 'Jumlah Potongan', 'required|numeric');
    
        if ($this->form_validation->run() == FALSE) {
            $this->tambah_potongan(); // form view
        } else {
            $data = [
                'potongan' => $this->input->post('potongan'),
                'jml_potongan' => $this->input->post('jml_potongan')
            ];
            $this->ModelPenggajian->insert_data($data, 'potongan_gaji');
            $this->session->set_flashdata('popup_type', 'success');
			$this->session->set_flashdata('popup_message', '✅ Data berhasil ditambahkan!');
            redirect('Staff/PotonganController');
        }
    }


    
    public function tambah_potongan_gaji()
    {
        $data['title'] = "Tambah Potongan Gaji";
        $this->load->view('template/staff/header', $data);
        $this->load->view('template/staff/sidebar');
        $this->load->view('staff/potongan_gaji/tambah_potongan_gaji', $data);
        $this->load->view('template/staff/footer');
    }

    public function edit_potongan()
    {
        $data = [
            'potongan' => $this->input->post('potongan_baru'),
            'jml_potongan' => $this->input->post('jml_potongan')
        ];
        $potongan = $this->input->post('potongan_lama');
    
        $this->db->where('potongan', $potongan);
        $this->db->update('potongan_gaji', $data);
    
        $this->session->set_flashdata('popup_type', 'info');
		$this->session->set_flashdata('popup_message', '✅ Data berhasil diperbarui!');
        redirect('Staff/PotonganController');
    }

    public function hapus_potongan_gaji($potongan = null)
    {
        if ($potongan === null) {
            $this->session->set_flashdata('popup_message', 'Nama potongan tidak ditemukan.');
            redirect('Staff/PotonganController');
            return;
        }
    
        // Menghapus berdasarkan nama potongan
        $hapus = $this->db->delete('potongan_gaji', ['potongan' => $potongan]);
    
        if ($hapus) {
            $this->session->set_flashdata('popup_message', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('popup_message', 'Gagal menghapus data.');
        }
    
        redirect('Staff/PotonganController');
    }


}
?>
