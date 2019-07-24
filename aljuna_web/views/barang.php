<?php

if(@$_GET['act'] == '') {
?>
  <div class="row">
    <div class="col-lg-12">
      <h1>Data Barang
       
      </h1>
      <ol class="breadcrumb">
        <li>
          <a href="index.php">
            <i class="icon-dashboard"></i> Dashboard</a>
        </li>
        <li class="active">
          <i class="icon-file-alt"></i> Data Barang</li>
      </ol>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-12">
      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="datatables">
          <thead>
          <tr>
            <th>No.</th>
            <th>Gambar</th>
            <th>Kode</th>
            <th>Nama Barang</th>
            <th>Kategori</th>
            <th>Stok</th>
            <th>Satuan</th>
            <th>Berat</th>
            <th width="80px">Harga</th>
            <th>Aksi</th>
          </tr>
          </thead>
          <tbody>
          <?php
          $no = 1;
          if(@$_GET['kategori']) {
            $tampil = $barang->tampil(null,$_GET['kategori']);
          } else {
          $tampil = $barang->tampil(); }
          while ($data = $tampil->fetch_object()) {
            ?>
            <tr>
              <td align="center"><?php echo $no++; ?></td>
              <td><a href="assets/images/barang/<?php echo $data->gambar; ?>"> <img src=assets/images/barang/<?php echo $data->gambar; ?> width="70px"></a></td>
              <td><?php echo $data->kode_barang; ?></td>
              <td><?php echo $data->nama_barang; ?></td>
              <td><?php echo $data->kategori; ?></td>
              <td align="right"><?php echo $data->stok; ?></td>
              <td><?php echo $data->satuan; ?></td>
              <td align="right"><?php echo $data->berat; ?> gr</td>
              <td align="right">Rp <?php echo $data->harga; ?>,-</td>
              <td align="center">
              <a id="edit_barang" data-toggle="modal" data-target="#edit" 
                data-kode="<?php echo $data->kode_barang; ?>" 
                data-kode1="<?php echo $data->kode_barang; ?>" 
                data-nama="<?php echo $data->nama_barang; ?>" 
                data-kategori="<?php echo $data->id_kategori; ?>" 
                data-stok="<?php echo $data->stok; ?>" 
                data-satuan="<?php echo $data->satuan; ?>"
                data-berat="<?php echo $data->berat; ?>"
                data-harga="<?php echo $data->harga; ?>"
                data-gambar="<?php echo $data->gambar; ?>" > 

                <button class="btn btn-info btn-xs">
                  <i class="fa fa-edit"></i></button> </a>
              <a href="?page=barang&act=del&kode_barang=<?php echo $data->kode_barang; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                <button class="btn btn-danger btn-xs">
                <i class="fas fa-trash-alt"></i></button> </a>
              </td>
            </tr>
            <?php 
          } ?>
          </tbody>
        </table>
      </div>
      <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"> Tambah Barang</button>

      <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Tambah Data Barang</h4>
            </div>
            <form action="" method="post" enctype="multipart/form-data">
              <div class="modal-body">
                <div class="form-group">
                  <label class="control-label" for="kode_barang">Kode Barang</label>
                  <input type="text" name="kode_barang" class="form-control" id="kode_barang" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_barang">Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
                </div>
                <div class="form-group">
                  <label for="id_kategori">Kategori</label>
                  <select class="form-control" name="id_kategori" id="id_kategori" required>
                  <?php 
                  $tampil_kategori = $kategori->tampil();
                  while ($data = $tampil_kategori->fetch_object()) {
                  ?>
                  <option value="<?php echo $data->id_kategori; ?>"><?php echo $data->kategori; ?></option>
                  <?php } ?>
                  </select>
                </div>

                <div class="form-group">
                  <label class="control-label" for="stok">Stok</label>
                  <input type="number" name="stok" class="form-control" id="stok" required>
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan</label>
                  <select class="form-control" name="satuan" id="satuan" required>
                  <option value="pcs">pcs</option>
                  <option value="pack">pack</option>
                  <option value="roll">roll</option>
                  <option value="set">set</option>
                  <option value="dz">dz</option>
                  </select>
                </div>
			        	<div class="form-group">
                  <label class="control-label" for="berat">Berat</label>
                  <input type="number" name="berat" class="form-control" id="berat" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="harga">Harga (Rupiah)</label>
                  <input type="number" name="harga" class="form-control" id="harga" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="gambar">Gambar</label>
                  <input type="file" name="gambar" class="form-control" id="gambar" required>
                </div>
             </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
            </div>
            </form>
            <?php
            if (@$_POST['tambah']) {
              $kode_barang = $connection->conn->real_escape_string($_POST['kode_barang']);
              $nama_barang = $connection->conn->real_escape_string($_POST['nama_barang']);
              $id_kategori = $connection->conn->real_escape_string($_POST['id_kategori']);
              $stok = $connection->conn->real_escape_string($_POST['stok']);
              $satuan = $connection->conn->real_escape_string($_POST['satuan']);
              $berat = $connection->conn->real_escape_string($_POST['berat']);
              $harga = $connection->conn->real_escape_string($_POST['harga']);

              $extensi = explode(".", $_FILES['gambar']['name']);
              $gambar = 'b-' . round(microtime(true)) . "." . end($extensi);
              $sumber = $_FILES['gambar']['tmp_name'];
              $upload = move_uploaded_file($sumber, "assets/images/barang/" . $gambar);
              if ($upload) {
                $barang->tambah($kode_barang, $nama_barang, $id_kategori, $stok, $satuan,$berat, $harga, $gambar);
                header("location: ?page=barang");
              } else {
                echo "<script>alert('Upload gambar gagal!')</script>";
              }
            }
            ?>
          </div>
        </div>
      </div>
    

    <div class="modal fade" id="edit" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">Edit Data Barang</h4>
            </div>
            <form id="form" enctype="multipart/form-data">
              <div class="modal-body" id="modal-edit">
                <div class="form-group">
                  <label class="control-label" for="kode_barang">Kode Barang</label>
                  <input type="text" name="kode_barang" class="form-control" id="kode_barang" required>
                  <input type="hidden" name="kode_barang1" class="form-control" id="kode_barang1" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="nama_barang">Nama Barang</label>
                  <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
                </div>
                <div class="form-group">
                  <label for="id_kategori">Kategori</label>
                  <select class="form-control" name="id_kategori" id="id_kategori" required>
                  <?php 
                  $tampil_kategori = $kategori->tampil();
                  while ($data = $tampil_kategori->fetch_object()) {
                  ?>
                  <option value="<?php echo $data->id_kategori; ?>"><?php echo $data->kategori; ?></option>
                  <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <label class="control-label" for="stok">Stok</label>
                  <input type="number" name="stok" class="form-control" id="stok" required>
                </div>
                <div class="form-group">
                  <label for="satuan">Satuan</label>
                  <select class="form-control" name="satuan" id="satuan" required>
                  <option value="pcs">pcs</option>
                  <option value="pack">pack</option>
                  <option value="roll">roll</option>
                  <option value="set">set</option>
                  <option value="dz">dz</option>
                  </select>
                </div>
				<div class="form-group">
                  <label class="control-label" for="berat">Berat</label>
                  <input type="number" name="berat" class="form-control" id="berat" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="harga">Harga (Rupiah)</label>
                  <input type="number" name="harga" class="form-control" id="harga" required>
                </div>
                <div class="form-group">
                  <label class="control-label" for="gambar">Gambar</label>
                    <div>
                      <img src="" width="80px" id="pict">
                    </div>

                  <input type="file" name="gambar" class="form-control" id="gambar">
                </div>
             </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-success" name="edit" value="Simpan">
            </div>
            </form>
            
          </div>
        </div>
      </div>
      <script src="assets/js/jquery-1.10.2.js"></script>
      <script type="text/javascript"> 
      $(document).on("click", "#edit_barang", function() {
        var kodebarang = $(this).data('kode');
        var kodebarang1 = $(this).data('kode1');
        var namabarang = $(this).data('nama');
        var kategori = $(this).data('kategori');
        var stok = $(this).data('stok');
        var satuan = $(this).data('satuan');
        var berat = $(this).data('berat');
        var harga = $(this).data('harga');
        var gambar = $(this).data('gambar');
        $("#modal-edit #kode_barang").val(kodebarang);
        $("#modal-edit #kode_barang1").val(kodebarang1);
        $("#modal-edit #nama_barang").val(namabarang);
        $('option[value="'+kategori+'"]').prop('selected',true);
        $("#modal-edit #stok").val(stok);
        $('option[value="'+satuan+'"]').prop('selected',true);
        $("#modal-edit #berat").val(berat);
        $("#modal-edit #harga").val(harga);
        $("#modal-edit #pict").attr("src", "assets/images/barang/"+gambar);
      })

      $(document).ready(function(e) {
        $("#form").on("submit", (function(e) {
          e.preventDefault();
          $.ajax({
            url : 'models/proses_edit_barang.php',
            type : 'POST',
            data : new FormData(this),
            contentType : false,
            cache : false,
            processData : false,
            success : function(msg) {
              $('.table').html(msg);
            }
          });
        }));
      })
      </script>
      
    </div>
    </div>
    <?php
    } else if(@$_GET['act'] == 'del') {
      $gambar_awal = $barang->tampil($_GET['kode_barang'])->fetch_object()->gambar;
      unlink("assets/images/barang/".$gambar_awal);
      $barang->hapus($_GET['kode_barang']);
      header("location: ?page=barang");
    }
    ?>