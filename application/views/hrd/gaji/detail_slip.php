<?php if ($this->session->flashdata('popup_message')): 
  $msg = $this->session->flashdata('popup_message'); ?>
  <div class="alert alert-<?= $msg['tipe'] ?> alert-dismissible fade show" role="alert">
    <?= $msg['pesan'] ?>
    <button type="button" class="close" data-dismiss="alert">&times;</button>
  </div>
<?php endif; ?>

<div class="container mt-5">
  <h2 class="mb-4 text-center"><?= $title ?></h2>

  <?php if ($slip): ?>
    <?php
      $hariKerja = $hariKerja ?? 0;

      // Nilai default
      $slip->gaji_pokok     = $slip->gaji_pokok     ?? 0;
      $slip->tj_transport   = $slip->tj_transport   ?? 0;
      $slip->uang_makan     = $slip->uang_makan     ?? 0;
      $slip->jumlah_lembur  = $slip->jumlah_lembur  ?? 0;
      $slip->tarif_lembur   = $slip->tarif_lembur   ?? 0;
      $slip->alpha          = $slip->alpha          ?? 0;

      $lembur = $slip->jumlah_lembur * $slip->tarif_lembur;
      $potonganAlpha = $hariKerja > 0 ? ($slip->alpha / $hariKerja) * $slip->gaji_pokok : 0;

      // Informasi (tidak masuk potongan)
      $bpjs = $slip->gaji_pokok * 0.05;
      $jkm  = $slip->gaji_pokok * 0.003;
      $jkk  = $slip->gaji_pokok * 0.0174;

      // PPh 21 dihitung dari gaji pokok
      $pph21 = 0;

      // Ambil data pegawai
      $pegawai = $this->db->get_where('data_pegawai', ['id_pegawai' => $slip->id_pegawai])->row();

      if ($pegawai) {
      // Hitung dasar penghasilan bruto
      $dasar_pph = $slip->gaji_pokok + $slip->tj_transport + $slip->uang_makan + $lembur + $bpjs + $jkm + $jkk;

      // Ambil jenis_TER dari data pegawai
      $jenis_TER = $pegawai->jenis_TER;

      // Ambil tarif PPh21 berdasarkan jenis_TER dan range penghasilan
      $pajak = $this->db->query("
        SELECT tarif_TER 
        FROM data_pajak
        WHERE jenis_TER = ? 
        AND ? BETWEEN range_awal AND range_akhir
        LIMIT 1
        ", [$jenis_TER, $dasar_pph])->row();

        // Hitung PPh21 jika tarif ditemukan
        if ($pajak) {
        $pph21 = $dasar_pph * ($pajak->tarif_TER / 100);
        }
      }


      // ❗️Total potongan hanya dari alpha
      $total_potongan = $potonganAlpha;

      // Gaji bersih = bruto - alpha saja
     $gaji_bersih = (
        $slip->gaji_pokok +
        $slip->tj_transport +
        $slip->uang_makan +
        $lembur +
        $bpjs +
        $jkm +
        $jkk +
        $pph21
      ) - $total_potongan;

    ?>

    <table class="table table-bordered">
      <tr>
        <th>NIK</th>
        <td><?= $slip->nik ?></td>
      </tr>
      <tr>
        <th>Nama Pegawai</th>
        <td><?= $slip->nama_pegawai ?></td>
      </tr>
      <tr>
        <th>Bank</th>
        <td><?= $slip->namabank ?> (<?= $slip->norekening ?>)</td>
      </tr>
      <tr>
        <th>Jabatan</th>
        <td><?= $slip->nama_jabatan ?></td>
      </tr>
      <tr>
        <th>Gaji Pokok</th>
        <td>Rp. <?= number_format($slip->gaji_pokok, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Uang Makan</th>
        <td>Rp. <?= number_format($slip->uang_makan, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Tunjangan Transport</th>
        <td>Rp. <?= number_format($slip->tj_transport, 0, ',', '.') ?></td>
      </tr>
      <tr>
        <th>Lembur</th>
        <td><?= $slip->jumlah_lembur ?> jam x Rp. <?= number_format($slip->tarif_lembur, 0, ',', '.') ?> =
          <strong>Rp. <?= number_format($lembur, 0, ',', '.') ?></strong>
        </td>
      </tr>
      <tr>
        <th>Alpha</th>
        <td><?= $slip->alpha ?> hari (Potongan: Rp. <?= number_format($potonganAlpha, 0, ',', '.') ?>)</td>
      </tr>
      <!-- Informasi -->
      <tr>
        <th>BPJS (5%)</th>
        <td>Rp. <?= number_format($bpjs, 0, ',', '.') ?> <small class="text-muted">(informasi)</small></td>
      </tr>
      <tr>
        <th>JKM (0.3%)</th>
        <td>Rp. <?= number_format($jkm, 0, ',', '.') ?> <small class="text-muted">(informasi)</small></td>
      </tr>
      <tr>
        <th>JKK (1.74%)</th>
        <td>Rp. <?= number_format($jkk, 0, ',', '.') ?> <small class="text-muted">(informasi)</small></td>
      </tr>
      <tr>
        <th>PPh21</th>
        <td>Rp. <?= number_format($pph21, 0, ',', '.') ?> 
          <small class="text-muted">
            (Tarif TER: <?= isset($pajak->tarif_TER) ? $pajak->tarif_TER . '%' : '-' ?>, 
            Dasar: Rp. <?= number_format($dasar_pph ?? 0, 0, ',', '.') ?>)
          </small>
        </td>
      </tr>

      <!-- Total -->
      <tr>
        <th>Total Potongan (Alpha)</th>
        <td>Rp. <?= number_format($total_potongan, 0, ',', '.') ?></td>
      </tr>
      <tr class="table-success">
        <th>Total Gaji Bersih</th>
        <td><strong>Rp. <?= number_format($gaji_bersih, 0, ',', '.') ?></strong></td>
      </tr>

      <tr>
        <th>Status</th>
        <td><strong><?= $slip->status_gaji ?? 'Belum Dikirim' ?></strong></td>
      </tr>
    </table>

    <!-- <?php
    echo "<div class='alert alert-info'>ID Pajak: " . ($pegawai->id_pajak ?? '-') . "</div>";
    echo "<div class='alert alert-info'>Gaji Bruto: " . number_format($gaji_bruto, 0, ',', '.') . "</div>";

    if ($pajak) {
        echo "<div class='alert alert-success'>Tarif TER: {$pajak->tarif_TER}%</div>";
    } else {
        echo "<div class='alert alert-warning'>⚠️ Tidak ada data TER yang cocok dengan ID Pajak dan Gaji Bruto ini.</div>";
    }
    ?> -->
    

  <?php else: ?>
    <div class="alert alert-danger">Data tidak ditemukan.</div>
  <?php endif; ?>

  <a href="<?= base_url('Hrd/PenggajianController') ?>" class="btn btn-secondary mt-3">Kembali</a>
</div>
