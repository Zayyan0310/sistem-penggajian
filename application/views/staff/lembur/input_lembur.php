<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <div class="card mb-3">
    <div class="card-header bg-primary text-white">
      Input Lembur Pegawai
    </div>
    <div class="card-body">
      <form method="GET" action="">
        <div class="form-row">
          <div class="form-group col-md-4">
            <label>Bulan</label>
            <select class="form-control" name="bulan" required>
              <option value="">Pilih Bulan</option>
              <?php for ($i = 1; $i <= 12; $i++): ?>
                <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>"><?= date('F', mktime(0,0,0,$i,10)) ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group col-md-4">
            <label>Tahun</label>
            <select class="form-control" name="tahun" required>
              <option value="">Pilih Tahun</option>
              <?php $thn = date('Y'); for ($i = 2020; $i <= $thn + 5; $i++): ?>
                <option value="<?= $i ?>"><?= $i ?></option>
              <?php endfor; ?>
            </select>
          </div>
          <div class="form-group col-md-4 align-self-end">
            <button type="submit" class="btn btn-primary"><i class="fas fa-eye"></i> Generate Form</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <?php if ($bulan && $tahun): ?>
    <div class="alert alert-info">
        Menampilkan Form Lembur Bulan: <strong><?= $bulan ?></strong> Tahun: <strong><?= $tahun ?></strong>
    </div>

    <?php if ($sudah_ada): ?>
        <div class="alert alert-warning">
        <i class="fas fa-exclamation-triangle"></i>
        Data lembur untuk bulan <strong><?= $bulan ?>/<?= $tahun ?></strong> sudah pernah diinput!
        </div>
    <?php else: ?>
        <!-- FORM INPUT -->
        <form method="POST" action="<?= base_url('Staff/LemburController/simpan') ?>">
        <input type="hidden" name="bulantahun" value="<?= $bulantahun ?>">
        <button class="btn btn-success mb-3" type="submit">Simpan</button>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">NIK</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Jumlah Jam Lembur</th>
            </tr>
            </thead>
            <tbody>
            <?php $no = 1; foreach ($pegawai as $p): ?>
                <tr>
                <input type="hidden" name="id_pegawai[]" value="<?= $p->id_pegawai ?>">
                <td class="text-center"><?= $no++ ?></td>
                <td class="text-center"><?= $p->nik ?></td>
                <td><?= $p->nama_pegawai ?></td>
                <td><input type="number" name="jumlah_jam[]" class="form-control" step="0.5" min="0" value="0"></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        </form>
    <?php endif; ?>
    <?php endif; ?>
</div>
