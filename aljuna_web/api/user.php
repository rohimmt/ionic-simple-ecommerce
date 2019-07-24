<?php
include "db.php";
$data = array();

if (@$_GET['id_user']) {
    $id_user = $_GET['id_user'];
    
    $q = mysqli_query($con, "SELECT * FROM tb_user where id_user='$id_user' ");

    while ($row = mysqli_fetch_object($q)) {
        $data[] = $row;
    }
}
echo json_encode($data);
echo mysqli_error($con);
?>