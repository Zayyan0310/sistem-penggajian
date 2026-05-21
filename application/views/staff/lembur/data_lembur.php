<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-3">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    <a href="<?php echo base_url('Staff/LemburController/input_lembur') ?>" class="btn btn-success">
      <i class="fas fa-plus"></i> Input Lembur
    </a>
  </div>

  <div class="card mb-3">
    <div class="card-header bg-primary text-white">
      Filter Data Lembur Pegawai
    </div>
    <div class="card-body">
      <form method="GET" action="" class="mt-3">
        <div class="form-row">

          <div class="form-group col-12 col-md-4">
            <label>Bulan</label>
            <select class="form-control" name="bulan">
              <option value="">Pilih Bulan</option>
              <?php for ($b=1; $b<=12; $b++): ?>
                <option value="<?= str_pad($b, 2, '0', STR_PAD_LEFT) ?>">
                  <?= date('F', mktime(0,0,0,$b,10)) ?>
                </option>
              <?php endfor; ?>
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
      $bulan = isset($_GET['bulan']) && $_GET['bulan'] != '' ? $_GET['bulan'] : date('m');
      $tahun = isset($_GET['tahun']) && $_GET['tahun'] != '' ? $_GET['tahun'] : date('Y');
      ?>

    </div>
  </div>

  <div class="alert alert-info">
    Menampilkan Data Lembur Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
  </div>

  <?php if (count($lembur) > 0): ?>
    <div class="card shadow mb-4">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Nama</th>
                    <th class="text-center">Bulan</th>
                    <th class="text-center">Jumlah Jam</th>
                    <th class="text-center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 1; foreach($lembur as $l): ?>
                    <tr>
                    <td class="text-center"><?= $no++ ?></td>
                    <td class="text-center"><?= $l->nama_pegawai ?></td>
                    <td class="text-center">
                        <?php
                        // Format bulantahun dari "062025" ke "Juni 2025"
                        $bulan = substr($l->bulantahun, 0, 2);
                        $tahun = substr($l->bulantahun, 2, 4);
                        echo date('F', mktime(0, 0, 0, $bulan, 10)) . " " . $tahun;
                        ?>
                    </td>
                    <td class="text-center"><?= $l->jumlah_jam ?> jam</td>
                    <td class="text-center">
                      <a href="<?php echo base_url('Staff/LemburController/edit_lembur/' . $l->id_pegawai . '/' . $bulan . '/' . $tahun); ?>" class="btn btn-warning btn-sm">
                          <i class="fas fa-edit"></i> Edit
                      </a>
                    </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
          </table>
        </div>
      </div>
    </div>
  <?php else: ?>
    <div class="alert alert-danger text-center mt-3">
      <i class="fas fa-info-circle"></i>
      Data lembur belum tersedia untuk bulan dan tahun yang dipilih.
    </div>
  <?php endif; ?>

</div>

<?php if ($this->session->flashdata('popup_message')): ?>
  <?php $this->load->view('popup_message'); ?>
<?php endif; ?>
