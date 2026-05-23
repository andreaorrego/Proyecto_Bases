<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

mysqli_query($conexion, "
UPDATE SOLICITUD_CLIENTE 
SET estado='Devuelta'
WHERE id_solicitud=$id
");

mysqli_query($conexion, "
UPDATE EQUIPO 
SET estado='Activo'
WHERE id_equipo = (
    SELECT id_equipo 
    FROM SOLICITUD_CLIENTE 
    WHERE id_solicitud=$id
)
");

mysqli_query($conexion,"
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id, 'Baja', 'Equipo dado de baja')
");

header("Location: listar_solicitudes.php");
exit();
?>