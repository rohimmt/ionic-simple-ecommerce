<?php
require "db.php";

$data = file_get_contents("php://input");
if (@($data)) {
    $request = json_decode($data);
    $aksi = $request->aksi;
    $id_user = $request->id_user;
}

if ($aksi == "1") {
    
    $username = $request->username;
    $password = $request->password;

    $id_user = mysqli_real_escape_string($con, $id_user);
    $username = mysqli_real_escape_string($con, $username);
    $password = mysqli_real_escape_string($con, $password);

    $id_user = stripslashes($id_user);
    $username = stripslashes($username);
    $password = stripslashes($password);

    $sql = "SELECT * FROM tb_user WHERE id_user = '$id_user' and password = '$password'";
    $sql2 = "SELECT * FROM tb_user WHERE username = '$username' AND NOT id_user='$id_user'";

    $result = mysqli_query($con, $sql);
    $result2 = mysqli_query($con, $sql2);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);
    $count2 = mysqli_num_rows($result2);

    if ($count == 0) {
        $response = "salah";
    } else if ($count2 > 0) {
        $response = "ada";
    } else {
        $sql = "UPDATE tb_user SET username='$username' WHERE id_user='$id_user'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response = "sukses";
        } else $response = "error";
    }
} elseif ($aksi == "2") {
    $password1 = $request->password1;
    $password2 = $request->password2;
    $password3 = $request->password3;
    $id_user = mysqli_real_escape_string($con, $id_user);
    $password1 = mysqli_real_escape_string($con, $password1);
    $password2 = mysqli_real_escape_string($con, $password2);
    $password3 = mysqli_real_escape_string($con, $password3);

    $id_user = stripslashes($id_user);
    $password1 = stripslashes($password1);
    $password2 = stripslashes($password2);
    $password3 = stripslashes($password3);

    $sql = "SELECT * FROM tb_user WHERE id_user = '$id_user' and password = '$password3'";

    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $count = mysqli_num_rows($result);

    if ($count == 0) {
        $response = "salah";
    } else {
        $sql = "UPDATE tb_user SET password='$password1' WHERE id_user='$id_user'";
        $result = mysqli_query($con, $sql);
        if ($result) {
            $response = "sukses";
        } else $response = "error";
    }
}





echo json_encode($response);
?>