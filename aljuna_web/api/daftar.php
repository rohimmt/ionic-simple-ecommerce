<?php
include "db.php";
$input = file_get_contents('php://input');
$data = json_decode($input, true);
$message = array();
if ($data['action'] == "submit") {
    $username = $data['username'];
    $password = $data['password'];
    $nama = $data['nama'];
    $id_kota = $data['id_kota'];
    $alamat = $data['alamat'];
    $no_telp = $data['no_telp'];

    $q = mysqli_query($con, "INSERT INTO tb_user (username, password, hak) VALUES ('$username','$password','2')");
    if ($q) {
        $sql = "SELECT * from tb_user order BY id_user DESC LIMIT 1";
        $result = mysqli_query($con, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $id_user = $row['id_user'];
        $q = mysqli_query($con, "INSERT INTO tb_alamat (id_user, nama, id_kota, alamat, no_telp) VALUES ('$id_user','$nama','$id_kota','$alamat','$no_telp')");
        $message = "success";
    } else {
        $message = "error";
    }
    echo json_encode($message);
}
echo mysqli_error($con);
?>