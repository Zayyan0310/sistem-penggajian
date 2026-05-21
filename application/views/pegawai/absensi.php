<!-- Page Heading -->
<div class="container">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

    <form method="POST" action="<?= base_url('Pegawai/AbsensiController') ?>" class="mb-3">
      <div class="form-row align-items-end">
        
        <div class="col-12 col-sm-6 col-md-3 mb-2">
          <label for="bulan">Bulan</label>
          <select name="bulan" class="form-control" id="bulan" required>
            <?php for ($m = 1; $m <= 12; $m++): ?>
              <option value="<?= str_pad($m, 2, '0', STR_PAD_LEFT) ?>" <?= $bulan == str_pad($m, 2, '0', STR_PAD_LEFT) ? 'selected' : '' ?>>
                <?= date('F', mktime(0, 0, 0, $m, 10)) ?>
              </option>
            <?php endfor; ?>
          </select>
        </div>
        
        <div class="col-12 col-sm-6 col-md-3 mb-2">
          <label for="tahun">Tahun</label>
          <select name="tahun" class="form-control" id="tahun" required>
            <?php
              $currentYear = date('Y');
              for ($y = $currentYear - 5; $y <= $currentYear; $y++): ?>
              <option value="<?= $y ?>" <?= $tahun == $y ? 'selected' : '' ?>><?= $y ?></option>
            <?php endfor; ?>
          </select>
        </div>
        
        <div class="col-12 col-sm-12 col-md-3 mb-2">
          <button type="submit" class="btn btn-primary btn-block">Tampilkan</button>
        </div>
        
      </div>
    </form>


  <h5 class="mt-4">
    Data Absensi Bulan: <?= date("F", mktime(0, 0, 0, $bulan, 10)) ?> <?= $tahun ?>
  </h5>

  <div class="table-responsive">
    <table class="table table-bordered table-striped table-hover text-center">
      <thead class="thead-dark">
        <tr>
          <th>NIK</th>
          <th>Name</th>
          <th>Sick</th>
          <th>Annual Leave</th>
          <th>BT</th>
          <th>Off</th>
          <th>Presence</th>
          <th>Holiday</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        <?php if (!empty($absen)): ?>
          <?php foreach ($absen as $a): ?>
            <tr>
              <td><?= $a->nik ?></td>
              <td class="text-center"><?= $nama_pegawai ?></td>
              <td><?= $a->sakit ?></td>
              <td><?= $a->izin ?></td>
              <td><?= $a->bt ?></td>
              <td><?= $a->alpha ?></td>
              <td><?= $a->hadir ?></td>
              <td><?= $a->holiday ?></td>
              <td>
                <?php 
                  $total = $a->hadir + $a->sakit + $a->alpha + $a->izin + $a->bt + $a->holiday;
                  echo $total;
                ?>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="9" class="text-center">Data tidak ditemukan.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</div>
