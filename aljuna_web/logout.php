<?php
session_start();
$_SESSION["id_user"] = "";
session_destroy();
header("Location: login.php");
?>