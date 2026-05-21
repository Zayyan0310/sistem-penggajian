<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>

    <!-- Card for Form Input -->
    <div class="card mb-3">
        <div class="card-header bg-primary text-white">
            Input Absensi Pegawai
        </div>
        <div class="card-body">
            <!-- Form for selecting bulan and tahun -->
            <form method="GET" action="" class="form-inline mb-4">
                <div class="form-group mb-2">
                    <label for="bulan">Bulan</label>
                    <select class="form-control ml-3" name="bulan" required>
                        <option value="">Pilih Bulan</option>
                        <?php
                        $bulanDipilih = $_GET['bulan'] ?? null;
                        for ($i = 1; $i <= 12; $i++) {
                            $bln = str_pad($i, 2, '0', STR_PAD_LEFT); ?>
                            <option value="<?= $bln ?>" <?= ($bln == $bulanDipilih) ? 'selected' : '' ?>>
                                <?= date("F", mktime(0, 0, 0, $i, 1)); ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group mb-2 ml-3">
                    <label for="tahun">Tahun</label>
                    <select class="form-control ml-3" name="tahun" required>
                        <option value="">Pilih Tahun</option>
                        <?php
                            $tahunSekarang = date('Y');
                            $tahunDipilih = $_GET['tahun'] ?? null;
                            for ($i = 2020; $i < $tahunSekarang + 5; $i++) { ?>
                                <option value="<?= $i ?>" <?= ($i == $tahunDipilih) ? 'selected' : '' ?>>
                                    <?= $i ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Generate Form</button>
            </form>
        </div>
    </div>

    <!-- Displaying information -->
    <div class="alert alert-info">
        Menampilkan Data Absensi Pegawai Bulan: <strong><?= $bulan ?? '-' ?></strong> Tahun: <strong><?= $tahun ?? '-' ?></strong>
    </div>


    <div class="row mb-3">
        <div class="col-md-6">
            <div class="alert alert-secondary">
                <strong>Total Hari dalam Bulan:</strong> <?= $totalHari ?> hari
            </div>
        </div>
        <div class="col-md-6">
            <div class="alert alert-secondary">
                <strong>Total Hari Kerja (Senin–Jumat):</strong> <?= $hariKerja ?> hari
            </div>
        </div>
    </div>

    <?php if ($sudah_ada): ?>
        <div class="alert alert-warning">
            <i class="fas fa-exclamation-triangle"></i>
            Data absensi untuk bulan <strong><?= $bulan ?>/<?= $tahun ?></strong> sudah pernah diinput!
        </div>
    <?php endif; ?>

    <?php if (!$sudah_ada): ?>
        <form method="POST">
            <button class="btn btn-success mb-3" type="submit" name="submit" value="submit">Simpan</button>
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Nama Pegawai</th>
                        <th class="text-center" width="8%">Sakit</th>
                        <th class="text-center" width="8%">Cuti</th>
                        <th class="text-center" width="8%">Alpha</th>
                        <th class="text-center" width="8%">BT</th>
                        <th class="text-center" width="8%">Hadir</th>
                        <th class="text-center" width="8%">Libur</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($input_absensi as $a) : ?>
                        <tr>
                            <!-- Hidden input untuk id_pegawai dan bulan -->
                            <input type="hidden" name="id_pegawai[]" value="<?= $a->id_pegawai ?>">
                            <input type="hidden" name="bulan" value="<?= $bulan ?>">
                            <input type="hidden" name="tahun" value="<?= $tahun ?>">


                            <td class="text-center"><?php echo $no++ ?></td>
                            <td><?php echo $a->nama_pegawai ?></td>
                            <td><input type="number" name="sakit[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="izin[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="alpha[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="bt[]" class="form-control" value="0" min="0"></td>
                            <td><input type="number" name="hadir[]" class="form-control" readonly></td>
                            <td><input type="number" name="holiday[]" class="form-control" value="0" min="0"></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const totalHariKerja = <?= $hariKerja ?>; // Ganti dari totalHari ke hariKerja

                    // Ambil semua baris tabel absensi
                    const rows = document.querySelectorAll('table tr');

                    rows.forEach(row => {
                        const sakit = row.querySelector('input[name="sakit[]"]');
                        const izin = row.querySelector('input[name="izin[]"]');
                        const alpha = row.querySelector('input[name="alpha[]"]');
                        const bt = row.querySelector('input[name="bt[]"]');
                        const holiday = row.querySelector('input[name="holiday[]"]');
                        const hadir = row.querySelector('input[name="hadir[]"]');

                        if (sakit && izin && alpha && bt && holiday && hadir) {
                            const inputs = [sakit, izin, alpha, bt, holiday];

                            // Fungsi perhitungan hadir otomatis
                            function updateHadir() {
                                const totalPotong =
                                    parseInt(sakit.value || 0) +
                                    parseInt(izin.value || 0) +
                                    parseInt(alpha.value || 0) +
                                    parseInt(bt.value || 0) +
                                    parseInt(holiday.value || 0);

                                const hadirValue = Math.max(totalHariKerja - totalPotong, 0);
                                hadir.value = hadirValue;
                            }

                            // Tambahkan event listener ke semua input yang memengaruhi hadir
                            inputs.forEach(input => {
                                input.addEventListener('input', updateHadir);
                            });

                            // Hitung saat pertama kali halaman dimuat juga
                            updateHadir();
                        }
                    });
                });
            </script>
        </form>
    <?php endif; ?>
</div>

<?php if ($this->session->flashdata('popup_message')): ?>
    <?php $msg = $this->session->flashdata('popup_message'); ?>
    <div class="alert alert-<?= $msg['tipe'] ?> alert-dismissible fade show" role="alert">
        <?= $msg['pesan'] ?>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
<?php endif; ?>
