<?php

class ModelPenggajian extends CI_Model {

    public function get_data($table) {
        return $this->db->get($table);
    }

    public function get_data_where($table, $where)
    {
        return $this->db->get_where($table, $where);
    }


    /**
     * Ambil data gaji per bulan-tahun
     */
    public function getGajiByBulanTahun($bulantahun)
    {
        $this->db->select('
            p.id_pegawai,
            p.nik,
            p.nama_pegawai,
            j.nama_jabatan,
            COALESCE(g.gaji_pokok, j.gaji_pokok) AS gaji_pokok,
            COALESCE(g.tj_transport, j.tj_transport) AS tj_transport,
            COALESCE(g.uang_makan, j.uang_makan) AS uang_makan,
            g.jumlah_lembur,
            g.tarif_lembur,
            g.alpha,
            g.potongan_alpha,
            g.bpjs,
            g.jkm,
            g.jkk,
            g.pph21,
            g.total_potongan,
            g.gaji_bersih,
            g.status_gaji
        ');
        $this->db->from('data_pegawai p');
        $this->db->join('data_jabatan j', 'j.id_jabatan = p.id_jabatan');
        $this->db->join('data_gaji g', 'g.id_pegawai = p.id_pegawai AND g.bulantahun = "'.$bulantahun.'"', 'left');
        $this->db->order_by('p.nama_pegawai');

        return $this->db->get()->result();
    }




    public function hitungHariKerja($bulan, $tahun, $liburNasional = []) {
        $jumlahHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        $hariKerja = 0;

        $hariKerja = $this->ModelPenggajian->hitungHariKerja($bulan, $tahun);

        for ($tanggal = 1; $tanggal <= $jumlahHari; $tanggal++) {
            $tgl = sprintf('%04d-%02d-%02d', $tahun, $bulan, $tanggal);
            $hari = date('N', strtotime($tgl));

            if ($hari < 6 && !in_array($tgl, $liburNasional)) {
                $hariKerja++;
            }
        }

        return $hariKerja;
    }



    /**
     * Ambil satu pegawai berdasarkan NIK
     */
    public function getPegawaiByNik($nik) {
        return $this->db
            ->select('*')
            ->from('data_pegawai')
            ->where('nik', $nik)
            ->get()
            ->row();
    }

    /**
     * Ambil slip gaji per pegawai dan bulan
     */
    public function getSlipGajiByBulanTahun($bulantahun)
    {
        $this->db->select('
            p.id_pegawai,
            p.nik,
            p.nama_pegawai,
            p.namabank,
            p.norekening,
            p.email,
            j.nama_jabatan,
            j.gaji_pokok,
            j.tj_transport,
            j.uang_makan,
            j.tarif_lembur,
            h.alpha,
            h.bulantahun,
            COALESCE(SUM(l.jumlah_jam), 0) AS jumlah_lembur,
            g.status_gaji,
            g.bpjs,
            g.jkm,
            g.jkk,
            g.pph21,
            g.potongan_alpha,
            g.total_potongan,
            g.gaji_bersih
        ');

        $this->db->from('data_pegawai p');
        $this->db->join('data_jabatan j', 'j.id_jabatan = p.id_jabatan');
        $this->db->join('data_kehadiran h', 'h.id_pegawai = p.id_pegawai AND h.bulantahun = "'.$bulantahun.'"', 'left');
        $this->db->join('data_lembur l', 'l.id_pegawai = p.id_pegawai AND l.bulantahun = "'.$bulantahun.'"', 'left');
        $this->db->join('data_gaji g', 'g.id_pegawai = p.id_pegawai AND g.bulantahun = "'.$bulantahun.'"', 'left');
        $this->db->group_by('p.id_pegawai');

        return $this->db->get()->result();
    }


    public function getCetakGajiByBulanTahun($bulantahun)
    {
        $this->db->select('
            p.nik,
            p.nama_pegawai,
            j.nama_jabatan,
            g.gaji_pokok,
            g.tj_transport,
            g.uang_makan,
            g.jumlah_lembur,
            g.tarif_lembur,
            g.potongan_alpha,
            g.bpjs,
            g.pph21,
            g.gaji_bersih
        ');
        $this->db->from('data_pegawai p');
        $this->db->join('data_jabatan j', 'j.id_jabatan = p.id_jabatan');
        $this->db->join('data_gaji g', 'g.id_pegawai = p.id_pegawai AND g.bulan = "'.$bulantahun.'"', 'left');

        return $this->db->get()->result();
    }

    public function insert_data($data, $table) {
        $this->db->insert($table, $data);
    }

    public function update_data($table, $data, $where) {
        $this->db->update($table, $data, $where);
    }

    public function delete_data($where, $table) {
        $this->db->where($where);
        return $this->db->delete($table); // return true/false
    }

    public function insert_batch($table = null, $data = array()) {
        if (count($data) > 0) {
            $this->db->insert_batch($table, $data);
        }
    }

    public function cek_login($username, $password)
    {
        $result = $this->db->where('username', $username)
                        ->where('password', md5($password))  // pastikan password di-hash sama seperti di database
                        ->limit(1)
                        ->get('data_pegawai');

        if ($result->num_rows() > 0) {
            return $result->row(); // login berhasil
        } else {
            return FALSE; // login gagal
        }
    }

    public function getAbsenPegawai($id_pegawai, $bulantahun)
    {
        return $this->db->where('id_pegawai', $id_pegawai)
                        ->where('bulan', $bulantahun)
                        ->get('data_kehadiran')
                        ->row(); // hanya satu record
    }

    // Ambil data lembur berdasarkan bulan dan tahun
    public function getLemburByBulanTahun($bulan, $tahun)
    {
        $bulantahun = $bulan . $tahun;

        $this->db->select('l.*, p.nama_pegawai');
        $this->db->from('data_lembur l');
        $this->db->join('data_pegawai p', 'p.id_pegawai = l.id_pegawai');
        $this->db->where('l.bulantahun', $bulantahun);
        $this->db->order_by('p.nama_pegawai', 'ASC');

        return $this->db->get()->result();
    }

    // Simpan data lembur
    public function insertLembur($data)
    {
        return $this->db->insert('data_lembur', $data);
    }

    // File: application/models/ModelPenggajian.php
    public function getAllPegawai()
    {
        return $this->db->get('data_pegawai')->result();
    }

    public function isDataSudahAda($bulantahun)
    {
        $this->db->where('bulantahun', $bulantahun);
        return $this->db->get('data_lembur')->num_rows() > 0;
    }

   public function get_absensi_by_bulan_tahun($bulan, $tahun) {
        // Mengambil data absensi dengan menggabungkan tabel data_kehadiran dan data_pegawai
        $this->db->select('dk.*, dp.nama_pegawai');
        $this->db->from('data_kehadiran dk');
        $this->db->join('data_pegawai dp', 'dk.id_pegawai = dp.id_pegawai');
        
        // Menggabungkan bulan dan tahun menjadi bulantahun
        $bulantahun = $bulan . $tahun;
        
        // Filter berdasarkan bulantahun
        $this->db->where('dk.bulantahun', $bulantahun);  // Menggunakan bulantahun, bukan bulan
        
        $query = $this->db->get();

        return $query->result();  // Mengembalikan hasil query
    }

    public function update_kehadiran($id_kehadiran, $id_pegawai, $data) {
        $this->db->where('id_kehadiran', $id_kehadiran);
        $this->db->where('id_pegawai', $id_pegawai);  // Pastikan id_pegawai juga digunakan untuk memfilter
        return $this->db->update('data_kehadiran', $data); // Update hanya kolom bulantahun
    }

    public function get_lembur_data($id_pegawai, $bulantahun)
    {
        $this->db->select('l.id_lembur, l.jumlah_jam, dp.id_pegawai, dp.nama_pegawai');  // Select the necessary columns
        $this->db->from('data_lembur l');
        $this->db->join('data_pegawai dp', 'l.id_pegawai = dp.id_pegawai');
        $this->db->where('l.id_pegawai', $id_pegawai);
        $this->db->where('l.bulantahun', $bulantahun);  // Filter by bulantahun
        $query = $this->db->get();

        return $query->result();  // Return the result of the query
    }

    public function update_lembur($id_pegawai, $bulantahun, $data)
    {
        $this->db->where('id_pegawai', $id_pegawai);
        $this->db->where('bulantahun', $bulantahun);
        return $this->db->update('data_lembur', $data);
    }


    public function get_lembur_by_bulan_tahun($bulan, $tahun)
    {
        $this->db->select('l.id_lembur, l.jumlah_jam, dp.id_pegawai, dp.nama_pegawai');
        $this->db->from('data_lembur l');
        $this->db->join('data_pegawai dp', 'l.id_pegawai = dp.id_pegawai');
        $bulantahun = $bulan . $tahun;
        $this->db->where('l.bulantahun', $bulantahun);
        $query = $this->db->get();

        return $query->result();
    }



}
