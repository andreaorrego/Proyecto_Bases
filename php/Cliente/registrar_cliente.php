<?php
include("proteger_admin.php");
include("conexion.php");

$id_usuario = $_POST['id_usuario'];
$cedula = $_POST['cedula'];
$cargo = $_POST['cargo'];
$dependencia = $_POST['dependencia'];

$check = $conexion->query("SELECT * FROM USUARIO WHERE id_usuario=$id_usuario");

if ($check->num_rows == 0) {
    die("El usuario no existe");
}

$sql = "
INSERT INTO CLIENTE (id_usuario, cedula, cargo, dependencia)
VALUES ('$id_usuario', '$cedula', '$cargo', '$dependencia')
";

$conexion->query($sql);

header("Location: listar_clientes.php");
exit();
?>