<!-- Begin Page Content -->
<div class="container-fluid">

  <?php if ($this->session->flashdata('failed')) : ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <i class="fas fa-info-circle"></i> <?= $this->session->flashdata('failed'); ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  <?php endif; ?>

  <div class="card mx-auto" style="width: 100%; max-width: 450px;"> <!-- Responsive width -->
    <div class="card-header bg-primary text-white text-center">
      Filter Laporan Lembur Pegawai
    </div>

    <form method="get" action="<?= base_url('Staff/LaporanLemburController/cetak_laporan_lembur') ?>">
      <div class="card-body">
        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Bulan</label>
          <div class="col-sm-9">
            <select class="form-control" name="bulan" required>
              <option value="">Pilih Bulan</option>
              <?php
              for ($i = 1; $i <= 12; $i++) {
                $bln = str_pad($i, 2, '0', STR_PAD_LEFT);
                echo "<option value='$bln'>$bln</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="form-group row">
          <label class="col-sm-3 col-form-label">Tahun</label>
          <div class="col-sm-9">
            <select class="form-control" name="tahun" required>
              <option value="">Pilih Tahun</option>
              <?php
              $tahun = date('Y');
              for ($i = 2020; $i <= $tahun + 5; $i++) {
                echo "<option value='$i'>$i</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <button type="submit" class="btn btn-primary w-100">
          <i class="fas fa-print"></i> Cetak Laporan Lembur
        </button>
      </div>
    </form>
  </div>

</div>
<!-- /.container-fluid -->
