<?php
include("../conexion.php");

$nombre = $_POST['nombre'];
$apellido = $_POST['apellido'];
$correo = $_POST['correo'];
$contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

$cedula = $_POST['cedula'];
$cargo = $_POST['cargo'];
$dependencia = $_POST['dependencia'];

$verificar = "SELECT id_usuario FROM USUARIO WHERE correo = '$correo'";
$resultado = mysqli_query($conexion, $verificar);

if (mysqli_num_rows($resultado) > 0) {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html");
    exit();
}

$sql_usuario = "INSERT INTO USUARIO (nombre, apellido, correo, contrasena, estado)
                VALUES ('$nombre', '$apellido', '$correo', '$contrasena', 'Activo')";

if (mysqli_query($conexion, $sql_usuario)) {

    $id_nuevo = mysqli_insert_id($conexion);

    $sql_cliente = "INSERT INTO CLIENTE (id_usuario, cedula, cargo, dependencia)
                    VALUES ($id_nuevo, '$cedula', '$cargo', '$dependencia')";

    if (mysqli_query($conexion, $sql_cliente)) {
            header("Location: /Proyecto_Bases/html/Usuario/login.html"); 
        exit();
    } else {
        header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.php?error=db_cliente");
        exit();
    }

} else {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.php?error=db_usuario");
    exit();
}
?>