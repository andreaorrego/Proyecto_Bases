<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "
UPDATE SOLICITUD_CLIENTE SET
estado='Devuelta',
fecha_retorno=CURDATE()
WHERE id_solicitud=$id
";

mysqli_query($conexion,"
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id, 'Devolución', 'Equipo devuelto al inventario')
");

//mysqli_query($conexion, $sql);

header("Location: listar_solicitudes.php");
exit();
?>