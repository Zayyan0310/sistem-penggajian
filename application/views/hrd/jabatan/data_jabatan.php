<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('Hrd/JabatanController/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah Jabatan</a>
  <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
  <div class="card shadow mb-4">
   <div class="card-body">
     <div class="table-responsive">
       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
         <thead class="thead-dark">
          <tr class="text-center">
            <tr class="text-center">
              <th>No</th>
              <th>Nama Jabatan</th>
              <th>Gaji Pokok</th>
              <th>Uang Makan</th>
              <th>Transport</th>
              <th>BPJS (5%)</th>
              <th>JKM (0.3%)</th>
              <th>JKK (1.74%)</th>
              <th>Lembur/Jam</th>
              <th>Total</th>
              <th>Actions</th>
            </tr>
          </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($jabatan as $j): 
                $bpjs = $j->gaji_pokok * 0.05;     // BPJS 5%
                $jkm = $j->gaji_pokok * 0.003;     // JKM 0.3%
                $jkk = $j->gaji_pokok * 0.0174;     // JKK 1.74%
                $tarif_lembur = $j->gaji_pokok / 173;

                $total = $j->gaji_pokok + $j->tj_transport + $j->uang_makan + $bpjs + $jkm + $jkk;
            ?>
              <tr class="text-center">
                <td><?= $no++ ?></td>
                <td><?= $j->nama_jabatan ?></td>
                <td>Rp. <?= number_format($j->gaji_pokok, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($j->uang_makan, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($j->tj_transport, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($bpjs, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($jkm, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($jkk, 0, ',', '.') ?></td>
                <td>Rp. <?= number_format($tarif_lembur, 0, ',', '.') ?> / jam</td>
                <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
                <td>
                  <a href="<?= base_url('Hrd/JabatanController/update_data/' . $j->id_jabatan) ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                  <button class="btn btn-sm btn-danger btn-delete" data-url="<?= base_url('Hrd/JabatanController/delete_data/' . $j->id_jabatan) ?>"><i class="fas fa-trash"></i></button>
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
