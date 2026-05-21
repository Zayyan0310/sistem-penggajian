<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="card mb-3">
    <div class="card-header bg-primary text-white">Edit Data Lembur Pegawai</div>
    <div class="card-body">
      <form action="<?= base_url('Staff/LemburController/update_lembur') ?>" method="POST">
        <!-- Hidden fields -->
        <input type="hidden" name="bulan" value="<?= $bulan ?>">
        <input type="hidden" name="tahun" value="<?= $tahun ?>">
        <input type="hidden" name="bulantahun" value="<?= $bulantahun ?>">

        <!-- Table Wrapper -->
        <div class="table-responsive">
          <table class="table table-bordered table-striped">
            <thead class="thead-dark">
              <tr>
                <th class="text-center">No</th>
                <th class="text-center">Nama Pegawai</th>
                <th class="text-center" width="20%">Jumlah Jam Lembur</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1; foreach ($lembur as $l): ?>
                <tr>
                  <!-- Hidden inputs for id_pegawai -->
                  <input type="hidden" name="id_lembur[]" value="<?= $l->id_lembur ?>">
                  <input type="hidden" name="id_pegawai[]" value="<?= $l->id_pegawai ?>">

                  <td class="text-center"><?= $no++ ?></td>
                  <td><?= $l->nama_pegawai ?></td>
                  <td><input type="number" name="jumlah_jam[]" class="form-control" value="<?= $l->jumlah_jam ?>" min="0"></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>

        <!-- Submit Button -->
        <div class="form-group text-center">
          <button type="submit" class="btn btn-success mt-3">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>
