<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    <a href="<?php echo base_url('Hrd/AbsensiController/input_absensi') ?>" class="btn btn-success">
      <i class="fas fa-plus"></i> Input Absensi
    </a>
  </div>


  <div class="card mb-3">
  <div class="card-header bg-primary text-white">
    Filter Data Absensi Pegawai
  </div>
  <div class="card-body">
    <form method="GET" action="" class="mt-3">
      <div class="form-row">
    
        <div class="form-group col-12 col-md-4">
          <label>Bulan</label>
          <select class="form-control" name="bulan">
            <option value="">Pilih Bulan</option>
            <option value="01">Januari</option>
            <option value="02">Februari</option>
            <option value="03">Maret</option>
            <option value="04">April</option>
            <option value="05">Mei</option>
            <option value="06">Juni</option>
            <option value="07">Juli</option>
            <option value="08">Agustus</option>
            <option value="09">September</option>
            <option value="10">Oktober</option>
            <option value="11">November</option>
            <option value="12">Desember</option>
          </select>
        </div>
    
        <div class="form-group col-12 col-md-4">
          <label>Tahun</label>
          <select class="form-control" name="tahun">
            <option value="">Pilih Tahun</option>
            <?php $tahun = date('Y');
            for($i=2020;$i<$tahun+5;$i++) { ?>
              <option value="<?php echo $i ?>"><?php echo $i ?></option>
            <?php } ?>
          </select>
        </div>
    
        <div class="form-group col-12 col-md-4 d-flex align-items-end">
          <button type="submit" class="btn btn-primary mr-2"><i class="fas fa-eye"></i> Tampilkan </button>
        </div>
    
      </div>
    </form>

	<?php
	// AMAN: selalu set default
	$bulan = isset($_GET['bulan']) && $_GET['bulan'] != '' ? $_GET['bulan'] : date('m');
	$tahun = isset($_GET['tahun']) && $_GET['tahun'] != '' ? $_GET['tahun'] : date('Y');
	$bulantahun = $bulan . $tahun;
	?>


	<?php
  // Dapatkan total hari dan hari kerja untuk bulan dan tahun yang dipilih
	$totalHari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
	$hariKerja = 0;
	for ($i = 1; $i <= $totalHari; $i++) {
		$tanggal = $tahun . '-' . $bulan . '-' . str_pad($i, 2, '0', STR_PAD_LEFT);
		$hari = date('N', strtotime($tanggal)); // 1 = Senin, ..., 7 = Minggu
		if ($hari >= 1 && $hari <= 5) { // Senin s/d Jumat
			$hariKerja++;
		}
	}
	?>

	<div class="row mb-3">
	<div class="col-md-6">
		<div class="alert alert-secondary">
		<strong>Total Hari dalam Bulan:</strong> <?= $totalHari ?> hari
		</div>
	</div>
	<div class="col-md-6">
		<div class="alert alert-secondary">
		<strong>Total Hari Kerja:</strong> <?= $hariKerja ?> hari
		</div>
	</div>
	</div>


  </div>
</div>
</div>


	<div class="alert alert-info">
		Menampilkan Data Absensi Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
	</div>

	<?php

	$jml_data = count($absensi);
	if($jml_data > 0 ) { ?>

		<div class="container-fluid">
		  <div class="card shadow mb-4">
		   <div class="card-body">

		   <!-- Tombol Edit Absensi di atas tabel -->
			<div class="mb-3 d-flex justify-content-end">
			<a href="<?php echo base_url('Hrd/AbsensiController/edit_absensi/'.$bulan.'/'.$tahun); ?>" class="btn btn-warning">
				<i class="fas fa-edit"></i> Edit Absensi
			</a>
			</div>

		     <div class="table-responsive">
		       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		         <thead class="thead-dark">
		           <tr>
		              	<th class="text-center">No</th>
						<th class="text-center">Nama</th>
						<th class="text-center">Sakit</th>
						<th class="text-center">Cuti</th>
						<th class="text-center">BT</th>
						<th class="text-center">Alpha</th>
						<th class="text-center">Hadir</th>
						<th class="text-center">Libur</th>
						<th class="text-center">Total</th>
		           </tr>
		         </thead>
		         <tbody>
		           <?php $no=1; foreach($absensi as $a) :?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td class="text-center"><?php echo $a->nama_pegawai ?></td>
							<td class="text-center"><?php echo $a->sakit ?></td>
							<td class="text-center"><?php echo $a->izin ?></td>
							<td class="text-center"><?php echo $a->bt ?></td>
							<td class="text-center"><?php echo $a->alpha ?></td>
							<td class="text-center"><?php echo $a->hadir ?></td>
							<td class="text-center"><?php echo $a->holiday ?></td>
							<td class="text-center">
								<?php 
									$total = $a->hadir + $a->sakit + $a->alpha + $a->izin + $a->bt + $a->holiday;
									echo $total;
								?>
							</td>
						</tr>
					<?php endforeach; ?>
		         </tbody>
		       </table>
		     </div>
		   </div>
		  </div>
		</div>

<?php } else { ?>
<div class="alert alert-danger text-center mt-3">
  <i class="fas fa-info-circle"></i>
  Data masih kosong, silakan input data absensi pada bulan dan tahun yang anda pilih
</div>

<?php } ?>

</div>
<?php if ($this->session->flashdata('popup_message')): ?>
    <?php $this->load->view('popup_message'); ?>
<?php endif; ?>