<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
      <div class="card shadow">
        <div class="card-body">
          <form method="POST" action="<?= base_url('Pegawai/GantiPasswordController/ganti_password_aksi') ?>">
            
            <div class="form-group">
              <label for="passBaru">Password Baru</label>
              <input type="password" name="passBaru" id="passBaru" class="form-control" required>
              <?= form_error('passBaru', '<div class="text-small text-danger mt-1">', '</div>') ?>
            </div>

            <div class="form-group">
              <label for="ulangPass">Ulangi Password Baru</label>
              <input type="password" name="ulangPass" id="ulangPass" class="form-control" required>
              <?= form_error('ulangPass', '<div class="text-small text-danger mt-1">', '</div>') ?>
            </div>

            <button type="submit" class="btn btn-success w-100 mt-3">Simpan</button>

          </form>
        </div>
      </div>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
