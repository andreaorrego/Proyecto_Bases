<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_POST['id_usuario'];
$cedula = $_POST['cedula'];
$cargo = $_POST['cargo'];
$dependencia = $_POST['dependencia'];

$sql = "
UPDATE CLIENTE 
SET cedula='$cedula',
    cargo='$cargo',
    dependencia='$dependencia'
WHERE id_usuario=$id";

$conexion->query($sql);

header("Location: listar_clientes.php");
exit();
?>

