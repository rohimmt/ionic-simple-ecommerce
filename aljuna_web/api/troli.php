<?php
include "db.php";
$input = file_get_contents('php://input');
$data = json_decode($input, true);
if ($data['aksi'] == "tambah") {
    $id_user = $data['id_user'];
    $kode_barang = $data['kode_barang'];
    $jumlah = $data['jumlah'];

    $sql = "SELECT * FROM tb_troli WHERE id_user = '$id_user' AND kode_barang = '$kode_barang'";
    $sql2 = "SELECT * FROM tb_barang WHERE kode_barang = '$kode_barang'";
    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql2);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result);
    if ($count > 0 && (($row['jumlah']+$jumlah) > $row2['stok'])) {
        $res = "melebihi";
        echo json_encode($res);
    } else 
    if ($count == 0) {
        $sql = mysqli_query($con, "INSERT INTO tb_troli (id_user, kode_barang, jumlah) VALUES ('$id_user','$kode_barang','$jumlah')");
        if ($sql) {
            $res = "ditambahkan";
        } else {
            $res = "error";
        }
        echo json_encode($res);
    } else {
        $sql = "UPDATE tb_troli SET jumlah=jumlah+$jumlah WHERE id_user = '$id_user' AND kode_barang = '$kode_barang'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $res = "diubah";
        } else {
            $res = "error";
        }
        echo json_encode($res);
    }
    
} else if (@$_GET['id_user']) {
    $id_user = $_GET['id_user'];
    $sql = mysqli_query($con, "SELECT * FROM tb_troli, tb_barang where tb_troli.kode_barang = tb_barang.kode_barang AND id_user='$id_user' ");

    while ($row = mysqli_fetch_object($sql)) {
        $data[] = $row;
    }
    echo json_encode($data);
} else if (@$_GET['id_troli']) {
    $id_troli = $_GET['id_troli'];
    $q = mysqli_query($con, "DELETE FROM tb_troli WHERE id_troli = '$id_troli' ");
    $res = "dihapus";
    echo json_encode($res);
}
?>