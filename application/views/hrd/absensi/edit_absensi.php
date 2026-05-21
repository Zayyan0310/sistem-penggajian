<form action="<?php echo base_url('Hrd/AbsensiController/update_kehadiran'); ?>" method="POST">
    <!-- Hidden fields -->
    <input type="hidden" name="bulan" value="<?php echo $bulan; ?>">
    <input type="hidden" name="tahun" value="<?php echo $tahun; ?>">
    <input type="hidden" name="bulantahun" value="<?php echo $bulantahun; ?>">

    <!-- Table Wrapper -->
    <div class="table-responsive">
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
                <?php 
                $no = 1;
                foreach ($kehadiran as $a): // Iterasi data absensi
                ?>
                    <tr>
                        <!-- Hidden inputs for id_kehadiran and id_pegawai -->
                        <input type="hidden" name="id_kehadiran[]" value="<?php echo $a->id_kehadiran; ?>">
                        <input type="hidden" name="id_pegawai[]" value="<?php echo $a->id_pegawai; ?>">

                        <!-- Table Data -->
                        <td class="text-center"><?php echo $no++; ?></td>
                        <td><?php echo isset($a->nama_pegawai) ? $a->nama_pegawai : 'Nama Tidak Ditemukan'; ?></td>
                        
                        <!-- Form fields for Sakit, Cuti, Alpha, BT, and Libur -->
                        <td><input type="number" name="sakit[]" class="form-control" value="<?php echo $a->sakit; ?>" min="0"></td>
                        <td><input type="number" name="izin[]" class="form-control" value="<?php echo $a->izin; ?>" min="0"></td>
                        <td><input type="number" name="alpha[]" class="form-control" value="<?php echo $a->alpha; ?>" min="0"></td>
                        <td><input type="number" name="bt[]" class="form-control" value="<?php echo $a->bt; ?>" min="0"></td>
                        <td><input type="number" name="hadir[]" class="form-control" value="<?php echo $a->hadir; ?>" readonly></td>
                        <td><input type="number" name="holiday[]" class="form-control" value="<?php echo $a->holiday; ?>" min="0"></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Submit Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-success mt-3">Simpan</button>
    </div>
</form>
