<?php
class Kategori {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }
    
    public function tampil($id_kategori = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_kategori ";
        if($id_kategori != null) {
            $sql .= " WHERE id_kategori = '$id_kategori'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah ($kategori) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_kategori VALUES ('', '$kategori')") or die ($db->error);
    }

    public function edit($id_kategori, $kategori)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_kategori SET kategori='$kategori' WHERE id_kategori='$id_kategori'");
    }
    
    public function hapus($id_kategori) {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'") or die ($db->error);
    }

    // function __destruct() {
    //     $db = $this->mysqli->conn;
    //     $db->close();
        
    // }
}
?>