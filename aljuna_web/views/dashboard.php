<?php
include "models/m_dashboard.php";

$dashboard = new dashboard($connection);
$barang = $dashboard->barang();
$kategori = $dashboard->kategori();
$kota = $dashboard->kota();
$pesanan = $dashboard->pesanan();
$user = $dashboard->user();
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Dashboard <small>Admin</small></h1>
    <ol class="breadcrumb">
      <li class="active"><i class="icon-file-alt"></i> Dashboard</li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="glyphicon glyphicon-tasks fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading"><?php echo $barang; ?></p>
            <p class="announcement-text">Data Barang</p>
          </div>
        </div>
      </div>
      <a href="?page=barang">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
              Data Barang
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="glyphicon glyphicon-tags fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading"><?php echo $kategori; ?></p>
            <p class="announcement-text">Data Kategori</p>
          </div>
        </div>
      </div>
      <a href="?page=kategori">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
            Data Kategori
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fas fa-city fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading"><?php echo $kota; ?></p>
            <p class="announcement-text">Data Kota</p>
          </div>
        </div>
      </div>
      <a href="?page=kota">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
            Data Kota
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fas fa-exchange-alt fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading"><?php echo $pesanan; ?></p>
            <p class="announcement-text">Data pesanan</p>
          </div>
        </div>
      </div>
      <a href="?page=pesanan">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
            Data pesanan
           
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="panel panel-info">
      <div class="panel-heading">
        <div class="row">
          <div class="col-xs-6">
            <i class="fas fa-users fa-5x"></i>
          </div>
          <div class="col-xs-6 text-right">
            <p class="announcement-heading"><?php echo $user; ?></p>
            <p class="announcement-text">Data User</p>
          </div>
        </div>
      </div>
      <a href="?page=user">
        <div class="panel-footer announcement-bottom">
          <div class="row">
            <div class="col-xs-6">
            Data User
            </div>
            <div class="col-xs-6 text-right">
              <i class="fa fa-arrow-circle-right"></i>
            </div>
          </div>
        </div>
      </a> 
    </div>
  </div>
</div>

</div>