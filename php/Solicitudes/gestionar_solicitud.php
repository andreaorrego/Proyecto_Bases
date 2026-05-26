<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$sql = "SELECT * FROM SOLICITUD_CLIENTE WHERE id_solicitud = $id";
$resultado = mysqli_query($conexion, $sql);

$solicitud = mysqli_fetch_assoc($resultado);

if (!$solicitud) {
    die("Solicitud no encontrada.");
}

$estado_actual = $solicitud['estado'];
$id_solicitud = $solicitud['id_solicitud'];

include(__DIR__ . "/../../html/Solicitudes/gestionar_solicitud.html");
?>