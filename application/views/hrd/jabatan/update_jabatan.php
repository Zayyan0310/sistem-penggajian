<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  
  <div class="card responsive-card mx-auto" style="width: 85% ; margin-bottom: 100px">
	<div class="card-body">
		<?php foreach ($jabatan as $j): ?>
		<form method="POST" action="<?php echo base_url('Hrd/JabatanController/update_data_aksi')?>">
			
			<div class="form-group">
				<label>Nama Jabatan</label>
				<input type="hidden" name="id_jabatan" class="form-control" value="<?php echo $j->id_jabatan?>">
				<input type="text" name="nama_jabatan" class="form-control" value="<?php echo $j->nama_jabatan?>">
				<?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Gaji Pokok</label>
				<input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control" value="<?php echo $j->gaji_pokok?>">
				<?php echo form_error('gaji_pokok', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Tunjangan Transport</label>
				<input type="number" name="tj_transport" id="tj_transport" class="form-control" value="<?php echo $j->tj_transport?>">
				<?php echo form_error('tj_transport', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Uang Makan</label>
				<input type="number" name="uang_makan" id="uang_makan" class="form-control" value="<?php echo $j->uang_makan?>">
				<?php echo form_error('uang_makan', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>BPJS (5% dari Gaji Pokok)</label>
				<input type="number" name="bpjs" id="bpjs" class="form-control" value="<?= $j->bpjs ?>" readonly>
			</div>

			<div class="form-group">
				<label>JKM (0.3% dari Gaji Pokok)</label>
				<input type="number" name="jkm" id="jkm" class="form-control" value="<?= $j->jkm ?>" readonly>
			</div>

			<div class="form-group">
				<label>JKK (1.74% dari Gaji Pokok)</label>
				<input type="number" name="jkk" id="jkk" class="form-control" value="<?= $j->jkk ?>" readonly>
			</div>

			<div class="form-group">
				<label>Tarif Lembur (/jam)</label>
				<input type="number" name="tarif_lembur" id="tarif_lembur" class="form-control" value="<?= $j->tarif_lembur ?>" readonly>
			</div>

			<div class="form-group">
				<label>Total</label>
				<input type="number" name="total" id="total" class="form-control" value="<?= $j->total ?>" readonly>
			</div>


			<script>
			function hitungSemua() {
				const gajiPokok = parseFloat(document.getElementById('gaji_pokok').value || 0);
				const uangMakan = parseFloat(document.getElementById('uang_makan').value || 0);
				const transport = parseFloat(document.getElementById('tj_transport').value || 0);

				const bruto = gajiPokok + uangMakan + transport;

				const bpjs = gajiPokok * 0.05;
				const jkm = gajiPokok * 0.003;
				const jkk = gajiPokok * 0.0174;
				const lembur = gajiPokok / 173;

				const total = bruto + bpjs + jkm + jkk;

				document.getElementById('gaji_bruto').value = Math.floor(bruto);
				document.getElementById('bpjs').value = Math.floor(bpjs);
				document.getElementById('jkm').value = Math.floor(jkm);
				document.getElementById('jkk').value = Math.floor(jkk);
				document.getElementById('tarif_lembur').value = Math.floor(lembur);
				document.getElementById('total').value = Math.floor(total);
			}

			// Jalankan saat form dibuka
			hitungSemua();

			// Trigger saat input berubah
			document.getElementById('gaji_pokok').addEventListener('input', hitungSemua);
			document.getElementById('uang_makan').addEventListener('input', hitungSemua);
			document.getElementById('tj_transport').addEventListener('input', hitungSemua);
			</script>


			<button type="submit" class="btn btn-success" >Simpan</button>
			<a href="<?php echo base_url('Hrd/JabatanController')?>" class="btn btn-warning">Kembali</a>

		</form>
	<?php endforeach; ?>
	</div>
</div>

</div>
<!-- /.container-fluid -->

