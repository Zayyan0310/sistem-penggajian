<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
  </div>

  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success">
      <?= $this->session->flashdata('success') ?>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger">
      <?= $this->session->flashdata('error') ?>
    </div>
  <?php endif; ?>

  <div class="card mx-auto" style="width: 100%; max-width: 500px;">
    <div class="card-body">
      <form method="POST" action="<?php echo base_url('Staff/GantiPasswordController/ganti_password_aksi') ?>">
        
        <div class="form-group">
          <label>Password Baru</label>
          <input type="password" name="passBaru" class="form-control">
          <?php echo form_error('passBaru', '<div class="text-small text-danger">', '</div>') ?>
        </div>

        <div class="form-group">
          <label>Ulangi Password Baru</label>
          <input type="password" name="ulangPass" class="form-control">
          <?php echo form_error('ulangPass', '<div class="text-small text-danger">', '</div>') ?>
        </div>

        <button type="submit" class="btn btn-success mt-3 w-100">Simpan</button>
      </form>
    </div>
  </div>

</div>
<!-- /.container-fluid -->
