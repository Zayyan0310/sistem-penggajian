<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>Bulan/Tahun</th>
          <th>Gaji Pokok</th>
          <th>Tj. Transport</th>
          <th>Uang Makan</th>
          <th>BPJS</th>
          <th>Potongan Alpha</th>
          <th>Total Gaji</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        foreach ($gaji as $g): 
            $bpjs = isset($g->potongan_bpjs) ? $g->potongan_bpjs : 0;
            $alpha = isset($g->alpha) ? $g->alpha : 0;
            $potonganAlpha = $alpha * $alphaRate;
            $totalGaji = $g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potonganAlpha - $bpjs;
        ?>
        <tr>
          <td><?= $g->bulan ?></td>
          <td>Rp. <?= number_format($g->gaji_pokok, 0, ',', '.') ?></td>
          <td>Rp. <?= number_format($g->tj_transport, 0, ',', '.') ?></td>
          <td>Rp. <?= number_format($g->uang_makan, 0, ',', '.') ?></td>
          <td>Rp. <?= number_format($bpjs, 0, ',', '.') ?></td>
          <td>Rp. <?= number_format($potonganAlpha, 0, ',', '.') ?></td>
          <td>Rp. <?= number_format($totalGaji, 0, ',', '.') ?></td>
          <td class="text-center">
            <a class="btn btn-sm btn-primary" href="<?= base_url('Pegawai/GajiController/cetak_slip/' . $g->id_kehadiran) ?>">
              <i class="fas fa-print"></i>
            </a>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</div>
<!-- /.container-fluid -->
