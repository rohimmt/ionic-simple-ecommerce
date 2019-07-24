<?php
require "db.php";

date_default_timezone_set("Asia/Jakarta"); 
$q = mysqli_query($con, "SELECT * FROM tb_pesanan");

while ($row = mysqli_fetch_array($q)) {

    $awal = new DateTime($row['waktu']);
    $akhir = new DateTime();
    $id_pesanan = $row['id_pesanan'];
    $status = $row['status'];

    $diff = $awal->diff($akhir);
    if ($diff->d > 0 && ($status == '1' || $status == '7')) { // selisih 1 hari, status 7 = bukti salah
        mysqli_query($con, "UPDATE tb_pesanan SET status='6' WHERE id_pesanan='$id_pesanan'");

        $sql = mysqli_query($con, "SELECT * FROM tb_detail_pesanan WHERE id_pesanan='$id_pesanan'");

        while ($r = mysqli_fetch_array($sql)) {
            $kode_barang = $r['kode_barang'];
            $jumlah = $r['jumlah'];
            mysqli_query($con, "UPDATE tb_barang SET stok=stok+$jumlah WHERE kode_barang='$kode_barang'");
        }
    }

}
?>