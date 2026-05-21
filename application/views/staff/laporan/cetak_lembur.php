<!DOCTYPE html>
<html>

<head>
    <title><?php echo $title ?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }
        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    <center>
        <img src="<?php echo base_url('assets/img/perusahaan.png'); ?>" alt="perusahaan" style="width: 200px; margin-bottom: 10px;">
        <h1>PT. MUTIARA JAWA</h1>
        <h2>Laporan Lembur Pegawai</h2>
    </center>

    <table style="width: 300px; margin-top: 10px;">
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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pegawai</th>
                <th>Jumlah Jam</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            $total_jam = 0;
            foreach ($lap_lembur as $l) : 
                $total_jam += $l->jumlah_jam;
            ?>
            <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $l->nama_pegawai ?></td>
                <td><?php echo $l->jumlah_jam ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td colspan="2"><strong>Total Jam Lembur</strong></td>
                <td colspan="1"><strong><?php echo $total_jam ?> Jam</strong></td>
            </tr>
        </tbody>
    </table>
</body>

</html>

<script type="text/javascript">
    window.print();
</script>
