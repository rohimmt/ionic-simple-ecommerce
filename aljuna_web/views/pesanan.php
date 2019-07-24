<?php
include "models/m_pesanan.php";

$pesanan = new pesanan($connection);


?>
  <div class="row">
    <div class="col-lg-12">
      <h1>Pesanan
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="index.php">
            <i class="icon-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">
          <i class="icon-file-alt"></i> Pesanan</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="datatables">
          <thead>
          <tr>
            <th width="5px" >No.</th>
            <th width="200px">User</th>
            <th width="100px">Waktu Pesan</th>
            <th width="100px">Total</th>
            <th width="120px">Status</th>
            <th width="50px">Aksi</th>
           
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          $tampil = $pesanan->tampil(null,@$_GET['status']);
          while ($data = $tampil->fetch_object()) {
            ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><?php echo $data->username; ?></td>
              <td><?php echo $data->waktu; ?></td>
              <td align="right">Rp <?php echo $data->total; ?>,-</td>
              <td><?php 
                        if ($data->status=='1') echo 'Menunggu Pembayaran';
                        else if ($data->status=='2') echo 'Diproses';
                        else if ($data->status=='3') echo 'Dikirim';
                        else if ($data->status=='4') echo 'Selesai';                  
                        else if ($data->status=='5') echo 'Batal';                  
                        else if ($data->status=='6') echo 'Batal';                  
                        else if ($data->status=='7') echo 'Bukti Pembayaran Salah';                  
                        else echo ' - ';                  
                        ?></td>
              <td><a class="btn btn-info" href="?page=detail_pesanan&id_pesanan=<?php echo $data->id_pesanan; ?>">Detail</a></td>
            </tr>
            <?php 
          } ?>
          </tbody>
        </table>
      </div>
      