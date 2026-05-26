<?php
session_start();
require_once __DIR__ . "/../conexion.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}

$id = (int) $_SESSION['id_usuario'];

$sql = "SELECT u.nombre, u.apellido, u.correo, u.estado, c.cedula, c.cargo, c.dependencia
        FROM USUARIO u
        INNER JOIN CLIENTE c ON u.id_usuario = c.id_usuario
        WHERE u.id_usuario = $id";

$resultado = mysqli_query($conexion, $sql);
$cliente = mysqli_fetch_assoc($resultado);

if (!$cliente) { die("Cliente no encontrado"); }

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Cliente/editar_perfil.html');

$plantilla = str_replace(
    ['{{ID_USUARIO}}', '{{NOMBRE}}', '{{APELLIDO}}', '{{CORREO}}', '{{ESTADO}}', '{{CEDULA}}', '{{CARGO}}', '{{DEPENDENCIA}}'],
    [$id, $cliente['nombre'], $cliente['apellido'], $cliente['correo'], $cliente['estado'], $cliente['cedula'], $cliente['cargo'], $cliente['dependencia']],
    $plantilla
);

echo $plantilla;
?>