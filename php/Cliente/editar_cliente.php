<?php
include("proteger_admin.php");
include("conexion.php");

session_start();

if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}

include "conexion.php";

$id = intval($_GET['id']);

$sql = "SELECT * FROM CLIENTE WHERE id_usuario=$id";
$resultado = $conexion->query($sql);
$cliente = $resultado->fetch_assoc();

if (!$cliente) {
    die("Cliente no encontrado");
}
?>

<form action="actualizar_cliente.php" method="POST">

    <input type="hidden" name="id_usuario" value="<?= $cliente['id_usuario'] ?>">

    <input type="number" name="cedula" value="<?= $cliente['cedula'] ?>" required>
    <input type="text" name="cargo" value="<?= $cliente['cargo'] ?>" required>
    <input type="text" name="dependencia" value="<?= $cliente['dependencia'] ?>" required>

    <button type="submit">Actualizar</button>

</form>