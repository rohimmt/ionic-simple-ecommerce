<?php
// tentukan waktu tujuan
$waktu_tujuan = mktime(8,2,0,9,20,2012);

// tentukan waktu saat ini
$waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));

// hitung selisih kedua waktu
$selisih_waktu = $waktu_tujuan - $waktu_sekarang;

// Untuk menghitung jumlah dalam satuan hari:
$jumlah_hari = floor($selisih_waktu/86400);

// Untuk menghitung jumlah dalam satuan jam:
$sisa = $selisih_waktu % 86400;
$jumlah_jam = floor($sisa/3600);

// Untuk menghitung jumlah dalam satuan menit:
$sisa = $sisa % 3600;
$jumlah_menit = floor($sisa/60);

// Untuk menghitung jumlah dalam satuan detik:
$sisa = $sisa % 60;
$jumlah_detik = floor($sisa/1);

echo "Tanggal saat ini: ".date("d-m-Y H:i:s")."<br>";
echo "Tanggal pelaksanaan: ".date("20-9-2012 08:00:00")."<br>";
echo "<b>Waktu menjelang pelaksanaan tinggal: ".$jumlah_hari." hari ".$jumlah_jam." jam ".$jumlah_menit." menit ".$jumlah_detik." detik lagi</b>";
?>