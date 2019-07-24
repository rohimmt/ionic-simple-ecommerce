<?php
class User
{

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($id_user = null)
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_user ORDER BY id_user DESC";
        if ($id_user != null) {
            $sql .= " WHERE id_user = '$id_user'";
        }
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function tambah($username, $password, $hak)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_user VALUES ('','$username', '$password', '$hak')") or die($db->error);
    }

    public function edit($id_user, $username, $password, $hak)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_user SET username='$username', password='$password', hak='$hak' WHERE id_user='$id_user'");
    }

    public function hapus($id_user)
    {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_user WHERE id_user = '$id_user'") or die($db->error);
    }

    // function __destruct()
    // {
    //     $db = $this->mysqli->conn;
    //     $db->close();

    // }
}
?>