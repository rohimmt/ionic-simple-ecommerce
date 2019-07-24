<?php
class Kota {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }
    
    public function tampil($id_kota = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_kota ";
        if($id_kota != null) {
            $sql .= " WHERE id_kota = '$id_kota'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah ($kota, $tarif) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_kota VALUES ('', '$kota', '$tarif')") or die ($db->error);
    }

    public function edit($id_kota, $kota, $tarif)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_kota SET kota='$kota', tarif='$tarif' WHERE id_kota='$id_kota'");
    }
    
    public function hapus($id_kota) {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_kota WHERE id_kota = '$id_kota'") or die ($db->error);
    }

    // function __destruct() {
    //     $db = $this->mysqli->conn;
    //     $db->close();
        
    // }
}
?>