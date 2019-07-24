<?php
class Transaksi {

    private $mysqli;

    function __construct($conn)
    {
        $this->mysqli = $conn;
    }

    public function tampil($id_transaksi = null, $status=null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_transaksi, tb_user WHERE tb_transaksi.id_user=tb_user.id_user";
        if($id_transaksi != null) {
            $sql .= " AND id_transaksi = '$id_transaksi'";
        } else if($status == '5') {
            $sql .= " AND status = '5' AND status = '6' ORDER BY id_transaksi DESC";
        } else if($status == '1') {
            $sql .= " AND status = '1' AND status = '7' ORDER BY id_transaksi DESC";
        } else if($status != null) {
            $sql .= " AND status = '$status' ORDER BY id_transaksi DESC";
        } else {
            $sql .= " ORDER BY id_transaksi DESC ";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tampil_detail($id_transaksi = null) {
        $db = $this->mysqli->conn;
        $sql = "SELECT * FROM tb_detail_transaksi";
        if($id_transaksi != null) {
            $sql .= " WHERE id_transaksi = '$id_transaksi'";
        }
        $query = $db->query($sql) or die ($db->error);
        return $query;
    }

    public function tambah ($kode_barang, $nama_barang, $id_kategori, $stok, $satuan, $berat, $harga, $gambar) {
        $db = $this->mysqli->conn;
        $db->query("INSERT INTO tb_barang VALUES ('$kode_barang', '$nama_barang', '$id_kategori', '$stok', '$satuan', '$berat', '$harga', '$gambar')") or die ($db->error);
    }

    public function kirim($id_transaksi, $resi)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_transaksi SET status='3', resi='$resi' WHERE id_transaksi='$id_transaksi'");
    }
    public function selesai($id_transaksi)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_transaksi SET status='4' WHERE id_transaksi='$id_transaksi'");
    }
    public function tolak($id_transaksi)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_transaksi SET status='7' WHERE id_transaksi='$id_transaksi'");
    }
    
    public function batal($id_transaksi)
    {
        $db = $this->mysqli->conn;
        $db->query("UPDATE tb_transaksi SET status='5' WHERE id_transaksi='$id_transaksi'");

        $tampil = $this->tampil_detail($id_transaksi);
          while ($data = $tampil->fetch_object()) {
            $db->query("UPDATE tb_barang SET stok=stok+$data->jumlah WHERE kode_barang='$data->kode_barang'");  
          }
    }

}
?>