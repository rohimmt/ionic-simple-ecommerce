<?php
class Dashboard
{

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function barang()
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_barang";
        $query = $db->query($sql) or die($db->error);
        $count = mysqli_num_rows($query);
        return $count;
    }
    public function kategori()
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_kategori";
        $query = $db->query($sql) or die($db->error);
        $count = mysqli_num_rows($query);
        return $count;
    }
    public function kota()
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_kota";
        $query = $db->query($sql) or die($db->error);
        $count = mysqli_num_rows($query);
        return $count;
    }
    public function pesanan() 
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_pesanan";
        $query = $db->query($sql) or die($db->error); 
        $count = mysqli_num_rows($query);
        return $count;
    }
    public function user()
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_user";
        $query = $db->query($sql) or die($db->error);
        $count = mysqli_num_rows($query);
        return $count;
    }

}
?>