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
      <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('Staff/DashboardController') ?>">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard Staff<span></a>
      </li>

      <!-- Nav Item - Master Transaksi -->
      <li class="nav-item <?= in_array($this->uri->segment(2), ['DataPajakController', 'LemburController']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterTransaksi" aria-expanded="true" aria-controls="collapseMasterTransaksi">
          <i class="fas fa-fw fa-database"></i>
          <span>Master Transaksi</span>
        </a>
        <div id="collapseMasterTransaksi" class="collapse <?= in_array($this->uri->segment(2), ['DataPajakController', 'LemburController']) ? 'show' : '' ?>" aria-labelledby="headingMasterTransaksi" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'DataPajakController' ? 'active' : '' ?>" href="<?= base_url('Staff/DataPajakController') ?>">
              <i class="fas fa-percentage"></i> Data Pajak
            </a>
            <a class="collapse-item <?= $this->uri->segment(2) == 'LemburController' ? 'active' : '' ?>" href="<?= base_url('Staff/LemburController') ?>">
              <i class="fas fa-clock"></i> Data Lembur
            </a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Transaksi Gaji -->
      <li class="nav-item <?= $this->uri->segment(2) == 'PenggajianController' ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-coins"></i>
          <span>Transaksi</span>
        </a>
        <div id="collapseUtilities" class="collapse <?= $this->uri->segment(2) == 'PenggajianController' ? 'show' : '' ?>" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'PenggajianController' ? 'active' : '' ?>" href="<?= base_url('Staff/PenggajianController') ?>">
              <i class="fas fa-money-check-alt"></i> Data Gaji
            </a>
          </div>
        </div>
      </li>

      <!-- Menu Laporan Gabungan -->
      <li class="nav-item <?= in_array($this->uri->segment(2), ['LaporanGajiController', 'LaporanLemburController']) ? 'active' : '' ?>">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLaporan" aria-expanded="true" aria-controls="collapseLaporan">
          <i class="fas fa-clipboard-list"></i>
          <span>Laporan</span>
        </a>
        <div id="collapseLaporan" class="collapse <?= in_array($this->uri->segment(2), ['LaporanGajiController', 'LaporanLemburController']) ? 'show' : '' ?>" aria-labelledby="headingLaporan" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item <?= $this->uri->segment(2) == 'LaporanGajiController' ? 'active' : '' ?>" href="<?= base_url('Staff/LaporanGajiController') ?>">
              <i class="fas fa-money-bill-wave"></i> Laporan Gaji
            </a>
            <a class="collapse-item <?= $this->uri->segment(2) == 'LaporanLemburController' ? 'active' : '' ?>" href="<?= base_url('Staff/LaporanLemburController') ?>">
              <i class="fas fa-clock"></i> Laporan Lembur
            </a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Slip Gaji -->
      <li class="nav-item <?= $this->uri->segment(2) == 'SlipGajiController' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('Staff/SlipGajiController') ?>">
          <i class="fas fa-fw fa-file-invoice"></i>
          <span>Slip Gaji</span>
        </a>
      </li>

      <!-- Nav Item - Ubah Password -->
      <li class="nav-item <?= $this->uri->segment(1) == 'GantiPasswordController' ? 'active' : '' ?>">
        <a class="nav-link" href="<?= base_url('Staff/GantiPasswordController') ?>">
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