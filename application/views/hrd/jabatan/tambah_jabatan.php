<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  
  <div class="card responsive-card mx-auto" style="width: 85% ; margin-bottom: 100px">
	<div class="card-body">
		<form method="POST" action="<?php echo base_url('Hrd/JabatanController/tambah_data_aksi')?>">

			<div class="form-group">
				<label>Nama Jabatan</label>
				<input type="text" name="nama_jabatan" class="form-control">
				<?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Gaji Pokok</label>
				<input type="number" name="gaji_pokok" id="gaji_pokok" class="form-control">
				<?php echo form_error('gaji_pokok', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Tunjangan Transport</label>
				<input type="number" name="tj_transport" id="tj_transport" class="form-control">
				<?php echo form_error('tj_transport', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Uang Makan</label>	
				<input type="number" name="uang_makan" id="uang_makan" class="form-control">
				<?php echo form_error('uang_makan', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>BPJS (5% dari Gaji Pokok)</label>
				<input type="number" name="bpjs" id="bpjs" class="form-control" value="" readonly>
			</div>

			<div class="form-group">
				<label>JKM (0.3% dari Gaji Pokok)</label>
				<input type="number" name="jkm" id="jkm" class="form-control" readonly>
			</div>

			<div class="form-group">
				<label>JKK (1.74% dari Gaji Pokok)</label>
				<input type="number" name="jkk" id="jkk" class="form-control" readonly>
			</div>

			<div class="form-group">
				<label>Tarif Lembur (/jam)</label>
				<input type="number" name="tarif_lembur" id="tarif_lembur" class="form-control" readonly>
			</div>

			<div class="form-group">
				<label>Total</label>
				<input type="number" name="total" id="total" class="form-control" readonly>
			</div>


			<script>
			// Fungsi untuk menghitung semua nilai otomatis
			function hitungSemua() {
				const gajiPokok = parseFloat(document.getElementById('gaji_pokok').value || 0);
				const uangMakan = parseFloat(document.getElementById('uang_makan').value || 0);
				const transport = parseFloat(document.getElementById('tj_transport').value || 0);

				// Menghitung gaji bruto
				const bruto = gajiPokok + uangMakan + transport;

				// Menghitung potongan BPJS, JKM, JKK
				const bpjs = gajiPokok * 0.05;  // BPJS 5%
				const jkm = gajiPokok * 0.003;  // JKM 0.3%
				const jkk = gajiPokok * 0.0174;  // JKK 1.74%
				
				// Menghitung tarif lembur (gaji pokok per jam)
				const lembur = gajiPokok / 173;

				// Menghitung total gaji
				const total = bruto + bpjs + jkm + jkk;

				// Menampilkan hasil perhitungan di input form
				document.getElementById('bpjs').value = Math.floor(bpjs);
				document.getElementById('jkm').value = Math.floor(jkm);
				document.getElementById('jkk').value = Math.floor(jkk);
				document.getElementById('tarif_lembur').value = Math.floor(lembur);
				document.getElementById('total').value = Math.floor(total);
			}

			// Menambahkan event listener pada setiap input agar perhitungan otomatis
			document.getElementById('gaji_pokok').addEventListener('input', hitungSemua);
			document.getElementById('uang_makan').addEventListener('input', hitungSemua);
			document.getElementById('tj_transport').addEventListener('input', hitungSemua);
			</script>

			<button type="submit" class="btn btn-success" >Simpan</button>
			<button type="reset" class="btn btn-danger" >Reset</button>
			<a href="<?php echo base_url('Hrd/JabatanController')?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>

</div>
<!-- /.container-fluid -->
