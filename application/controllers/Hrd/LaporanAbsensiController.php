<?php

class LaporanAbsensiController extends CI_Controller {

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

	public function index() {	
		$data['title'] = "Laporan Absensi Pegawai";

		$this->load->view('template/hrd/header',$data);
		$this->load->view('template/hrd/sidebar');
		$this->load->view('hrd/absensi/laporan_absensi');
		$this->load->view('template/hrd/footer');
	}

    public function cetak_laporan_absensi()
    {
        $data['title'] = "Cetak Laporan Absensi Pegawai";
    
        if ((isset($_GET['bulan']) && $_GET['bulan'] != '') && (isset($_GET['tahun']) && $_GET['tahun'] != '')) {
            $bulan = $_GET['bulan'];
            $tahun = $_GET['tahun'];
            $bulantahun = $bulan . $tahun;
        } else {
            $bulan = date('m');
            $tahun = date('Y');
            $bulantahun = $bulan . $tahun;
        }
    
        $data['bulan'] = $bulan;
        $data['tahun'] = $tahun;
    
        $data['lap_kehadiran'] = $this->db->query("
            SELECT kh.*, p.nama_pegawai
            FROM data_kehadiran kh
            INNER JOIN data_pegawai p ON kh.id_pegawai = p.id_pegawai
            WHERE kh.bulantahun = '$bulantahun'
            ORDER BY p.nama_pegawai ASC
        ")->result();

    
        // Cek apakah data kosong
        if (empty($data['lap_kehadiran'])) {
            $this->session->set_flashdata('failed', 'Data absensi kosong, silakan input data kehadiran.');
            return redirect('Hrd/LaporanAbsensiController');  // Pastikan ini benar sesuai rute controller kamu
        }
    
        $this->load->view('template/hrd/header', $data);
        $this->load->view('hrd/absensi/cetak_absensi', $data);
    }

}

?>