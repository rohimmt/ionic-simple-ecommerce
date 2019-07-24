<?php
require "db.php";
$data = file_get_contents("php://input");
if (@($data)) {
    $request = json_decode($data);
    $username = $request->username;
    $password = $request->password;
}

$username = mysqli_real_escape_string($con, $username);
$password = mysqli_real_escape_string($con, $password);
$username = stripslashes($username);
$password = stripslashes($password);

$sql = "SELECT * FROM tb_user WHERE username = '$username' and password = '$password'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$count = mysqli_num_rows($result);

if ($count > 0) {
    $response = $row['id_user'];
} else {
    $response = "salah";
}

echo json_encode($response);
?>