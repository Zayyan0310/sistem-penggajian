<?php
  $bulan = isset($_GET['bulan']) && $_GET['bulan'] != '' ? $_GET['bulan'] : '';
  $tahun = isset($_GET['tahun']) && $_GET['tahun'] != '' ? $_GET['tahun'] : '';
  $bulantahun = $bulan . $tahun;
?>

<div class="container-fluid">
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <!-- Filter Card -->
  <div class="card mb-4">
    <div class="card-header bg-primary text-white">Filter Data Gaji Pegawai</div>
    <div class="card-body">
      <form method="GET" action="">
        <div class="form-row align-items-end">
          <!-- Dropdown Bulan -->
          <div class="form-group col-md-4">
            <label>Bulan</label>
            <select class="form-control" name="bulan">
              <option value="">Pilih Bulan</option>
              <?php 
                $bulanList = [
                  "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April",
                  "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus",
                  "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
                ];
                foreach ($bulanList as $key => $nama) {
                  $selected = isset($bulan) && $bulan == $key ? "selected" : "";
                  echo "<option value='$key' $selected>$nama</option>";
                }
              ?>
            </select>
          </div>

          <!-- Dropdown Tahun -->
          <div class="form-group col-md-4">
            <label>Tahun</label>
            <select class="form-control" name="tahun">
              <option value="">Pilih Tahun</option>
              <?php 
                $currentYear = date('Y');
                for ($i = 2020; $i <= $currentYear + 5; $i++): 
              ?>
                <option value="<?= $i ?>" <?= isset($tahun) && $tahun == $i ? 'selected' : '' ?>><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>

          <!-- Tombol Tampilkan -->
          <div class="form-group col-md-4">
            <button type="submit" class="btn btn-primary btn-block">
              <i class="fas fa-eye"></i> Tampilkan
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php if ($bulan && $tahun): ?>
    <!-- Alert Info -->
    <div class="alert alert-info">
      Menampilkan Data Gaji Pegawai Bulan: <strong><?= $bulan ?></strong> Tahun: <strong><?= $tahun ?></strong>
    </div>

    <!-- Tabel Data -->
    <?php if (count($gaji) > 0): ?>
      <div class="card shadow mb-4">
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
              <thead class="thead-dark">
                <tr>
                  <th>No</th>
                  <th>NIK</th>
                  <th>Nama Pegawai</th>
                  <th>Status Gaji</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; foreach ($gaji as $g): ?>
                <tr>
                  <td><?= $no++ ?></td>
                  <td><?= $g->nik ?></td>
                  <td><?= $g->nama_pegawai ?></td>
                  <td><div id="status_gaji_info" class="status-gaji">
                          <strong><?php echo !empty($g->status_gaji) ? $g->status_gaji : 'Belum Dikirim'; ?></strong>
                      </div></td>
                  <td><a href="<?= base_url("Hrd/PenggajianController/detail_slip?bulan=$bulan&tahun=$tahun&id_pegawai=" . $g->id_pegawai) ?>" 
                      class="btn btn-info btn-sm">
                      <i class="fas fa-eye"></i> Detail
                    </a></td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php else: ?>
      <div class="alert alert-danger">
        <i class="fas fa-info-circle"></i> Data absensi kosong. Silakan input data kehadiran terlebih dahulu untuk bulan dan tahun yang dipilih.
      </div>
    <?php endif; ?>
  <?php endif; ?>
</div>

<!-- Modal jika data kosong -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Informasi</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Data gaji masih kosong. Silakan input kehadiran terlebih dahulu pada bulan dan tahun yang Anda pilih.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
