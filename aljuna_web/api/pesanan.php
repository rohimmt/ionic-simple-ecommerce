<?php
include "db.php";
date_default_timezone_set("Asia/Jakarta");
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$result = array();
if ($data['action'] == "submit") {
    $id_user = $data['id_user'];
    $id_alamat = $data['id_alamat'];
    $subtotal = $data['subtotal'];
    $subtotalongkir = $data['subtotalongkir'];

    $q = mysqli_query($con, "SELECT * FROM tb_alamat, tb_kota WHERE tb_alamat.id_kota=tb_kota.id_kota AND id_alamat='$id_alamat'");
    $row = mysqli_fetch_array($q, MYSQLI_ASSOC);
    $kota = $row['kota'];
    $nama = $row['nama'];
    $alamat = $row['alamat'];
    $no_telp = $row['no_telp'];
    $w = date_create();
    $waktu = $w->format('Y-m-d H:i:s');

    $pesanan = mysqli_query($con, "INSERT INTO tb_pesanan VALUES ('','$id_user','$waktu','$subtotal','$subtotalongkir',$subtotal+$subtotalongkir,'$nama','$kota','$alamat','$no_telp','','','1')");
    if ($pesanan) {
        $sql = "SELECT * from tb_pesanan order BY id_pesanan DESC LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id_pesanan = $row1['id_pesanan'];
        $q = mysqli_query($con, "SELECT * FROM tb_troli, tb_kategori, tb_barang WHERE tb_kategori.id_kategori=tb_barang.id_kategori AND tb_troli.kode_barang=tb_barang.kode_barang AND id_user='$id_user' ");

        while ($row = mysqli_fetch_array($q)) {
            $kode_barang = $row['kode_barang'];
            $nama_barang = $row['nama_barang'];
            $kategori = $row['kategori'];
            $jumlah = $row['jumlah'];
            $satuan = $row['satuan'];
            $berat = $row['berat'];
            $harga = $row['harga'];
            $gambar = $row['gambar'];
            copy("../assets/images/barang/" . $gambar, "../assets/images/pesanan/" . $gambar);
            $update = mysqli_query($con, "UPDATE tb_barang SET stok=stok-$jumlah WHERE kode_barang='$kode_barang'");
            $pesanan1 = mysqli_query($con, "INSERT INTO tb_detail_pesanan VALUES ('','$id_pesanan','$kode_barang','$nama_barang','$kategori','$jumlah','$satuan','$berat','$harga','$gambar')");
            if ($pesanan1) {
                $result = "success";
            } else {
                $result = "error";
            }
            $hapus = mysqli_query($con, "DELETE FROM tb_troli where id_user='$id_user'");
        }
    }
} else if ($data['action'] == "get") {
    $id_user = $data['id_user'];
    $q = mysqli_query($con, "SELECT * FROM tb_pesanan WHERE id_user='$id_user' ORDER BY id_pesanan DESC");

    while ($row = mysqli_fetch_object($q)) {
        $result[] = $row;
    }
} else if ($data['action'] == "getBarang") {
    $id_pesanan = $data['id_pesanan'];
    $q = mysqli_query($con, "SELECT * FROM  tb_detail_pesanan WHERE id_pesanan='$id_pesanan'");

    while ($row = mysqli_fetch_object($q)) {
        $result[] = $row;
    }
} else if ($data['action'] == "rekap") {
    $id_pesanan = $data['id_pesanan'];
    $q = mysqli_query($con, "SELECT * FROM  tb_pesanan WHERE id_pesanan='$id_pesanan'");

    while ($row = mysqli_fetch_object($q)) {
        $result[] = $row;
    }
} else if ($data['action'] == "rekap1") {
    $id_user = $data['id_user'];
    $q = mysqli_query($con, "SELECT * FROM  tb_pesanan WHERE id_user='$id_user' ORDER BY id_pesanan DESC LIMIT 1");

    while ($row = mysqli_fetch_object($q)) {
        $result[] = $row;
    }
} else if ($data['action'] == "rekap1barang") {
    $id_pesanan = $data['id_pesanan'];
    $q = mysqli_query($con, "SELECT * FROM  tb_detail_pesanan WHERE id_pesanan='$id_pesanan'");

    while ($row = mysqli_fetch_object($q)) {
        $result[] = $row;
    }
} else if ($data['action'] == "unggah") {
    $id_pesanan = $data['id_pesanan'];
    $bukti = $data['bukti'];
    $q = mysqli_query($con, "SELECT * FROM tb_pesanan WHERE id_pesanan='$id_pesanan'");
    $row = mysqli_fetch_array($q, MYSQLI_ASSOC);
    if ($row['bukti'] != null) {
        $file = '../assets/images/bukti/' . $row['bukti'];
        unlink("$file"); 
    }
    $update = mysqli_query($con, "UPDATE tb_pesanan SET bukti='$bukti', status='2' WHERE id_pesanan='$id_pesanan'");
    if ($update) $result = "success";
} else if ($data['action'] == "terima") {
    $id_pesanan = $data['id_pesanan'];
    $update = mysqli_query($con, "UPDATE tb_pesanan SET status='4' WHERE id_pesanan='$id_pesanan'");
    if ($update) {
        $result = "success";
    }
} else if ($data['action'] == "batalkan") {
    $id_pesanan = $data['id_pesanan'];
    $q = mysqli_query($con, "SELECT * FROM  tb_detail_pesanan WHERE id_pesanan='$id_pesanan'");
    $update = mysqli_query($con, "UPDATE tb_pesanan SET status='5' WHERE id_pesanan='$id_pesanan'");
    if ($update) {
        while ($row = mysqli_fetch_array($q)) {
            $kode_barang = $row['kode_barang'];
            $jumlah = $row['jumlah'];
            $update2 = mysqli_query($con, "UPDATE tb_barang SET stok=stok+$jumlah WHERE kode_barang='$kode_barang'");
        }
        $result = "success";
    }
}
echo json_encode($result);
// echo mysqli_error($con);
?>