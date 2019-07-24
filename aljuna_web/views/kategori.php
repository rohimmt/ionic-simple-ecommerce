<?php
if (@$_GET['act'] == '') {
    ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Data Kategori

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">
                    <i class="icon-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                <i class="icon-file-alt"></i> Data Kategori</li>
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
                        <th>Kategori</th>
                        <th width="100px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = $kategori->tampil();
                    while ($data = $tampil->fetch_object()) {
                        ?>
                    <tr>
                        <td align="center">
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data->kategori; ?>
                        </td>

                        <td align="center">
                            <a id="edit_kategori" data-toggle="modal" data-target="#edit" data-id_kategori="<?php echo $data->id_kategori; ?>"
                                data-kategori="<?php echo $data->kategori; ?>" <button class="btn btn-info btn-xs">
                                <i class="fa fa-edit"></i></button> </a>
                            <a href="?page=kategori&act=del&id_kategori=<?php echo $data->id_kategori; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                                <button class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt"></i></button> </a>
                        </td>
                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"> Tambah Kategori</button>

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
                                <label class="control-label" for="kategori">Kategori</label>
                                <input type="text" name="kategori" class="form-control" id="kategori" required>
                            </div>        
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                        </div>
                    </form>
                    <?php
                    if (@$_POST['tambah']) {
                        $nama_kategori = $connection->conn->real_escape_string($_POST['kategori']);
                        $kategori->tambah($nama_kategori);
                        header("location: ?page=kategori");
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
                            <input type="hidden" name="id_kategori" class="form-control" id="id_kategori" required>
                            <div class="form-group">
                                <label class="control-label" for="kategori">Kategori</label>
                                <input type="text" name="kategori" class="form-control" id="kategori" required>
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
            $(document).on("click", "#edit_kategori", function () {
                var id_kategori = $(this).data('id_kategori');
                var kategori = $(this).data('kategori');
                $("#modal-edit #id_kategori").val(id_kategori);
                $("#modal-edit #kategori").val(kategori);
            })
        </script>
        <?php

        if (@$_POST['edit']) {
            $id_kategori = $connection->conn->real_escape_string($_POST['id_kategori']);
            $nama_kategori = $connection->conn->real_escape_string($_POST['kategori']);
            $kategori->edit($id_kategori, $nama_kategori);
            header("location: ?page=kategori");
        }
        ?>
    </div>
</div>
<?php

} else if (@$_GET['act'] == 'del') {
    $kategori->hapus($_GET['id_kategori']);
    header("location: ?page=kategori");
}
?>