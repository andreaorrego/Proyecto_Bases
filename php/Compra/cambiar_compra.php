<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

mysqli_query($conexion,"
UPDATE SOLICITUD_COMPRA
SET estado='Recibida'
WHERE id_compra=$id
");

header("Location: listar_compra.php");
exit();
?>