<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$id = $_POST['id_equipo'];
$serie = $_POST['serie'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$id_proveedor = $_POST['id_proveedor'];

mysqli_query($conexion,"
UPDATE EQUIPO SET
serie='$serie',
marca='$marca',
modelo='$modelo',
tipo='$tipo',
estado='$estado',
id_proveedor=$id_proveedor
WHERE id_equipo=$id
");

mysqli_query($conexion,"
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id, 'Actualización', 'Datos del equipo modificados')
");

header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
exit();
?>