<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="card mx-auto" style="max-width: 500px;">
    <div class="card-header bg-primary text-white text-center">
      Filter Laporan Gaji Pegawai
    </div>

    <form method="GET" action="<?= base_url('Staff/LaporanGajiController/cetak_laporan_gaji') ?>">
      <div class="card-body">
        
        <!-- Pilih Bulan -->
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
              foreach ($bulanList as $key => $nama) {
                echo "<option value=\"$key\">$nama</option>";
              }
            ?>
          </select>
        </div>

        <!-- Pilih Tahun -->
        <div class="form-group">
          <label for="tahun">Tahun</label>
          <select class="form-control" id="tahun" name="tahun" required>
            <option value="">Pilih Tahun</option>
            <?php
              $tahunSekarang = date('Y');
              for ($i = 2020; $i <= $tahunSekarang + 5; $i++) {
                echo "<option value=\"$i\">$i</option>";
              }
            ?>
          </select>
        </div>
        
        <?php if ($this->session->flashdata('error')): ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-info-circle"></i> <?= $this->session->flashdata('error') ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
        <?php endif; ?>


        <!-- Tombol Submit -->
        <button type="submit" class="btn btn-primary w-100 mt-3">
          <i class="fas fa-print"></i> Cetak Laporan Gaji
        </button>

      </div>
    </form>
  </div>
</div>
<!-- /.container-fluid -->
