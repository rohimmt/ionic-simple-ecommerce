<?php
include "db.php";
$data=array();
$q=mysqli_query($con,"SELECT * FROM tb_kategori");

while ($row=mysqli_fetch_object($q)){
 $data[]=$row;
}
echo json_encode($data);
echo mysqli_error($con);
?>