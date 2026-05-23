<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_POST['id_equipo'];
$serial = $_POST['serie'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo'];
$estado = $_POST['estado'];
$id_proveedor = $_POST['id_proveedor'];

$sql = "
UPDATE EQUIPO SET
    serie='$serie',
    marca='$marca',
    modelo='$modelo',
    tipo='$tipo',
    estado='$estado',
    id_proveedor='$id_proveedor'
WHERE id_equipo=$id
";

mysqli_query($conexion, $sql);

header("Location: listar_equipos.php");
exit();
?>