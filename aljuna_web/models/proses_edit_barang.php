<?php
require_once('../config/koneksi.php');
require_once('../models/database.php');
include "../models/m_barang.php";
$connection = new Database($host, $user, $pass, $database); 
$barang = new barang($connection);

$kode_barang = $connection->conn->real_escape_string($_POST['kode_barang']);
$kode_barang1 = $connection->conn->real_escape_string($_POST['kode_barang1']);
$nama_barang = $connection->conn->real_escape_string($_POST['nama_barang']);
$id_kategori = $connection->conn->real_escape_string($_POST['id_kategori']);
$stok = $connection->conn->real_escape_string($_POST['stok']);
$satuan = $connection->conn->real_escape_string($_POST['satuan']);
$berat = $connection->conn->real_escape_string($_POST['berat']);
$harga = $connection->conn->real_escape_string($_POST['harga']);

$pict = $_FILES['gambar']['name'];
$extensi = explode(".", $_FILES['gambar']['name']);
$gambar = 'b-' . round(microtime(true)) . "." . end($extensi);
$sumber = $_FILES['gambar']['tmp_name'];

if($pict == '') {
    $barang->edit("UPDATE tb_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', id_kategori='$id_kategori', stok='$stok', satuan='$satuan', berat='$berat', harga='$harga' WHERE kode_barang='$kode_barang1'");
    echo "<script>window.location='?page=barang';</script>";
} else {
    $gambar_awal = $barang->tampil($kode_barang)->fetch_object()->gambar;
    unlink("../assets/images/barang/".$gambar_awal);

    $upload = move_uploaded_file($sumber, "../assets/images/barang/" . $gambar);
    if ($upload) {
        $barang->edit("UPDATE tb_barang SET kode_barang='$kode_barang', nama_barang='$nama_barang', id_kategori='$id_kategori', stok='$stok', satuan='$satuan', berat='$berat', harga='$harga', gambar='$gambar' WHERE kode_barang='$kode_barang1'");
        echo "<script>window.location='?page=barang';</script>";
    } else {
        echo "<script>alert('Upload gambar gagal!')</script>";
    }
}
?>