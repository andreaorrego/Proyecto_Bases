<?php
session_start();
session_destroy();
include("proteger_admin.php");
include("conexion.php");

header("Location: login.html");
exit();
?>