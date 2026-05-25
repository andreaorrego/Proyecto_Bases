<?php
session_start();
include("../conexion.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM USUARIO WHERE correo='$correo'";
$resultado = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_assoc($resultado);

if ($fila && password_verify($contrasena, $fila['contrasena'])) {

    $_SESSION['id_usuario'] = $fila['id_usuario'];

    $id = $fila['id_usuario'];

    $sqlAdmin = "SELECT * FROM ADMINISTRADOR WHERE id_usuario=$id";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);

    if (mysqli_num_rows($resAdmin) > 0) {
        $_SESSION['rol'] = "admin";
        header("Location: /Proyecto_Bases/php/Sistema/menu_admin.php");
    } else {
        $_SESSION['rol'] = "cliente";
        header("Location: /Proyecto_Bases/php/Sistema/menu_cliente.php");
    }
}
    exit();
?>