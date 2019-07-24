<?php
session_start();
if(!empty($_SESSION["id_user"])) { 
ob_start();
require_once('config/koneksi.php');
require_once('models/database.php');
include "models/m_barang.php";
include "models/m_kategori.php";
include "models/m_kota.php";

$connection = new Database($host, $user, $pass, $database);
$barang = new barang($connection);
$kategori = new kategori($connection);
$kota = new kota($connection);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aljuna Archery - Halaman Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/dataTables/dataTables.min.css" rel="stylesheet">

    <!-- Add custom CSS here -->
    <link href="assets/css/sb-admin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  </head>

  <body>

    <div id="wrapper">

      <!-- Sidebar -->
      <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"><img src="assets/images/logo.png" width="100px"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
          <ul class="nav navbar-nav side-nav">
            <li><a href="?page=dashboard"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-tasks"></i> Data Barang <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="?page=barang">Semua Barang</a></li>
                <?php 
                  $tampil = $kategori->tampil();
                  while ($data = $tampil->fetch_object()) {
                  ?>
                <li ><a href="?page=barang&kategori=<?php echo $data->id_kategori; ?>" ><i class="glyphicon glyphicon-chevron-right"></i> <?php echo $data->kategori; ?></a></li>
                <?php } ?>
              </ul>
            </li>
            
            <li><a href="?page=kategori"><i class="glyphicon glyphicon-tags"></i> Data Kategori</a></li>
            <li><a href="?page=kota"><i class="fas fa-city"></i> Data Kota & Tarif Kirim</a></li>
            <li class="dropdown ">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fas fa-exchange-alt"></i> Pesanan <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li ><a href="?page=pesanan" > Semua Pesanan</a></li>
                <li ><a href="?page=pesanan&status=1" ><i class="glyphicon glyphicon-chevron-right"></i> Menunggu Pembayaran</a></li>
                <li ><a href="?page=pesanan&status=2" ><i class="glyphicon glyphicon-chevron-right"></i> Diproses</a></li>
                <li ><a href="?page=pesanan&status=3" ><i class="glyphicon glyphicon-chevron-right"></i> Dikirim</a></li>
                <li ><a href="?page=pesanan&status=4" ><i class="glyphicon glyphicon-chevron-right"></i> Selesai</a></li>
                <li ><a href="?page=pesanan&status=5" ><i class="glyphicon glyphicon-chevron-right"></i> Batal</a></li>
              </ul>
            </li>
            <li><a href="?page=user"><i class="glyphicon glyphicon-user"></i> Data User</a></li>
          </ul>
          
          <ul class="nav navbar-nav navbar-right navbar-user">
            <li class="dropdown user-dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?php echo $_SESSION["id_user"];?> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="logout.php"><i class="fa fa-power-off"></i> Keluar</a></li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>

      <div id="page-wrapper">
      <?php
      if (@$_GET['page'] == 'dashboard' || @$_GET['page'] == '') {
        include "views/dashboard.php";
      } else if (@$_GET['page'] == 'barang') {
        include "views/barang.php";
	    } else if (@$_GET['page'] == 'pesanan') {
        include "views/pesanan.php";
	    } else if (@$_GET['page'] == 'kategori') {
        include "views/kategori.php";
	    } else if (@$_GET['page'] == 'kota') {
        include "views/kota.php";
	    } else if (@$_GET['page'] == 'detail_pesanan') {
        include "views/detail_pesanan.php";
	    } else if (@$_GET['page'] == 'alamat') {
        include "views/alamat.php";
	    } else if (@$_GET['page'] == 'user') {
        include "views/user.php";
      }
      ?>
      </div><!-- /#page-wrapper -->

    </div><!-- /#wrapper -->

    <!-- JavaScript -->
    <script src="assets/js/flot/chart-data-flot.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/morris/chart-data-morris.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/dataTables/datatables.min.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        $('#datatables').DataTable({
          "language":{
            "url":"//cdn.datatables.net/plug-ins/1.10.19/i18n/Indonesian.json",
            "sEmptyTable":"Tidads"
          }
        });
      });
    </script>
  </body>
</html>
  <?php } else header("Location: login.php"); ?>