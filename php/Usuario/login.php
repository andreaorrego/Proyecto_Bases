<?php
session_start();
include("conexion.php");

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

$sql = "SELECT * FROM USUARIO WHERE correo='$correo' AND contrasena='$contrasena'";
$resultado = mysqli_query($conexion, $sql);

if ($fila = mysqli_fetch_assoc($resultado)) {

    $_SESSION['id_usuario'] = $fila['id_usuario'];

    $id = $fila['id_usuario'];

    $sqlAdmin = "SELECT * FROM ADMINISTRADOR WHERE id_usuario=$id";
    $resAdmin = mysqli_query($conexion, $sqlAdmin);

    if (mysqli_num_rows($resAdmin) > 0) {
        $_SESSION['rol'] = "admin";
    } else {
        $_SESSION['rol'] = "cliente";
    }

    header("Location: ../html/menu.html");
    exit();

} else {
    echo "Usuario o contraseña incorrectos";
}
?>