<?php
class GajiController extends CI_Controller {

    public function __construct(){
        parent::__construct();
        if($this->session->userdata('hak_akses') != '2'){
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
        $data['title'] = "Data Gaji";

        $nik = $this->session->userdata('nik');

        // Ambil data potongan
        $potongan = $this->ModelPenggajian->get_data('potongan_gaji')->result();
        $alphaRate = 0;
        foreach ($potongan as $p) {
           if (isset($p->potongan) && strtolower($p->potongan) == 'alpha') {
                $alphaRate = $p->jml_potongan;
            }
        }

        $data['alphaRate'] = $alphaRate;

        // Query data gaji
        $data['gaji'] = $this->db->query("
            SELECT dp.nama_pegawai, dp.nik, dp.potongan_bpjs,
                   dj.gaji_pokok, dj.tj_transport, dj.uang_makan,
                   kh.alpha, kh.bulan, kh.id_kehadiran
            FROM data_pegawai dp
            JOIN data_kehadiran kh ON kh.nik = dp.nik
            JOIN data_jabatan dj ON dj.nama_jabatan = dp.jabatan
            WHERE kh.nik = '$nik'
            ORDER BY kh.bulan DESC
        ")->result();

        $this->load->view('template/pegawai/header', $data);
        $this->load->view('template/pegawai/sidebar');
        $this->load->view('pegawai/gaji', $data);
        $this->load->view('template/pegawai/footer');
    }

    public function cetak_slip($id)
	{
		$data['title'] = 'Cetak Slip Gaji';

		$potongan = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$alphaRate = 0;
		foreach ($potongan as $p) {
			if (isset($p->potongan) && strtolower($p->potongan) == 'alpha') {
				$alphaRate = $p->jml_potongan;
			}
		}
		$data['alphaRate'] = $alphaRate;
		$data['potongan'] = $potongan;


		// Ambil data kehadiran, jabatan dan pegawai berdasarkan ID kehadiran
		$data['print_slip'] = $this->db->query("
			SELECT 
				dp.nik, 
				dp.nama_pegawai,
				dp.norekening,
				dp.namabank,
				dp.potongan_bpjs,
				dj.nama_jabatan, 
				dj.gaji_pokok, 
				dj.tj_transport, 
				dj.uang_makan,
				kh.alpha, 
				kh.bulan
			FROM data_pegawai dp
			JOIN data_kehadiran kh ON kh.nik = dp.nik
			JOIN data_jabatan dj ON dj.nama_jabatan = dp.jabatan
			WHERE kh.id_kehadiran = '$id'
		")->result();

		// Load view
		$this->load->view('template/pegawai/header', $data);
		$this->load->view('pegawai/cetak_slip_gaji', $data);
		$this->load->view('template/pegawai/footer');
	}

}
?>
