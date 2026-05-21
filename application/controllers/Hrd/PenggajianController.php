<?php

class PenggajianController extends CI_Controller {

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

        $this->load->model('ModelPenggajian');
    }

    private function getBulanTahun() {
        $bulan = $this->input->get('bulan') ?? date('m');
        $tahun = $this->input->get('tahun') ?? date('Y');
        return $bulan . $tahun;
    }

    private function hitungHariKerja($bulan, $tahun) {
        // Hitung jumlah hari dalam bulan yang dipilih
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $hariKerja = 0;

        // Loop dari tanggal 1 sampai jumlah hari
        for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++) {
            // Format tanggal jadi YYYY-MM-DD
            $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal);
            
            // Cari hari keberapa (1 = Senin, 7 = Minggu)
            $hari = date('N', strtotime($tgl));

            // Hitung hanya hari Senin–Jumat
            if ($hari >= 1 && $hari <= 5) {
                $hariKerja++;
            }
        }

        return $hariKerja;
    }


    public function index() 
    {
        $data['title'] = "Data Gaji Pegawai";
        $bulantahun = $this->getBulanTahun();

        $data['gaji'] = $this->ModelPenggajian->getGajiByBulanTahun($bulantahun);

        $this->load->view('template/hrd/header', $data);
        $this->load->view('template/hrd/sidebar');
        $this->load->view('hrd/gaji/gaji', $data);
        $this->load->view('template/hrd/footer');
    }

    public function detail_slip()
    {
        $id_pegawai = $this->input->get('id_pegawai');
        $bulan = $this->input->get('bulan');
        $tahun = $this->input->get('tahun');
        $bulantahun = $bulan . $tahun;  // Gabungkan bulan dan tahun untuk mencari data berdasarkan bulantahun

        $data['title'] = "Detail Slip Gaji";
        $data['hariKerja'] = $this->hitungHariKerja((int)$bulan, (int)$tahun);  // Hitung hari kerja

        // Ambil data slip berdasarkan bulan dan tahun
        $slip = $this->db->query("
            SELECT 
                p.id_pegawai, p.nik, p.nama_pegawai, p.namabank, p.norekening,
                j.nama_jabatan, j.gaji_pokok, j.tj_transport, j.uang_makan, j.tarif_lembur,
                COALESCE(h.alpha, 0) AS alpha,
                COALESCE(SUM(l.jumlah_jam), 0) AS jumlah_lembur,
                g.status_gaji
            FROM data_pegawai p
            JOIN data_jabatan j ON j.id_jabatan = p.id_jabatan
            LEFT JOIN data_kehadiran h ON h.id_pegawai = p.id_pegawai AND h.bulantahun = ?
            LEFT JOIN data_lembur l ON l.id_pegawai = p.id_pegawai AND l.bulantahun = ?
            LEFT JOIN data_gaji g ON g.id_pegawai = p.id_pegawai AND g.bulantahun = ?
            WHERE p.id_pegawai = ?
            GROUP BY p.id_pegawai
        ", [$bulantahun, $bulantahun, $bulantahun, $id_pegawai])->row();

        // Pastikan data slip ditemukan
        if (!$slip) {
            $this->session->set_flashdata('failed', '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-info-circle"></i> Data slip gaji tidak ditemukan.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            ');
            redirect('Hrd/SlipGajiController');
            return;
        }

        // Ambil informasi rekening dari data_pegawai jika ada
        $pegawai = $this->db->get_where('data_pegawai', ['id_pegawai' => $slip->id_pegawai])->row();
        if ($pegawai) {
            $slip->nik = $pegawai->nik;
            $slip->namabank = $pegawai->namabank;
            $slip->norekening = $pegawai->norekening;
        }

        // Hitung kembali lembur dan potongan alpha
        $lembur = $slip->jumlah_lembur * $slip->tarif_lembur;
        $potonganAlpha = $data['hariKerja'] > 0 ? ($slip->alpha / $data['hariKerja']) * $slip->gaji_pokok : 0;

        // Hitung komponen tambahan
        $bpjs = $slip->gaji_pokok * 0.05;  // 5% dari gaji pokok
        $jkm = $slip->gaji_pokok * 0.003; // 0.3% dari gaji pokok
        $jkk = $slip->gaji_pokok * 0.0174; // 1.74% dari gaji pokok

        $pph21 = 0; // Jika ada perhitungan PPh 21, Anda bisa menambahkannya

        // Hitung dasar penghasilan bruto
        $dasar_pph = $slip->gaji_pokok + $slip->tj_transport + $slip->uang_makan + $lembur + $bpjs + $jkm + $jkk;

        // Ambil tarif PPh 21 berdasarkan jenis_TER dari pegawai
        $pajak = $this->db->query("
            SELECT tarif_TER 
            FROM data_pajak
            WHERE jenis_TER = ? 
            AND ? BETWEEN range_awal AND range_akhir
            LIMIT 1
        ", [$pegawai->jenis_TER, $dasar_pph])->row();

        if ($pajak) {
            $pph21 = $dasar_pph * ($pajak->tarif_TER / 100);
        }

        // Gaji bersih = semua komponen + tambahan - hanya potongan alpha
        $gaji_bersih = (
            $slip->gaji_pokok +
            $slip->tj_transport +
            $slip->uang_makan +
            $lembur +
            $bpjs +
            $jkm +
            $jkk +
            $pph21
        ) - $potonganAlpha;

        // Simpan data ke data_gaji jika data belum ada
        $cekGaji = $this->db->get_where('data_gaji', [
            'id_pegawai' => $id_pegawai,
            'bulantahun' => $bulantahun
        ])->row();

        if (!$cekGaji) {
            // Simpan ke database jika data belum ada
            $this->db->insert('data_gaji', [
                'id_pegawai'     => $id_pegawai,
                'bulantahun'     => $bulantahun,
                'gaji_pokok'     => $slip->gaji_pokok,
                'tj_transport'   => $slip->tj_transport,
                'uang_makan'     => $slip->uang_makan,
                'jumlah_lembur'  => $slip->jumlah_lembur,
                'tarif_lembur'   => $slip->tarif_lembur,
                'alpha'          => $slip->alpha,
                'potongan_alpha' => $potonganAlpha,
                'bpjs'           => floor($bpjs),
                'jkm'            => floor($jkm),
                'jkk'            => floor($jkk),
                'pph21'          => floor($pph21),
                'total_potongan' => floor($potonganAlpha),
                'gaji_bersih'    => floor($gaji_bersih),
                'status_gaji'    => 'Belum Dikirim'
            ]);
        }

        // Kirim data ke view
        $data['slip'] = $slip;
        $data['gaji_bersih'] = $gaji_bersih;

        $this->load->view('template/hrd/header', $data);
        $this->load->view('template/hrd/sidebar');
        $this->load->view('hrd/gaji/detail_slip', $data);
        $this->load->view('template/hrd/footer');
    }

}
?>
