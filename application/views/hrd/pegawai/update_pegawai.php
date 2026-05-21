<!-- Begin Page Content -->
<div class="container-fluid">

	<!-- Page Heading -->
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>
	
	<div class="card responsive-card mx-auto" style="width: 85% ; margin-bottom: 100px">
	<div class="card-body">

		<?php foreach ($pegawai as $p) : ?>
			<form method="POST" action="<?php echo base_url('Hrd/PegawaiController/update_data_aksi') ?>" enctype="multipart/form-data">

				<div class="form-group">
					<label>NIK</label>
					<input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $p->id_pegawai ?>" required>
					<input type="number" name="nik" class="form-control" value="<?php echo $p->nik ?>">
					<?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
				</div>


				<div class="form-group">
					<label>NIK</label>
					<input type="hidden" name="id_pegawai" class="form-control" value="<?php echo $p->id_pegawai ?>" required>
					<input type="number" name="nik" class="form-control" value="<?php echo $p->nik ?>">
					<?php echo form_error('nik', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Nama Pegawai</label>
					<input type="text" name="nama_pegawai" class="form-control" value="<?php echo $p->nama_pegawai ?>" required>
					<?php echo form_error('nama_pegawai', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Nama Bank</label>
					<input type="text" name="namabank" class="form-control" value="<?php echo $p->namabank ?>" required>
					<?php echo form_error('namabank', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Nomor Rekening</label>
					<input type="number" name="norekening" class="form-control" value="<?php echo $p->norekening ?>" required>
					<?php echo form_error('norekening', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Username</label>
					<input type="text" name="username" class="form-control" value="<?php echo $p->username ?>" required>
					<?php echo form_error('username', '<div class="text-small text-danger"> </div>') ?>
				</div>
				

				<div class="form-group">
					<label>Email</label>
					<input type="text" name="email" class="form-control" value="<?php echo $p->email ?>" required>
					<?php echo form_error('email', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Jenis Kelamin</label>
					<select name="jenis_kelamin" class="form-control" value="<?php echo $p->id_pegawai ?>" required>
						<option value="<?php echo $p->jenis_kelamin ?>"><?php echo $p->jenis_kelamin ?></option>
						<option value="Laki-Laki">Laki-Laki</option>
						<option value="Perempuan">Perempuan</option>
					</select>
					<?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Jabatan</label>
					<select name="id_jabatan" class="form-control" required>
						<option value="">--Pilih Jabatan--</option>
						<?php foreach ($jabatan as $j) : ?>
							<option value="<?php echo $j->id_jabatan ?>" 
								<?php echo ($p->id_jabatan == $j->id_jabatan) ? 'selected' : '' ?>>
								<?php echo $j->nama_jabatan ?>
							</option>
						<?php endforeach; ?>
					</select>
				</div>

				<!-- Jenis TER -->
				<div class="form-group">
					<label>Jenis TER</label>
					<select name="jenis_TER" class="form-control" required>
						<option value="">-- Pilih Jenis TER --</option>
						<option value="TER A" <?= $p->jenis_TER == 'TER A' ? 'selected' : '' ?>>TER A</option>
						<option value="TER B" <?= $p->jenis_TER == 'TER B' ? 'selected' : '' ?>>TER B</option>
						<option value="TER C" <?= $p->jenis_TER == 'TER C' ? 'selected' : '' ?>>TER C</option>
					</select>
				</div>


				<div class="form-group">
					<label>Alamat</label>
					<input type="text" name="alamat" class="form-control" value="<?php echo $p->alamat ?>">
					<?php echo form_error('alamat','<div class="text-small text-danger">','</div>') ?>
				</div>

				<div class="form-group">
					<label>No. HP</label>
					<input type="number" name="no_hp" class="form-control" value="<?php echo $p->no_hp ?>">
					<?php echo form_error('no_hp','<div class="text-small text-danger">','</div>') ?>
				</div>

				<div class="form-group">
					<label>Tanggal Masuk</label>
					<input type="date" name="tanggal_masuk" class="form-control" value="<?php echo $p->tanggal_masuk ?>" required>
					<?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Status</label>
					<select name="status" class="form-control" required>
						<option value="<?php echo $p->status ?>"><?php echo $p->status ?></option>
						<option value="Karyawan Tetap">Karyawan Tetap</option>
						<option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
					</select>
					<?php echo form_error('status', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Hak Akses</label>
					<select name="id_akses" class="form-control" required>
						<option value="">--Pilih Hak Akses--</option>
						<option value="1" <?= ($p->id_akses == 1) ? 'selected' : '' ?>>Staff</option>
						<option value="2" <?= ($p->id_akses == 2) ? 'selected' : '' ?>>Pegawai</option>
						<option value="3" <?= ($p->id_akses == 3) ? 'selected' : '' ?>>HRD</option>
					</select>
					<?php echo form_error('id_akses', '<div class="text-small text-danger"> </div>') ?>
				</div>

				<div class="form-group">
					<label>Photo</label>
					<input type="file" name="photo" class="form-control">
				</div>

				<button type="submit" class="btn btn-success mt-3">Simpan</button>
				<a href="<?php echo base_url('Hrd/PegawaiController') ?>" class="btn btn-warning mt-3">Kembali</a>

			</form>
			
		<?php endforeach; ?>
	</div>
</div>

</div>
<!-- /.container-fluid -->


