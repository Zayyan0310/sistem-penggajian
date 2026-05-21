<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?= $title ?></h1>
  </div>

  <div class="alert alert-success font-weight-bold mb-4" style="max-width: 650px;">
    Selamat datang, Anda login sebagai pegawai
  </div>

  <div class="card mx-auto mb-5" style="max-width: 650px;">
    <div class="card-header font-weight-bold bg-primary text-white">
      Data Pegawai
    </div>

    <?php foreach($pegawai as $p): ?>
      <div class="card-body">
        <div class="row align-items-center">
          <div class="col-md-4 text-center mb-3 mb-md-0">
            <img src="<?= base_url('photo/'.$p->photo) ?>" alt="Foto Pegawai" class="img-fluid rounded" style="max-height: 250px;">
          </div>
          <div class="col-md-8">
            <table class="table table-borderless mb-0">
              <tbody>
                <tr>
                  <th scope="row" style="width: 40%;">Nama Pegawai</th>
                  <td><?= $p->nama_pegawai ?></td>
                </tr>
                <tr>
                  <th scope="row">Jabatan</th>
                  <td><?= $p->jabatan ?></td>
                </tr>
                <tr>
                  <th scope="row">Tanggal Masuk</th>
                  <td><?= $p->tanggal_masuk ?></td>
                </tr>
                <tr>
                  <th scope="row">Status</th>
                  <td><?= $p->status ?></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>

</div>
<!-- /.container-fluid -->
