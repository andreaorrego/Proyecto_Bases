<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM CLIENTE WHERE id_usuario=$id";

$conexion->query($sql);

header("Location: listar_clientes.php");
exit();
?>