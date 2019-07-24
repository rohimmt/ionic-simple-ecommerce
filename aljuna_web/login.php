<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Aljuna Archery - Admin Login</title>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<script src="assets/js/jquery-1.10.2.js"></script>
<script src="assets/js/bootstrap.js"></script>
<style type="text/css">
    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-login {
		color: #636363;
		width: 350px;
	}
	.modal-login .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
	}
	.modal-login .modal-header {
		border-bottom: none;
		position: relative;
		justify-content: center;
	}
	.modal-login h4 {
		text-align: center;
		font-size: 26px;
	}
	.modal-login  .form-group {
		position: relative;
	}
	.modal-login i {
		position: absolute;
		left: 13px;
		top: 11px;
		font-size: 18px;
	}
	.modal-login .form-control {
		padding-left: 40px;
	}
	.modal-login .form-control:focus {
		border-color: #12b5e5;
	}
	.modal-login .form-control, .modal-login .btn {
		min-height: 40px;
		border-radius: 3px; 
        transition: all 0.5s;
	}
	.modal-login .close {
        position: absolute;
		top: -5px;
		right: -5px;
	}
    .modal-login input[type="checkbox"] {
        margin-top: 1px;
    }
    .modal-login .forgot-link {
        color: #12b5e5;
        float: right;
    }
	.modal-login .btn {
		background: #12b5e5;
		border: none;
		line-height: normal;
	}
	.modal-login .btn:hover, .modal-login .btn:focus {
		background: #10a3cd;
	}
	.modal-login .modal-footer {
		color: #999;
		border: none;
		text-align: center;
		border-radius: 5px;
		font-size: 13px;
        margin-top: -20px;
		justify-content: center;
	}
	.modal-login .modal-footer a {
		color: #12b5e5;
	}
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
	}
</style>
</head>
<body>
<?php
session_start();
ob_start();
require_once('config/koneksi.php');
require_once('models/database.php');
$connection = new Database($host, $user, $pass, $database);
include "models/m_login.php";

$login = new login($connection);


if(!empty($_POST["login"])) {
	$res = $login->login(@$_POST["username"], @$_POST["password"]);
	if($res == "sukses") { 
		$_SESSION["id_user"] = $_POST['username'];
		header("Location: index.php");
echo "sds".$res;
echo "us".$_POST['username'];
echo "ses".$_SESSION["id_user"];
	} else {
		?>
        <div class="alert alert-danger" role="alert">
        Username / Password yang Anda masukkan salah!ss <?php echo $res; ?>
        </div>
<?php	
	}
}
?>
	
<?php if(empty($_SESSION["id_user"])) { ?>
<!-- Modal HTML -->
<div>
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Masuk sebagai Admin <?php $_SESSION["id_user"]; ?></h4>
				
			</div>
			<div class="modal-body">
				<form action="" method="post" id="frmLogin"> 
					<div class="form-group">
						<i class="fa fa-user"></i>
						<input type="text" name="username" class="form-control" placeholder="Username" required="required">
					</div>
					<div class="form-group">
						<i class="fa fa-lock"></i>
						<input type="password" name="password" class="form-control" placeholder="Password" required="required">					
					</div>
  
					<div class="form-group">
						<input type="submit" name="login" class="btn btn-primary btn-block btn-lg" value="Masuk">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>  
<?php } else { 
    header("Location: index.php");
 } ?>      
</body>
</html>
                             		                            