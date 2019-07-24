<?php
class Alamat
{

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($id_user = null)
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_alamat, tb_kota WHERE tb_alamat.id_kota=tb_kota.id_kota AND id_user = '$id_user'";  
        $query = $db->query($sql) or die($db->error);
        return $query;
    }
    public function cek($id_user = null)
    {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_user WHERE id_user = '$id_user'";  
        $query = $db->query($sql) or die($db->error);
        return $query;
    }

    public function tambah($id_user, $id_kota, $nama, $alamat, $no_telp)
    {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_alamat VALUES ('','$id_user', '$id_kota','$nama', '$alamat', '$no_telp')") or die($db->error);
    }

    public function edit($id_alamat, $nama, $id_kota, $alamat, $no_telp)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_alamat SET nama='$nama', id_kota='$id_kota', alamat='$alamat', no_telp='$no_telp' WHERE id_alamat='$id_alamat'");
    }

    public function hapus($id_alamat)
    {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_alamat WHERE id_alamat = '$id_alamat'") or die($db->error);
        
    }

    // function __destruct()
    // {
    //     $db = $this->mysqli->conn;
    //     $db->close();

    // }
}
?>