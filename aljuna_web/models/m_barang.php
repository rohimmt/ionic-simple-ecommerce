<?php
class Barang {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($kode_barang = null, $id_kategori = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_barang, tb_kategori WHERE tb_barang.id_kategori=tb_kategori.id_kategori";
        if($kode_barang != null) {
            $sql .= " AND kode_barang = '$kode_barang'";
        }
        if($id_kategori != null) {
            $sql .= " AND tb_barang.id_kategori = '$id_kategori'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }
    
    public function tampil_kategori($id_kategori = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_kategori ";
        if($id_kategori != null) {
            $sql .= " WHERE id_kategori = '$id_kategori'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah ($kode_barang, $nama_barang, $id_kategori, $stok, $satuan, $berat, $harga, $gambar) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_barang VALUES ('$kode_barang', '$nama_barang', '$id_kategori', '$stok', '$satuan', '$berat', '$harga', '$gambar')") or die ($db->error);
    }

    public function tambah_kategori ($id_kategori, $kategori) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_kategori VALUES ('$id_kategori', '$kategori')") or die ($db->error);
    }

    public function edit($sql) {
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }

    public function edit_kategori($sql) {
        $db = $this->mysqli->conn;
        $db->query($sql) or die ($db->error);
    }

    public function hapus($kode_barang) {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_barang WHERE kode_barang = '$kode_barang'") or die ($db->error);
    }
    
    public function hapus_kategori($id_kategori) {
        $db = $this->mysqli->conn;
        $db->query("DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'") or die ($db->error);
    }

    // function __destruct() {
    //     $db = $this->mysqli->conn;
    //     $db->close();
        
    // }
}
?>