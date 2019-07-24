<?php
class Login {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }
    
    public function login($username = null, $password = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password' and hak='2'";
        $query = $db->query($sql) or die ($db->error);
        $cek = mysqli_num_rows($query);
        if($cek>0) {
            $res = "sukses";
	    } else { 
            $res = "gagal";
        }
        return $res;
    }
}
?> 