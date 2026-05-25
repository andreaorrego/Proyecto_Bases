<?php
session_start();
require_once("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    die("Debe iniciar sesión.");
}

$id_admin_actual = $_SESSION['id_usuario'];

$sql = "SELECT id_usuario
        FROM ADMINISTRADOR
        WHERE id_usuario = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_admin_actual);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) === 0) {
    die("Acceso denegado. Solo los administradores pueden realizar esta acción.");
}

if (!isset($_GET['id'])) {
    die("ID de usuario no recibido.");
}

$id_usuario = (int) $_GET['id'];

if ($id_usuario <= 0) {
    die("ID inválido.");
}

$sql = "SELECT id_usuario
        FROM USUARIO
        WHERE id_usuario = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) === 0) {
    die("El usuario no existe.");
}

$sql = "SELECT id_usuario
        FROM ADMINISTRADOR
        WHERE id_usuario = ?";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);
mysqli_stmt_execute($stmt);
$resultado = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($resultado) > 0) {
    die("El usuario ya es administrador.");
}

$sql = "INSERT INTO ADMINISTRADOR (id_usuario)
        VALUES (?)";

$stmt = mysqli_prepare($conexion, $sql);
mysqli_stmt_bind_param($stmt, "i", $id_usuario);

if (mysqli_stmt_execute($stmt)) {
    header("Location: listar_usuarios.php");
    exit();
} else {
    echo "Error al asignar administrador: " . mysqli_error($conexion);
}
?>