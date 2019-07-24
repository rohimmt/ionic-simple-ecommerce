<?php
// require "db.php";
// date_default_timezone_set("Asia/Jakarta");
// $q = mysqli_query($con, "SELECT * FROM tb_transaksi");

// while ($row = mysqli_fetch_array($q)) {

//     $awal = new DateTime($row['waktu']);
//     $akhir = new DateTime();
//     $a = date_create();
//     $id_transaksi = $row['id_transaksi'];
//     $status = $row['status'];
//     $result = $a->format('Y-m-d H:i:s');

//     $diff = $awal->diff($akhir);
//     echo $diff->d."-".$diff->h."-".$diff->i."<br>";                                           

// }

include "db.php";

$input = file_get_contents('php://input');
$data = json_decode($input, true);
$id_user = $data['id_user'];

    if ($data['action'] == "cek") {
        $q = mysqli_query($con, "SELECT * FROM tb_transaksi WHERE id_user='$id_user'");
        $bbayar = 0;
        $batal = 0;
        $tolak = 0;
        while ($row = mysqli_fetch_array($q)) {
            if ($row['status'] == '1') $bbayar++;
            if ($row['status'] == '6') $batal++;
            if ($row['status'] == '7') $tolak++; 
        }
        $result = array('bbayar' => $bbayar, 'batal' => $batal, 'tolak' => $tolak);
    } else if ($data['action'] == "batal") {
        $id_user = $data['id_user'];
        mysqli_query($con, "UPDATE tb_transaksi SET status='5' WHERE id_user='$id_user' AND status='6'");
    }
    
echo json_encode($result);

?>