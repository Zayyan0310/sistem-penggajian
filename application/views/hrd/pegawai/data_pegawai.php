<div class="container-fluid">
	<div class="d-sm-flex align-items-center justify-content-between mb-4">
		<h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
	</div>
	<a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('Hrd/PegawaiController/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Pegawai</a>
	<?php echo $this->session->flashdata('pesan') ?>
</div>

<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead class="thead-dark">
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">NIK</th>
							<th class="text-center">Nama Pegawai</th>
							<th class="text-center">Jenis Kelamin</th>
							<th class="text-center">Jabatan</th>
							<th class="text-center">Jenis TER</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">No. HP</th>
							<th class="text-center">Tanggal Masuk</th>
							<th class="text-center">Status</th>
							<th class="text-center">Hak Akses</th>
							<th class="text-center">Photo</th>
							<th class="text-center">Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php $no = 1;
						foreach ($pegawai as $p) : ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td class="text-center"><?php echo $p->nik ?></td>
								<td class="text-center"><?php echo $p->nama_pegawai ?></td>
								<td class="text-center"><?php echo $p->jenis_kelamin ?></td>
								<td class="text-center">
								<?php
									foreach ($jabatan as $j) {
										if ($p->id_jabatan == $j->id_jabatan) {
											echo $j->nama_jabatan;
											break;
										}
									}
								?>
								</td>
								<td class="text-center"><?= $p->jenis_TER ?></td>
								<td class="text-center"><?php echo $p->alamat ?></td>
        						<td class="text-center"><?php echo $p->no_hp ?></td>
								<td class="text-center"><?php echo $p->tanggal_masuk ?></td>
								<td class="text-center"><?php echo $p->status ?></td>
								<?php if ($p->id_akses == '1') { ?>
									<td>Staff</td>
								<?php } elseif ($p->id_akses == '2') { ?>
									<td>Pegawai</td>
								<?php } elseif ($p->id_akses == '3') { ?>
									<td>HRD</td>
								<?php } else { ?>
									<td>Tidak Diketahui</td>
								<?php } ?>

								<td>
									<?php if ($p->photo) : ?>
										<img src="<?php echo base_url() . 'photo/' . $p->photo ?>" width="50px">
									<?php elseif ($p->jenis_kelamin == 'Laki-Laki') : ?>
										<img src="<?php echo base_url() . 'assets/default-laki-laki.png' ?>" width="50px">
									<?php else : ?>
										<img src="<?php echo base_url() . 'assets/default-perempuan.png' ?>" width="50px">
									<?php endif ?>
								</td>

								<td>
									<center>
										<a class="btn btn-sm btn-info" href="<?php echo base_url('Hrd/PegawaiController/update_data/'.$p->id_pegawai) ?>">
											<i class="fas fa-edit"></i>
										</a>

										<button class="btn btn-sm btn-danger btn-delete" data-url="<?php echo base_url('Hrd/PegawaiController/delete_data/'.$p->id_pegawai) ?>">
											<i class="fas fa-trash"></i>
										</button>
									</center>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php if ($this->session->flashdata('popup_message')): ?>
    <?php $this->load->view('popup_message'); ?>
<?php endif; ?>
<?php $this->load->view('popup'); ?>