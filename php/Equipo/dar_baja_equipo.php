<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
    exit();
}

$id_solicitud = mysqli_real_escape_string($conexion, $_GET['id']);

$query_equipo = "SELECT id_equipo FROM SOLICITUD_CLIENTE WHERE id_solicitud = $id_solicitud";
$resultado = mysqli_query($conexion, $query_equipo);
$datos = mysqli_fetch_assoc($resultado);

if ($datos) {
    $id_equipo = $datos['id_equipo'];

    mysqli_query($conexion, "UPDATE SOLICITUD_CLIENTE SET estado='Devuelta' WHERE id_solicitud=$id_solicitud");

    mysqli_query($conexion, "UPDATE EQUIPO SET estado='Activo' WHERE id_equipo = $id_equipo");

    mysqli_query($conexion, "INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion) 
                             VALUES ($id_equipo, 'Devolución', 'Equipo devuelto y marcado como activo')");
}

header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
exit();
?>