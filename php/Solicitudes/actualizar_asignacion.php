<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_POST['id_solicitud'];
$id_equipo = $_POST['id_equipo'];
$responsable = $_POST['responsable'];
$dependencia = $_POST['dependencia'];
$fecha_retorno = $_POST['fecha_retorno'];

mysqli_query($conexion, "
UPDATE SOLICITUD_CLIENTE SET
id_equipo='$id_equipo',
responsable='$responsable',
dependencia='$dependencia',
fecha_retorno='$fecha_retorno',
estado='Entregada'
WHERE id_solicitud=$id
");

mysqli_query($conexion, "
UPDATE EQUIPO 
SET estado='Transferido'
WHERE id_equipo=$id_equipo
");

mysqli_query($conexion, "
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id_equipo, 'Transferencia', 'Equipo asignado a solicitud')
");

header("Location: listar_solicitudes.php");
exit();
?>