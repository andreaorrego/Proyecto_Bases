<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

mysqli_query($conexion,"
INSERT INTO ADMINISTRADOR (id_usuario)
VALUES ($id)
");

echo "Usuario ahora es administrador";
?>