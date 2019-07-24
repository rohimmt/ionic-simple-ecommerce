<?php

if (@$_GET['act'] == '') {
    ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Data Kota & Tarif Kirim

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">
                    <i class="icon-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                <i class="icon-file-alt"></i> Data Kota & Tarif Kirim</li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped" id="datatables">
                <thead>
                    <tr>
                        <th width="5px">No.</th>
                        <th>Nama Kota</th>
                        <th width="120px">Tarif Kirim (/kg)</th>
                        <th width="5px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = $kota->tampil();
                    while ($data = $tampil->fetch_object()) {
                        ?>
                    <tr>
                        <td align="center">
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data->kota; ?>
                        </td>
                        <td align="right">
                            Rp <?php echo $data->tarif; ?>,-
                        </td>

                        <td align="center">
                            <a id="edit_kota" data-toggle="modal" data-target="#edit" data-id_kota="<?php echo $data->id_kota; ?>"
                                data-kota="<?php echo $data->kota; ?>" data-tarif="<?php echo $data->tarif; ?>" 
                                <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i></button> </a>
                            <a href="?page=kota&act=del&id_kota=<?php echo $data->id_kota; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                                <button class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt"></i></button> </a>
                        </td>
                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"> Tambah Kota</button>

        <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tambah Kategori</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="kota">Nama Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" required>
                            </div>        
                            <div class="form-group">
                                <label class="control-label" for="tarif">Tarif (Rupiah)</label>
                                <input type="number" name="tarif" class="form-control" id="tarif" required>
                            </div>        
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                        </div>
                    </form>
                    <?php
                    if (@$_POST['tambah']) {
                        $kota1 = $connection->conn->real_escape_string($_POST['kota']);
                        $tarif = $connection->conn->real_escape_string($_POST['tarif']);
                        $kota->tambah($kota1, $tarif);
                        header("location: ?page=kota");
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
                        <h4 class="modal-title">Edit Kategori</h4>
                    </div>
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body" id="modal-edit">
                            <input type="hidden" name="id_kota" class="form-control" id="id_kota" required>
                            <div class="form-group">
                                <label class="control-label" for="kota">Nama Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="tarif">Tarif (Rupiah)</label>
                                <input type="number" name="tarif" class="form-control" id="tarif" required>
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
            $(document).on("click", "#edit_kota", function () {
                var id_kota = $(this).data('id_kota');
                var kota = $(this).data('kota');
                var tarif = $(this).data('tarif');
                $("#modal-edit #id_kota").val(id_kota);
                $("#modal-edit #kota").val(kota);
                $("#modal-edit #tarif").val(tarif);
            })
        </script>
        <?php

        if (@$_POST['edit']) {
            $id_kota = $connection->conn->real_escape_string($_POST['id_kota']);
            $kota1 = $connection->conn->real_escape_string($_POST['kota']);
            $tarif = $connection->conn->real_escape_string($_POST['tarif']);
            $kota->edit($id_kota, $kota1, $tarif);
            header("location: ?page=kota");
        }
        ?>
    </div>
</div>
<?php

} else if (@$_GET['act'] == 'del') {
    $kota->hapus($_GET['id_kota']);
    header("location: ?page=kota");
}
?>