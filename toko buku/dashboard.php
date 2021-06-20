<?php 
  include 'config/connection.php';
  session_start();
  if($_SESSION['username']==null && $_SESSION['hak_akses']==null){
    echo "<script>alert('Data tidak boleh kosong');</script>";
  }
  if (isset($_GET['logout'])) {
    unset($_SESSION['username']);
    unset($_SESSION['hak_akses']);
    header('location: index.php');
  }
  
 ?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title></title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap5.min.css">
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>
        
        <link href="css/aos.css" rel="stylesheet">
        <script src="scripts/main.js"></script>
        <noscript>
        <style type="text/css">
          [data-aos] {
              opacity: 1 !important;
              transform: translate(0) scale(1) !important;
          }
        </style>
        </noscript>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    </head>
    <body>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar-->
            <div class="shadow-md" style="background-color : #fbfbfb" id="sidebar-wrapper">
                <div class="sidebar-heading border-0 bg-dark text-light">Menu</div>
                <div class="list-group list-group-flush border-end border-bottom">
                <?php if ($_SESSION['hak_akses'] =="kasir"){?>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=penjualan"><i class="fa fa-shopping-cart me-3"></i>Kasir</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=cetakfak"><i class="fa fa-clipboard me-3" aria-hidden="true"></i>Cetak Faktur</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=laporanPenjualan"><i class="fa fa-dollar-sign me-3" aria-hidden="true"></i>Laporan Penjualan</a>
                <?php } elseif ($_SESSION['hak_akses'] =="admin") {?>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=buku"><i class="fa fa-book me-3"></i>Input Buku</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=pasok"><i class="fa fa-chart-line me-3" aria-hidden="true"></i>Pasok Buku</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=distributor"><i class="fa fa-random me-3" aria-hidden="true"></i>Input distributor</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=laporanPenjualan"><i class="fa fa-dollar-sign me-3" aria-hidden="true"></i>Laporan Penjualan</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=lap_terlaris"><i class="fa fa-dollar-sign me-3" aria-hidden="true"></i>Buku Terlaris</a>
               <?php } elseif ($_SESSION['hak_akses'] =="manager") {?>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=set_lap"><i class="fa fa-book me-3"></i>Input Setting Laporan</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=input_user"><i class="fa fa-user me-3" aria-hidden="true"></i>Input User</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=cetakfak"><i class="fa fa-clipboard me-3" aria-hidden="true"></i>Cetak Faktur</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=laporanPenjualan"><i class="fa fa-dollar-sign me-3" aria-hidden="true"></i>Laporan Penjualan</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=lap_buku"><i class="fa fa-random me-3" aria-hidden="true"></i>Laporan Semua Buku</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=lap_pasok"><i class="fa fa-chart-line me-3" aria-hidden="true"></i>Pasok Buku</a>
                      <a class="list-group-item list-group-item-action py-3" href="?menu=lap_terlaris"><i class="fa fa-dollar-sign me-3" aria-hidden="true"></i>Buku Terlaris</a>
               <?php } ?>

                </div>
            </div>
            <!-- Page content wrapper-->
            <div id="page-content-wrapper">
                <!-- Top navigation-->
                <nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom">
                    <div class="container-fluid">
                        <button class="btn btn-secondary" id="sidebarToggle"><i class="fa fa-bars" aria-hidden="true"></i></button>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                                <li class="nav-item active"><a class="nav-link" href="dashboard.php">Home <i class="fas fa-home ms-2"></i></a></li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Account<i class="fas fa-user ms-2"></i></a>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="?logout" onclick="return confirm('Apakah anda yakin ingin keluar')">Logout</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="?menu=ganti_pass">Change password</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Page content-->
                <div class="container-fluid">
                <?php 
                    switch (@$_GET['menu']) {
                      case 'home':
                        include 'home.php';
                        break;
                      case 'buku':
                        include 'buku.php';
                        break;
                      case 'distributor':
                        include 'distributor.php';
                        break;
                      case 'pasok':
                        include 'pasok.php';
                        break;
                      case 'kasir':
                        include 'kasir.php';
                        break;
                      case 'penjualan':
                        include 'penjualan.php';
                        break;
                      case 'laporanPasok':
                        include 'laporanPasok.php';
                        break;
                      case 'laporanPenjualan':
                        include 'lap_penjualan.php';
                        break;
                      case 'cetakfak':
                        include 'cetak_fak.php';
                        break;
                      case 'cetak':
                        include 'cetak.php';
                        break;
                      case 'cetakpasok':
                        include 'cetakpasok.php';
                        break;
                      case 'lap_buku':
                        include 'lap_buku.php';
                        break;
                      case 'lap_pasok':
                        include 'lap_pasok.php';
                        break;
                      case 'input_user':
                        include 'user.php';
                        break;
                      case 'set_lap':
                        include 'set_lap.php';
                        break;
                      case 'lap_terlaris':
                        include 'lap_penjualan_terlaris.php';
                        break;
                      case 'ganti_pass':
                        include 'ganti_pass.php';
                        break;  
                      default:
                        include 'landing_page.php';
                        break;
                    }
                ?>
                </div>
            </div>
        </div>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <script type="text/javascript">
          $(document).ready(function() {
            $('#data').dataTable( {
        
            } );
          } );
          $(document).ready(function() {
            $('#tabelbukum').dataTable( {
            } );
          } );
          
        </script> 
    </body>
</html>
