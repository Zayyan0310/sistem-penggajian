<?php
class LaporanGajiController extends CI_Controller {

    public function __construct(){
        parent::__construct();

        if($this->session->userdata('id_akses') != '1'){
            // …
            redirect('LoginController');
        }
        // ➤ Pastikan model dipanggil di construct
        $this->load->model('ModelPenggajian');
    }

    public function index() 
    {   
        $data['title'] = "Laporan Gaji Pegawai";
        $this->load->view('template/staff/header',$data);
        $this->load->view('template/staff/sidebar');
        $this->load->view('staff/gaji/laporan_gaji');
        $this->load->view('template/staff/footer');
    }
    
    private function getBulanTahun()
    {
        $bulan = $this->input->post('bulan') ?: date('m');
        $tahun = $this->input->post('tahun') ?: date('Y');
        return $bulan . $tahun;
    }

   public function cetak_laporan_gaji()
    {
        $data['title'] = "Cetak Laporan Gaji Pegawai";

        $bulan = $this->input->get('bulan') ?: date('m');
        $tahun = $this->input->get('tahun') ?: date('Y');
        $bulantahun = $bulan . $tahun;

        // Ambil data dari tabel data_gaji YANG SUDAH DIPROSES SAJA
        $data['gaji_list'] = $this->db->query("
            SELECT 
                g.*, p.nik, p.nama_pegawai, j.nama_jabatan
            FROM data_gaji g
            JOIN data_pegawai p ON g.id_pegawai = p.id_pegawai
            JOIN data_jabatan j ON p.id_jabatan = j.id_jabatan
            WHERE g.bulantahun = ?
            ORDER BY p.nama_pegawai ASC
        ", [$bulantahun])->result();

        // Cek jika kosong
        if (empty($data['gaji_list'])) {
            $this->session->set_flashdata('error', 'Belum ada data gaji untuk bulan ini. Silakan proses gaji terlebih dahulu.');
            redirect('Staff/LaporanGajiController');
            return;
        }

        $data['filter_bulan'] = $bulan;
        $data['filter_tahun'] = $tahun;

        $this->load->view('template/staff/header', $data);
        $this->load->view('staff/gaji/cetak_gaji', $data);
    }





    private function hitungHariKerja($bulan, $tahun)
    {
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $hariKerja = 0;

        for ($i = 1; $i <= $jumlahHari; $i++) {
            $tanggal = sprintf('%04d-%02d-%02d', $tahun, $bulan, $i);
            $hari = date('N', strtotime($tanggal)); // 1 = Senin, 7 = Minggu

            if ($hari >= 1 && $hari <= 5) { // Senin s.d Jumat
                $hariKerja++;
            }
        }

        return $hariKerja;
    }


}
?>
