<?php
include "models/m_alamat.php";

$alamat = new alamat($connection);
$id_user = @$_GET['id_user'];
$cek = $alamat->cek($id_user);
$count = mysqli_num_rows($cek);
$row = mysqli_fetch_array($cek);

if (@$_GET['act'] == ''&& @$_GET['id_user'] != '' && $count != null) {
    ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Data Alamat

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">
                    <i class="icon-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                <i class="icon-file-alt"></i> <?php echo $row['username']; ?></li>
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
                        <th>Nama</th>
                        <th>Kota</th>
                        <th>Alamat</th>
                        <th>No. Telp.</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = $alamat->tampil($id_user);
                    while ($data = $tampil->fetch_object()) {
                        ?>
                    <tr>
                        <td align="center">
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data->nama; ?>
                        </td>
                        <td>
                            <?php echo $data->kota; ?>
                        </td>
                        <td>
                            <?php echo $data->alamat; ?>
                        </td>
                        <td>
                            <?php echo $data->no_telp; ?>
                        </td>
                        <td align="center">
                            <a id="edit_alamat" data-toggle="modal" data-target="#edit" data-id_alamat="<?php echo $data->id_alamat; ?>"
                                data-nama="<?php echo $data->nama; ?>" data-id_kota="<?php echo $data->id_kota; ?>"
                                data-alamat="<?php echo $data->alamat; ?>" data-no_telp="<?php echo $data->no_telp; ?>" <button class="btn btn-info btn-xs">
                                <i class="fa fa-edit"></i></button> </a>
                            <a href="?page=alamat&id_user=<?php echo $id_user; ?>&act=del&id_alamat=<?php echo $data->id_alamat; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                                <button class="btn btn-danger btn-xs">
                            <i class="fas fa-trash-alt"></i></button> </a>
                        </td>
                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"> Tambah Alamat</button>
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tambah Alamat</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kota">Kota</label>
                                <select class="form-control" name="id_kota" id="id_kota" required>
                                <?php 
                                $tampil_kota = $kota->tampil();
                                while ($data = $tampil_kota->fetch_object()) {
                                ?>
                                <option value="<?php echo $data->id_kota; ?>"><?php echo $data->kota; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="no_telp">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                        </div>
                    </form>
                    <?php
                    if (@$_POST['tambah']) {
                        
                        $nama = $connection->conn->real_escape_string($_POST['nama']);
                        $id_kota = $connection->conn->real_escape_string($_POST['id_kota']);
                        $alamat1 = $connection->conn->real_escape_string($_POST['alamat']);
                        $no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
                        $alamat->tambah($id_user, $id_kota, $nama, $alamat1, $no_telp);
                        
                        header("location: ?page=alamat&id_user=$id_user");
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
                        <h4 class="modal-title">Edit Alamat</h4>
                    </div>
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body" id="modal-edit">
                            <input type="hidden" name="id_alamat" class="form-control" id="id_alamat" required>
                            <div class="form-group">
                                <label class="control-label" for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" id="nama" required>
                            </div>
                            <div class="form-group">
                                <label for="id_kota">Kota</label>
                                <select class="form-control" name="id_kota" id="id_kota" required>
                                <?php 
                                $tampil_kota = $kota->tampil();
                                while ($data = $tampil_kota->fetch_object()) {
                                ?>
                                <option value="<?php echo $data->id_kota; ?>"><?php echo $data->kota; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="alamat">Alamat</label>
                                <input type="text" name="alamat" class="form-control" id="alamat" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="no_telp">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control" id="no_telp" required>
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
            $(document).on("click", "#edit_alamat", function () {
                var id_alamat = $(this).data('id_alamat');
                var nama = $(this).data('nama');
                var id_kota = $(this).data('id_kota');
                var alamat = $(this).data('alamat');
                var no_telp = $(this).data('no_telp');
                $("#modal-edit #id_alamat").val(id_alamat);
                $("#modal-edit #nama").val(nama);
                $('option[value="'+id_kota+'"]').prop('selected',true);
                $("#modal-edit #alamat").val(alamat);
                $("#modal-edit #no_telp").val(no_telp);
            })
        </script>
        <?php

        if (@$_POST['edit']) {
            $id_alamat = $connection->conn->real_escape_string($_POST['id_alamat']);
            $nama = $connection->conn->real_escape_string($_POST['nama']);
            $id_kota = $connection->conn->real_escape_string($_POST['id_kota']);
            $alamat1 = $connection->conn->real_escape_string($_POST['alamat']);
            $no_telp = $connection->conn->real_escape_string($_POST['no_telp']);
            $alamat->edit($id_alamat, $nama, $id_kota, $alamat1, $no_telp);
            header("location: ?page=alamat&id_user=$id_user");
        }
        ?>
    </div>
</div>
<?php
} else if (@$_GET['act'] == 'del') {
    $alamat->hapus($_GET['id_alamat']);
    header("location: ?page=alamat&id_user=$id_user");
} else echo "Halaman Tidak Ada";
?>