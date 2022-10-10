<?php

include 'head.php';
require_once 'include/auth.php';

?>

<body class="sb-nav-fixed">
  <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="dashboard.php">WELCOME</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar-->
    <ul class="navbar-nav d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
          <a class="dropdown-item" href="logout.php" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
          <a class="dropdown-item" href="kelola-admin.php" onclick="return confirm('Yakin ingin Tambah Akun?')">Profil</a>
      </li>
    </ul>
  </nav>
  <div id="layoutSidenav">
    <div id="layoutSidenav_nav">
      <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-footer">
          <div class="small">Logged in as:</div>
          <?php echo $_SESSION['nama'] ?> 
          <?php echo $_SESSION['nip'] ?> <br>
           <?php echo $_SESSION['jabatan'] ?> </br>
        </div>
        <div class="sb-sidenav-menu">
          <div class="nav">
            <div class="sb-sidenav-menu-heading">Core</div>
            <a class="nav-link" href="dashboard.php">
              <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
              Dashboard
            </a>
            <div class="sb-sidenav-menu-heading">MENU DATA</div>
            <a class="nav-link" href="data-nasabah.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Data Perusahaan
            </a>
            <a class="nav-link" href="data-peminjam-perbulan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Pengajuan Kredit
            </a>
            <a class="nav-link" href="data-nasabah-menunggak.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Status Pengajuan Kredit
            </a>
            <!-- Remove this comment if u want use
            <a class="nav-link" href="data-nasabah-lunas.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Data Debitur Lunas
            </a>
            <!-- Remove this comment if u want use
            <a class="nav-link" href="data-tanda-terima-agunan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Tanda Terima Agunan
            </a>
            <a class="nav-link" href="data-struk.php">
              <div class="sb-nav-link-icon"><i class="fas fa-database"></i></div>
              Struk Pencairan Pinjaman

            </a>

              <!-- Remove this comment if u want use
            </a>
            <div class="sb-sidenav-menu-heading">Laporan Pinjaman</div>
            <div class="accordion" id="accordionExample">
              <div class="" id="headingOne">
                <a class="nav-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-list"></i>&nbsp;List Laporan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                </a>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                <a class="nav-link" href="laporan-peminjam-perbulan.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                  Peminjam Perbulan
                </a>
                <a class="nav-link" href="laporan-nasabah-menunggak.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                  Nasabah Menunggak
                </a>
                <a class="nav-link" href="laporan-nasabah-lunas.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                  Nasabah Lunas
                </a>
                <a class="nav-link" href="laporan-tanda-terima-agunan.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                  Tanda Terima Agunan
                </a>
                <a class="nav-link" href="laporan-struk.php">
                  <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                  Struk Pencairan Pinjaman
                </a>
              </div>
            </div>
            </a> -->
            <!-- Remove this comment if u want use
            <div class="sb-sidenav-menu-heading">LAPORAN</div>
            <div class="accordion" id="accordionExample">
              <div class="" id="headingOne">
                <a class="nav-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  <i class="fas fa-list"></i>&nbsp;List Laporan &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<div class="sb-nav-link-icon"><i class="fas fa-arrow-down"></i></div>
                </a>
              </div>
              <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
            <div class="accordion" id="accordionExample">
              <div class="" id="headingOne">
            <a class="nav-link" href="laporan-peminjam-perbulan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
              Laporan Pinjaman Debitur
            </a>
            <a class="nav-link" href="laporan-nasabah-menunggak.php">
              <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
              Laporan Debitur Menunggak
            </a>
            <a class="nav-link" href="laporan-nasabah-lunas.php">
              <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
              Laporan Debitur Lunas
            </a>
            <!-- Remove this comment if u want use


            <a class="nav-link" href="laporan-tanda-terima-agunan.php">
              <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
              Tanda Terima Agunan
            </a>
            <a class="nav-link" href="laporan-struk.php">
              <div class="sb-nav-link-icon"><i class="fas fa-print"></i></div>
              Struk Pencairan Pinjaman
            </a>
            </a> -->
            
          </div>
        </div>
        
      </nav>
    </div>
    <div id="layoutSidenav_content">
 