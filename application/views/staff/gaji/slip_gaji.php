<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white text-center">
      Filter Slip Gaji Pegawai
    </div>

    <form method="POST" action="<?php echo base_url('Staff/SlipGajiController/proses_slip_gaji') ?>">
      <div class="card-body">
        
        <!-- Bulan -->
        <div class="form-group">
          <label for="bulan">Bulan</label>
          <select class="form-control" id="bulan" name="bulan" required>
            <option value="">Pilih Bulan</option>
            <?php
              $bulanList = [
                "01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April",
                "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus",
                "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember"
              ];
              foreach ($bulanList as $val => $nama) {
                echo "<option value=\"$val\">$nama</option>";
              }
            ?>
          </select>
        </div>

        <!-- Tahun -->
        <div class="form-group">
          <label for="tahun">Tahun</label>
          <select class="form-control" id="tahun" name="tahun" required>
            <option value="">Pilih Tahun</option>
            <?php
              $tahun = date('Y');
              for ($i = 2020; $i <= $tahun + 5; $i++) {
                echo "<option value=\"$i\">$i</option>";
              }
            ?>
          </select>
        </div>

        <!-- Nama Pegawai -->
        <div class="form-group">
          <label for="nama_pegawai">Nama Pegawai</label>
          <select class="form-control" id="nama_pegawai" name="nama_pegawai" required>
            <option value="">Pilih Pegawai</option>
            <?php foreach ($pegawai as $p): ?>
              <option value="<?= $p->nama_pegawai ?>"><?= $p->nama_pegawai ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <!-- Flash Message Success -->
        <?php if ($this->session->flashdata('pesan')): ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('pesan'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <!-- Flash Message Gagal -->
        <?php if ($this->session->flashdata('failed')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <?= $this->session->flashdata('failed'); ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>

        <!-- Tombol Aksi -->
        <div class="row mt-4">
          <div class="col-sm-6 mb-2">
            <button type="submit" name="aksi" value="cetak" class="btn btn-primary w-100">
              <i class="fas fa-print"></i> Cetak Slip Gaji
            </button>
          </div>
          <div class="col-sm-6 mb-2">
            <button type="submit" name="aksi" value="email" class="btn btn-success w-100">
              <i class="fas fa-envelope"></i> Kirim ke Email
            </button>
          </div>
        </div>

      </div>
    </form>
  </div>
</div>
<!-- /.container-fluid -->
