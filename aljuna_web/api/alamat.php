<?php
include "db.php";


$input = file_get_contents('php://input');
$data = json_decode($input, true);
$message = array();
if (@$_GET['id_user']) {

    $id_user = $_GET['id_user'];

    $q = mysqli_query($con, "SELECT * FROM tb_alamat, tb_kota where tb_alamat.id_kota=tb_kota.id_kota AND id_user='$id_user'");

    while ($row = mysqli_fetch_object($q)) {
        $message[] = $row;
    }
} else if (@$data['action'] == "tambah") {
    $id_user = $data['id_user'];
    $nama = $data['nama'];
    $id_kota = $data['id_kota'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];

    $q = mysqli_query($con, "INSERT INTO tb_alamat (id_user, nama, id_kota, alamat, no_telp) VALUES ('$id_user','$nama','$id_kota','$alamat','$no_telp')");
    if ($q) {
        $message = "success";
    } else $message = "gagal";
} else if (@$data['action'] == "edit") {
    $id_alamat = $data['id_alamat'];
    $nama = $data['nama'];
    $id_kota = $data['id_kota'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];

    $q = mysqli_query($con, "UPDATE tb_alamat SET nama='$nama', id_kota='$id_kota', alamat='$alamat', no_telp='$no_telp' WHERE id_alamat='$id_alamat'");
    if ($q) {
        $message = "success";
    } else $message = "gagal";
} else if (@$data['action'] == "hapus") {;
    $id_alamat = $data['id_alamat'];
    $q = mysqli_query($con, "DELETE FROM tb_alamat WHERE id_alamat='$id_alamat'");
    if ($q) {
        $message = "success";
    } else $message = "gagal";

}
echo json_encode($message);
echo mysqli_error($con);
?>