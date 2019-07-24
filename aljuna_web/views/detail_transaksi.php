<?php
include "models/m_transaksi.php";

$transaksi = new transaksi($connection);

$tampil = $transaksi->tampil(@$_GET['id_transaksi']);
$data = $tampil->fetch_object();
?>
<div class="row">
  <div class="col-lg-12">
    <h1>Detail Transaksi
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="index.php">
          <i class="icon-dashboard"></i> Dashboard</a>
      </li>
      <li>
        <a href="?page=transaksi">
          <i class="icon-dashboard"></i> Transaksi</a>
      </li>
      <li class="active">
        <i class="icon-file-alt"></i> Pesanan
        <?php echo $data->waktu; ?>
      </li>
    </ol>
  </div>
</div>
<div class="row">
  <div class="col-lg-12">
    <div class="table-responsive">

      <div class="col-lg-8">
        <table>
          <tr>
            <td>Waktu Pesan</td>
            <td>: <b>
                <?php echo $data->waktu; ?></b></td>
          </tr>
          <tr>
            <td>Resi</td>
            <td>: <b>
                <?php if ($data->status == '3' || $data->status == '4') echo $data->resi;
                else echo ' - '; ?></b></td>
          </tr>
          <tr>
            <td>Username</td>
            <td>:
              <?php echo $data->username; ?>
            </td>
          </tr>
          <tr>
            <td>Nama Penerima</td>
            <td>:
              <?php echo $data->nama; ?>
            </td>
          </tr>
          <tr>
            <td>Alamat</td>
            <td>:
              <?php echo $data->alamat; ?>
            </td>
          </tr>
          <tr>
            <td>Kota</td>
            <td>:
              <?php echo $data->kota; ?>
            </td>
          </tr>
          <tr>
            <td>No. Telepon</td>
            <td>:
              <?php echo $data->no_telp; ?>
            </td>
          </tr>

        </table>
      </div>
      <div class="col-lg-4">
        <p><b>Status :
            <?php 
            if ($data->status == '1') echo 'Menunggu Pembayaran';
            else if ($data->status == '2') echo 'Diproses';
            else if ($data->status == '3') echo 'Dikirim';
            else if ($data->status == '4') echo 'Selesai';
            else if ($data->status == '5') echo 'Batal';
            else if ($data->status == '6') echo 'Batal';
            else if ($data->status == '7') echo 'Menunggu Pembayaran';
            else echo 'Batal';
            ?></b></p>
        <p>Bukti Pembayaran :</p>
        <p><a href="assets/images/bukti/<?php echo $data->bukti; ?>"><img src="./assets/images/bukti/<?php echo $data->bukti; ?>"
              alt="" width="70px"></a></p>
      </div>
      <?php 
      ?>
      <br><br><br><br><br>
      <table class="table table-bordered table-hover table-striped" id="datatables">
        <thead>
          <tr>
            <th width="5px">No.</th>
            <th>Gambar</th>
            <th width="100px">Kode Barang</th>
            <th>Nama Barang</th>
            <th width="5px">Jumlah</th>
            <th width="5px">Satuan</th>
            <th width="5px">Berat(gr)</th>
            <th width="80px">Harga</th>
            <th width="80px">Total</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          $tampil = $transaksi->tampil_detail(@$_GET['id_transaksi']);
          while ($data2 = $tampil->fetch_object()) {
            ?>
          <tr>
            <td align="center">
              <?php echo $no++; ?>
            </td>
            <td><a href="assets/images/pesanan/<?php echo $data2->gambar; ?>"> <img src=assets/images/pesanan/<?php echo $data2->gambar; ?> width="70px"></a></td>
            <td>
              <?php echo $data2->kode_barang; ?>
            </td>
            <td>
              <?php echo $data2->nama_barang; ?>
            </td>
            <td align="right">
              <?php echo $data2->jumlah; ?>
            </td>
            <td>
              <?php echo $data2->satuan; ?>
            </td>
            <td align="right">
              <?php echo $data2->berat; ?>
            </td>
            <td align="right">Rp
              <?php echo $data2->harga; ?>,-</td>
            <td align="right">Rp
              <?php echo $data2->harga * $data2->jumlah; ?>,-</td>
          </tr>
          <?php 
        } ?>
        </tbody>
      </table>
    </div>
    <div class="col-lg-12" align="center">
      <h4><b>SUBTOTAL : Rp
          <?php echo $data->subtotal; ?>,-</b></h4>
      <h4><b>SUBTOTAL ONGKIR : Rp
          <?php echo $data->subtotalongkir; ?>,-</b></h4>
      <h3><b>TOTAL BAYAR : Rp
          <?php echo $data->total; ?>,-</b></h3>

    </div>
    <div class="col-lg-12">

      <form id="form" action="" method="post" enctype="multipart/form-data">
        <input type="submit" class="btn btn-primary" name="selesai" value="Selesai" onclick="return confirm('Selesaikan Pesanan?')"
          <?php if ($data->status != '3') echo 'Disabled'; ?>>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#kirim" <?php if ($data->status == '4' || $data->status == '5') echo 'Disabled'; ?>>
          <?php if ($data->status == '3' || $data->status == '4') echo 'Ubah Resi';
          else echo 'Kirim Barang'; ?></button>
          <input type="submit" class="btn btn-warning" name="tolak" value="Tolak Bukti Pembayaran" onclick="return confirm('Tolak bukti pembayaran?')"
          <?php if ($data->status == '4' || $data->status == '5') echo 'Disabled'; ?>>
        <input type="submit" class="btn btn-danger" name="batal" value="Batalkan" onclick="return confirm('Batalkan transaksi?')"
          <?php if ($data->status == '4' || $data->status == '5') echo 'Disabled'; ?>>
      </form>
    </div>
    <div class="modal fade" id="kirim" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">
              <?php if ($data->status == '3' || $data->status == '4') echo 'Ubah Resi';
              else echo 'Kirim Barang'; ?>
            </h4>
          </div>
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label class="control-label" for="resi">Nomor Resi</label>
                <input name="resi" class="form-control" id="resi" required type="text" value="<?php echo $data->resi; ?>"
                  pattern="\d*" maxlength="12">
              </div>
              <div class="modal-footer">
                <button type="reset" class="btn btn-danger">Reset</button>
                <input type="submit" class="btn btn-success" name="kirim" value="Kirim">
              </div>
          </form>

        </div>
      </div>
    </div>
    <?php
    if (@$_POST['kirim']) {
      $resi = $connection->conn->real_escape_string($_POST['resi']);
      $transaksi->kirim($data->id_transaksi, $resi);
      header("location:?page=detail_transaksi&id_transaksi=" . $data->id_transaksi);
    } else if (@$_POST['selesai']) {
      $transaksi->selesai($data->id_transaksi);
      header("location:?page=detail_transaksi&id_transaksi=" . $data->id_transaksi);
    } else if (@$_POST['batal']) {
      $transaksi->batal($data->id_transaksi);
      header("location:?page=detail_transaksi&id_transaksi=" . $data->id_transaksi);
    } else if (@$_POST['tolak']) {
      $transaksi->tolak($data->id_transaksi);
      header("location:?page=detail_transaksi&id_transaksi=" . $data->id_transaksi);
    }
    ?>