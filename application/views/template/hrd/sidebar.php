<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-text mx-3"> Penggajian </div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item <?= $this->uri->segment(2) == 'DashboardController' ? 'active' : '' ?>">
        <a class="nav-link" href="<?php echo base_url('Hrd/DashboardController') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard HRD</span></a>
      </li>


      <!-- Nav Item - Master Data -->
      <li class="nav-item <?= in_array($this->uri->segment(2), ['JabatanController', 'PegawaiController']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterData"
          aria-expanded="true" aria-controls="collapseMasterData">
          <i class="fas fa-fw fa-database"></i>
          <span>Master Data</span>
        </a>
        <div id="collapseMasterData" class="collapse <?= in_array($this->uri->segment(2), ['JabatanController', 'PegawaiController']) ? 'show' : '' ?>"
            aria-labelledby="headingMasterData" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'JabatanController' ? 'active' : '' ?>" href="<?= base_url('Hrd/JabatanController') ?>">
              <i class="fas fa-briefcase"></i> Data Jabatan
            </a>
            <a class="collapse-item <?= $this->uri->segment(2) == 'PegawaiController' ? 'active' : '' ?>" href="<?= base_url('Hrd/PegawaiController') ?>">
              <i class="fas fa-users"></i> Data Pegawai
            </a>
          </div>
        </div>
      </li>


      <!-- Nav Item - Transaksi -->
      <li class="nav-item <?= in_array($this->uri->segment(2), ['AbsensiController']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTransaksi"
          aria-expanded="<?= in_array($this->uri->segment(2), ['AbsensiController']) ? 'true' : 'false' ?>"
          aria-controls="collapseTransaksi">
          <i class="fas fa-fw fa-coins"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseTransaksi" class="collapse <?= in_array($this->uri->segment(2), ['AbsensiController']) ? 'show' : '' ?>"
            aria-labelledby="headingTransaksi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'AbsensiController' ? 'active' : '' ?>"
              href="<?= base_url('Hrd/AbsensiController') ?>">
              <i class="fas fa-calendar-check"></i> Data Absen
            </a>
          </div>
        </div>
      </li>


     <!-- Data Gaji -->
    <li class="nav-item <?= $this->uri->segment(2) == 'PenggajianController' ? 'active' : '' ?>">
      <a class="nav-link" href="<?= base_url('Hrd/PenggajianController') ?>">
        <i class="fas fa-file-invoice-dollar"></i>
        <span>Data Gaji</span>
      </a>
    </li>

      <!-- Laporan -->
      <li class="nav-item <?= in_array($this->uri->segment(2), ['LaporanAbsensiController']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan"
          aria-expanded="false" aria-controls="collapseLaporan">
          <i class="fas fa-fw fa-file-alt"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse <?= $this->uri->segment(2) == 'LaporanAbsensiController' ? 'show' : '' ?>"
            aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'LaporanAbsensiController' ? 'active' : '' ?>" href="<?= base_url('Hrd/LaporanAbsensiController') ?>">
              <i class="fas fa-fw fa-clipboard-list mr-1"></i> Rekap Absen
            </a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Ubah Password -->
      <li class="nav-item <?= $this->uri->segment(1) == 'GantiPasswordController' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('Hrd/GantiPasswordController') ?>">
          <i class="fas fa-fw fa-key"></i>
          <span>Ubah Password</span>
        </a>
      </li>

      <!-- Nav Item - Logout -->
      <li class="nav-item">
        <a class="nav-link" href="<?= base_url('LoginController/logout') ?>">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Logout</span>
        </a>
      </li>


      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <h4 class="font-weight-bold">PT. MUTIARA JAWA</h4>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">Selamat Datang <?php echo $this->session->userdata('nama_pegawai')?></span>
              </a>
              
            </li>

          </ul>

        </nav>
        <!-- End of Topbar -->