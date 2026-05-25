<?php
session_start();
include("../conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}

$id = $_SESSION['id_usuario'];

$sqlUsuario = "SELECT u.*, c.cedula, c.cargo, c.dependencia 
               FROM USUARIO u 
               LEFT JOIN CLIENTE c ON u.id_usuario = c.id_usuario 
               WHERE u.id_usuario = $id";

$resUsuario = mysqli_query($conexion, $sqlUsuario);
$usuario = mysqli_fetch_assoc($resUsuario); 

$resP = mysqli_query($conexion, "SELECT COUNT(*) as total FROM SOLICITUD_CLIENTE WHERE id_cliente = $id AND estado = 'Pendiente'");
$pendientes = mysqli_fetch_assoc($resP)['total'] ?? 0; 

$resA = mysqli_query($conexion, "SELECT COUNT(*) as total FROM SOLICITUD_CLIENTE WHERE id_cliente = $id AND estado = 'Aprobada'");
$aprobadas = mysqli_fetch_assoc($resA)['total'] ?? 0;

$resR = mysqli_query($conexion, "SELECT COUNT(*) as total FROM SOLICITUD_CLIENTE WHERE id_cliente = $id AND estado = 'Rechazada'");
$rechazadas = mysqli_fetch_assoc($resR)['total'] ?? 0;

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Usuario/perfil_cliente.html');

$plantilla = str_replace('{{NOMBRE}}', $usuario['nombre'], $plantilla);
$plantilla = str_replace('{{APELLIDO}}', $usuario['apellido'], $plantilla);
$plantilla = str_replace('{{CORREO}}', $usuario['correo'], $plantilla);
$plantilla = str_replace('{{CARGO}}', $usuario['cargo'], $plantilla);
$plantilla = str_replace('{{DEPENDENCIA}}', $usuario['dependencia'], $plantilla);
$plantilla = str_replace('{{ESTADO}}', $usuario['estado'], $plantilla);
$plantilla = str_replace('{{PENDIENTES}}', $pendientes, $plantilla);
$plantilla = str_replace('{{APROBADAS}}', $aprobadas, $plantilla);
$plantilla = str_replace('{{RECHAZADAS}}', $rechazadas, $plantilla);

echo $plantilla;
?>