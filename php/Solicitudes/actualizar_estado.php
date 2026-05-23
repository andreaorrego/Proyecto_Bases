<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_POST['id_solicitud'];
$estado = $_POST['estado'];

$sql = "
UPDATE SOLICITUD_CLIENTE SET
estado='$estado'
WHERE id_solicitud=$id
";

mysqli_query($conexion, $sql);

header("Location: listar_solicitudes.php");
exit();
?>