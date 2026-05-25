<?php
session_start();
include("conexion.php");

if (!isset($_SESSION['correo'])) {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM CLIENTE WHERE id_usuario = $id";
$resultado = $conexion->query($sql);
$cliente = $resultado->fetch_assoc();

if (!$cliente) {
    die("Cliente no encontrado");
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Cliente/editar_perfil.html');

$plantilla = str_replace('{{ID_USUARIO}}', $cliente['id_usuario'], $plantilla);
$plantilla = str_replace('{{CEDULA}}', $cliente['cedula'], $plantilla);
$plantilla = str_replace('{{CARGO}}', $cliente['cargo'], $plantilla);
$plantilla = str_replace('{{DEPENDENCIA}}', $cliente['dependencia'], $plantilla);

echo $plantilla;
?>