<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
    exit();
}

$id = mysqli_real_escape_string($conexion, $_GET['id']);

$query = mysqli_query($conexion, "SELECT * FROM EQUIPO WHERE id_equipo=$id");
$equipo = mysqli_fetch_assoc($query);

if (!$equipo) {
    header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
    exit();
}

$proveedores = mysqli_query($conexion, "SELECT * FROM PROVEEDOR");
?>