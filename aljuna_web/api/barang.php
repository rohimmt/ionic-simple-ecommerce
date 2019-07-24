<?php
include "db.php";
$data = array();

if (@$_GET['id_kategori'] != '') {
    $id_kategori = $_GET['id_kategori'];
    
    $q = mysqli_query($con, "SELECT * FROM tb_barang, tb_kategori where tb_barang.id_kategori=tb_kategori.id_kategori AND tb_barang.id_kategori='$id_kategori' ");

    while ($row = mysqli_fetch_object($q)) {
        $data[] = $row;
    }
} else {
    $cari = @$_GET['cari'];
    $parameter="";
    if (@$_GET['parameter'] != null ) {
        $p = $_GET['parameter'];
        $parameter ="AND tb_barang.id_kategori=$p";
    }
    $q = mysqli_query($con, "SELECT * FROM tb_barang, tb_kategori where tb_barang.id_kategori=tb_kategori.id_kategori AND nama_barang LIKE '%$cari%' $parameter");

    while ($row = mysqli_fetch_object($q)) {
        $data[] = $row;

    }
}
echo json_encode($data);
echo mysqli_error($con);
?>