<!DOCTYPE html>
<html>

<head>
	<title><?php echo $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial;
			color: black;
		}
	</style>
</head>

<body>
	<center>
		<img src="<?php echo base_url('assets/img/perusahaan.png'); ?>" alt="perusahaan" style="width: 200px; margin-bottom: 10px;">
		<h1>PT. MUTIARA JAWA</h1>
		<h2>Laporan Absensi Pegawai</h2>
	</center>

	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun ?></td>
		</tr>
	</table>

	<table class="table table-bordered table-triped">
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
		<?php $no = 1;
		foreach ($lap_kehadiran as $l) : ?>
			<tr>
				<td class="text-center"><?php echo $no++ ?></td>
				<td class="text-center"><?php echo $l->nama_pegawai ?></td>
				<td class="text-center"><?php echo $b = $l->sakit ?></td>
				<td class="text-center"><?php echo $d = $l->izin ?></td>
				<td class="text-center"><?php echo $e = $l->bt ?></td>
				<td class="text-center"><?php echo $c = $l->alpha ?></td>
				<td class="text-center"><?php echo $a = $l->hadir ?></td>
				<td class="text-center"><?php echo $f = $l->holiday ?></td>
				<td class="text-center"><?php echo $a + $b + $c + $d + $e + $f ?></td>
			</tr>
		<?php endforeach; ?>
	</table>

</body>

</html>

<script type="text/javascript">
	window.print();
</script>
