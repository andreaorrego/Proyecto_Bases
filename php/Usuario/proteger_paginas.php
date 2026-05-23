<?php
session_start();
include("proteger_admin.php");
include("conexion.php");

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "admin") {
    header("Location: ../html/login.html");
    exit();
}
?>