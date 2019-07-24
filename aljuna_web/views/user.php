<?php
include "models/m_user.php";

$user = new user($connection);

if (@$_GET['act'] == '') {
    ?>
<div class="row">
    <div class="col-lg-12">
        <h1>Data User

        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="index.php">
                    <i class="icon-dashboard"></i> Dashboard</a>
            </li>
            <li class="active">
                <i class="icon-file-alt"></i> Data User</li>
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
                        <th>Username</th>
                        <th>Hak Akses</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $tampil = $user->tampil();
                    while ($data = $tampil->fetch_object()) {
                        ?>
                    <tr>
                        <td align="center">
                            <?php echo $no++; ?>
                        </td>
                        <td>
                            <?php echo $data->username; ?>
                        </td>
                        <td>
                            <?php 
                            if ($data->hak == 1) echo "Admin";
                            else echo "Kustomer";
                            ?>
                        </td>
                        <td align="center">
                            <a href="?page=alamat&id_user=<?php echo $data->id_user; ?>">
                                <button class="btn btn-light btn-xs">
                                    <i class="fa fa-map-marker-alt" title="List alamat"></i></button> </a>
                            <a id="edit_user" data-toggle="modal" data-target="#edit" data-id_user="<?php echo $data->id_user; ?>"
                                data-username="<?php echo $data->username; ?>" data-password="<?php echo $data->password; ?>"
                                data-hak="<?php echo $data->hak; ?>" <button class="btn btn-info btn-xs">
                                <i class="fa fa-edit" title="Edit"></i></button> </a>
                            <a href="?page=user&act=del&id_user=<?php echo $data->id_user; ?>" onclick="return confirm('Yakin akan menghapus data ini?')">
                                <button class="btn btn-danger btn-xs">
                                    <i class="fas fa-trash-alt" title="Hapus"></i></button> </a>
                        </td>
                    </tr>
                    <?php 
                } ?>
                </tbody>
            </table>
        </div>
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah"> Tambah User</button>
        <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Tambah User</h4>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="hak">Hak</label><br>
                                <label><input type="radio" name="hak" value="2" id="hak" checked> Kustomer</label>&nbsp
                                &nbsp &nbsp &nbsp
                                <label><input type="radio" name="hak" value="1" id="hak"> Admin </label>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="reset" class="btn btn-danger">Reset</button>
                            <input type="submit" class="btn btn-success" name="tambah" value="Simpan">
                        </div>
                    </form>
                    <?php
                    if (@$_POST['tambah']) {
                        $username = $connection->conn->real_escape_string($_POST['username']);
                        $password = $connection->conn->real_escape_string($_POST['password']);
                        $hak = $connection->conn->real_escape_string($_POST['hak']);
                        $user->tambah($username, $password, $hak);
                        header("location: ?page=user");
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
                        <h4 class="modal-title">Edit User</h4>
                    </div>
                    <form id="form" action="" method="post" enctype="multipart/form-data">
                        <div class="modal-body" id="modal-edit">
                            <input type="hidden" name="id_user" class="form-control" id="id_user" required>
                            <div class="form-group">
                                <label class="control-label" for="username">Username</label>
                                <input type="text" name="username" class="form-control" id="username" required>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password</label>
                                <input type="password" name="password" class="form-control" id="password" required>
                            </div>
                            <div class="form-group">
                                <label for="hak">Hak</label><br>
                                <label><input type="radio" name="hak" value="2" id="kustomer"> Kustomer</label>&nbsp
                                &nbsp &nbsp &nbsp
                                <label><input type="radio" name="hak" value="1" id="admin"> Admin </label>
                                </select>
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
            $(document).on("click", "#edit_user", function () {
                var id_user = $(this).data('id_user');
                var username = $(this).data('username');
                var password = $(this).data('password');
                var hak = $(this).data('hak');
                $("#modal-edit #id_user").val(id_user);
                $("#modal-edit #username").val(username);
                $("#modal-edit #password").val(password);
                $('input[name="hak"][value="' + hak + '"]').prop('checked', true);
            })
        </script>
        <?php

        if (@$_POST['edit']) {
            $id_user = $connection->conn->real_escape_string($_POST['id_user']);
            $username = $connection->conn->real_escape_string($_POST['username']);
            $password = $connection->conn->real_escape_string($_POST['password']);
            $hak = $connection->conn->real_escape_string($_POST['hak']);
            $user->edit($id_user, $username, $password, $hak);
            header("location: ?page=user");
        }
        ?>
    </div>
</div>
<?php

} else if (@$_GET['act'] == 'del') {
    $user->hapus($_GET['id_user']);
    header("location: ?page=user");
}
?>