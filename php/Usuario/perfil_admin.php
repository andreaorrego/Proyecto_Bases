<?php
include(__DIR__ . "/../Sistema/proteger_admin.php");
include(__DIR__ . "/../conexion.php");

$id_admin = $_SESSION['id_usuario'];

$sql = "SELECT nombre, apellido, correo
        FROM USUARIO
        WHERE id_usuario = '$id_admin'";

$resultado = mysqli_query($conexion, $sql);
$admin = mysqli_fetch_assoc($resultado);

$nombre_completo = $admin['nombre'] . ' ' . $admin['apellido'];

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] .
    '/Proyecto_Bases/html/Usuario/perfil_admin.html'
);

$plantilla = str_replace(
    '{{NOMBRE_ADMIN}}',
    $nombre_completo,
    $plantilla
);

$plantilla = str_replace(
    '{{CORREO_ADMIN}}',
    $admin['correo'],
    $plantilla
);

echo $plantilla;
?>