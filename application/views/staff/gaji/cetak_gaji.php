<!DOCTYPE html>
<html>
<head>
	<title><?= $title ?></title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			color: black;
			background-size: cover;
			background-repeat: no-repeat;
			background-position: center;
		}
		@media print {
			body {
				-webkit-print-color-adjust: exact;
				print-color-adjust: exact;
				background-image: url('<?= base_url('assets/img/perusahaan.png') ?>');
			}
			img { display: block !important; }
		}
		.container {
			background-color: rgba(255, 255, 255, 0.95);
			padding: 25px;
			border-radius: 10px;
			margin: 30px auto;
			width: 95%;
			box-shadow: 0 0 5px rgba(0,0,0,0.2);
		}
		table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
			font-size: 14px;
		}
		th, td {
			border: 1px solid #000;
			padding: 8px;
			text-align: center;
		}
		th {
			background-color: #f0f0f0;
		}
		.text-left {
			text-align: left;
		}
		.signature {
			width: 200px;
			text-align: center;
			float: right;
			margin-top: 50px;
		}
	</style>
</head>
<body>
<?php
	$bulan = $filter_bulan ?? date('m');
	$tahun = $filter_tahun ?? date('Y');
?>
<div class="container">
	<center>
		<img src="<?= base_url('assets/img/perusahaan.png') ?>" alt="Logo" style="width:180px; margin-bottom:10px;">
		<h2 style="margin-bottom: 5px;">DAFTAR GAJI PEGAWAI</h2>
		<small>Periode: <?= $bulan . ' - ' . $tahun ?></small>
	</center>

	<table style="margin-top: 20px; width: 300px;">
		<tr><td class="text-left">Bulan</td><td class="text-left">:</td><td class="text-left"><?= $bulan ?></td></tr>
		<tr><td class="text-left">Tahun</td><td class="text-left">:</td><td class="text-left"><?= $tahun ?></td></tr>
	</table>

	<table>
		<thead>
			<tr>
				<th>No</th>
				<th>NIK</th>
				<th>Nama Pegawai</th>
				<th>Gaji Pokok</th>
				<th>Tj. Transport</th>
				<th>Uang Makan</th>
				<th>Nominal Lembur</th>
				<th>Pot. Alpha</th>
				<th>BPJS, JKM, JKK</th>
				<th>PPh 21</th>
				<th><strong>Gaji Bersih</strong></th>
			</tr>
		</thead>
		<tbody>
			<?php $no = 1; foreach($gaji_list as $g): 
				$jumlah_lembur = $g->jumlah_lembur ?? 0;
				$tarif_lembur = $g->tarif_lembur ?? 0;
				$nominal_lembur = $jumlah_lembur * $tarif_lembur;
				$bpjs_jkm_jkk = ($g->bpjs ?? 0) + ($g->jkm ?? 0) + ($g->jkk ?? 0);
			?>
			<tr>
				<td><?= $no++ ?></td>
				<td><?= $g->nik ?></td>
				<td class="text-left"><?= $g->nama_pegawai ?></td>
				<td>Rp <?= number_format($g->gaji_pokok ?? 0, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($g->tj_transport ?? 0, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($g->uang_makan ?? 0, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($nominal_lembur, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($g->potongan_alpha ?? 0, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($bpjs_jkm_jkk, 0, ',', '.') ?></td>
				<td>Rp <?= number_format($g->pph21 ?? 0, 0, ',', '.') ?></td>
				<td><strong>Rp <?= number_format($g->gaji_bersih ?? 0, 0, ',', '.') ?></strong></td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="signature">
		<p>Jakarta, <?= date("d M Y") ?><br>Finance</p>
		<br><br><br>
		<p>_________________________</p>
	</div>
</div>

<script>window.print();</script>
</body>
</html>
