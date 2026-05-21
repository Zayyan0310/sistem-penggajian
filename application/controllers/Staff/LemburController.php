<?php
defined('BASEPATH') or exit('No direct script access allowed');

class LemburController extends CI_Controller
{
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

        $this->load->model('ModelPenggajian');
    }

    public function index()
    {
        $data['title'] = 'Data Lembur Pegawai';

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        if (empty($bulan)) $bulan = date('m');
        if (empty($tahun)) $tahun = date('Y');

        $data['lembur'] = $this->ModelPenggajian->getLemburByBulanTahun($bulan, $tahun);

        $this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/lembur/data_lembur', $data);
		$this->load->view('template/staff/footer');
    }

    public function input_lembur()
    {
        $data['title'] = 'Input Lembur Pegawai';
        $data['pegawai'] = $this->ModelPenggajian->getAllPegawai();

        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        if ($bulan && $tahun) {
            $bulantahun = $bulan . $tahun;
            $data['sudah_ada'] = $this->ModelPenggajian->isDataSudahAda($bulantahun);
            $data['bulantahun'] = $bulantahun;
        } else {
            $data['sudah_ada'] = false;
        }

        $bulantahun = $this->input->post('bulantahun');
        if ($this->ModelPenggajian->isDataSudahAda($bulantahun)) {
            $this->session->set_flashdata('popup_message', ['tipe' => 'warning', 'pesan' => 'Data lembur bulan tersebut sudah pernah diinput.']);
            redirect('Hrd/LemburController/input_lembur?bulan=' . substr($bulantahun, 0, 2) . '&tahun=' . substr($bulantahun, 2, 4));
            return;
        }

        $this->load->view('template/staff/header', $data);
		$this->load->view('template/staff/sidebar');
		$this->load->view('staff/lembur/input_lembur', $data);
		$this->load->view('template/staff/footer');
    }

    public function simpan()
    {
        $bulantahun = $this->input->post('bulantahun');
        $id_pegawai = $this->input->post('id_pegawai');
        $jumlah_jam = $this->input->post('jumlah_jam');

        $data = [];
        for ($i = 0; $i < count($id_pegawai); $i++) {
            if ($jumlah_jam[$i] > 0) {
                $data[] = [
                    'id_pegawai' => $id_pegawai[$i],
                    'bulantahun' => $bulantahun,
                    'jumlah_jam' => $jumlah_jam[$i],
                ];
            }
        }

        if (!empty($data)) {
            $this->db->insert_batch('data_lembur', $data);
            $this->session->set_flashdata('popup_message', ['tipe' => 'success', 'pesan' => 'Data lembur berhasil disimpan.']);
        } else {
            $this->session->set_flashdata('popup_message', ['tipe' => 'warning', 'pesan' => 'Tidak ada data lembur yang diinput.']);
        }

        redirect('Staff/LemburController/input_lembur?bulan=' . substr($bulantahun, 0, 2) . '&tahun=' . substr($bulantahun, 2, 4));
    }

    public function edit_lembur($id_pegawai, $bulan, $tahun)
    {
        $bulantahun = $bulan . $tahun; // Combine bulan and tahun to make bulantahun

        // Retrieve data for the selected employee's overtime for the specific month and year
        $data['lembur'] = $this->ModelPenggajian->get_lembur_data($id_pegawai, $bulantahun);

        // Check if the data exists for the selected employee and month
        if (empty($data['lembur'])) {
            $this->session->set_flashdata('failed', 'Data lembur tidak ditemukan untuk pegawai ini pada bulan yang dipilih.');
            redirect('Staff/LemburController');
        }

        // Set page title and other data
        $data['title'] = 'Edit Lembur Pegawai';
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
        $data['bulantahun'] = $bulantahun;

        // Load the view
        $this->load->view('template/staff/header', $data);
        $this->load->view('template/staff/sidebar');
        $this->load->view('staff/lembur/edit_lembur', $data);
        $this->load->view('template/staff/footer');
    }

        public function update_lembur()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $bulantahun = $bulan . $tahun;

        // Get the number of hours for each employee
        $id_pegawai = $this->input->post('id_pegawai');
        $jumlah_jam = $this->input->post('jumlah_jam');

        // Update overtime data for all employees in the selected month
        for ($i = 0; $i < count($id_pegawai); $i++) {
            // Update the overtime for each employee
            $data = [
                'jumlah_jam' => $jumlah_jam[$i]
            ];

            // Update data in the database
            $this->ModelPenggajian->update_lembur($id_pegawai[$i], $bulantahun, $data);
        }

        // Set flash message and redirect back to the same page with the selected bulan and tahun
        $this->session->set_flashdata('success', 'Data lembur berhasil diperbarui untuk semua pegawai.');
        redirect('Staff/LemburController?bulan=' . $bulan . '&tahun=' . $tahun);
    }


}
