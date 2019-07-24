<?php
class Pesanan {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($id_pesanan = null, $status=null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_pesanan, tb_user WHERE tb_pesanan.id_user=tb_user.id_user";
        if($id_pesanan != null) {
            $sql .= " AND id_pesanan = '$id_pesanan'";
        } else if($status == '5') {
            $sql .= " AND status = '5' AND status = '6' ORDER BY id_pesanan DESC";
        } else if($status == '1') {
            $sql .= " AND status = '1' AND status = '7' ORDER BY id_pesanan DESC";
        } else if($status != null) {
            $sql .= " AND status = '$status' ORDER BY id_pesanan DESC";
        } else {
            $sql .= " ORDER BY id_pesanan DESC ";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tampil_detail($id_pesanan = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_detail_pesanan";
        if($id_pesanan != null) {
            $sql .= " WHERE id_pesanan = '$id_pesanan'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah ($kode_barang, $nama_barang, $id_kategori, $stok, $satuan, $berat, $harga, $gambar) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_barang VALUES ('$kode_barang', '$nama_barang', '$id_kategori', '$stok', '$satuan', '$berat', '$harga', '$gambar')") or die ($db->error);
    }

    public function kirim($id_pesanan, $resi) 
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_pesanan SET status='3', resi='$resi' WHERE id_pesanan='$id_pesanan'");
    }
    public function selesai($id_pesanan)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_pesanan SET status='4' WHERE id_pesanan='$id_pesanan'");
    }
    public function tolak($id_pesanan)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_pesanan SET status='7' WHERE id_pesanan='$id_pesanan'");
    }
    
    public function batal($id_pesanan)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_pesanan SET status='5' WHERE id_pesanan='$id_pesanan'");

        $tampil = $this->tampil_detail($id_pesanan);
          while ($data = $tampil->fetch_object()) {
            $db->query("UPDATE tb_barang SET stok=stok+$data->jumlah WHERE kode_barang='$data->kode_barang'");  
          }
    }

}
?>