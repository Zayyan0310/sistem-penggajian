<?php 

class AbsensiController extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('hak_akses') != '2') {
            redirect('LoginController');
        }
    }

    public function index()
    {
       $data['title'] = "Data Absensi Saya";
        $nik = $this->session->userdata('nik');
        $data['nama_pegawai'] = $this->session->userdata('nama_pegawai');


        // Ambil input bulan & tahun dari form
        if ($this->input->post('bulan') && $this->input->post('tahun')) {
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $bulantahun = $bulan . $tahun;

        // Ambil data dari model
        $data['absen'] = $this->ModelPenggajian->getAbsenPegawai($nik, $bulantahun);
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;

        $this->load->view('template/pegawai/header',$data);
		$this->load->view('template/pegawai/sidebar');
		$this->load->view('pegawai/absensi', $data);
		$this->load->view('template/pegawai/footer');
    }

}

?>