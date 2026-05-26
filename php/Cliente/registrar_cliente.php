<?php
require_once __DIR__ . '/../conexion.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html");
    exit();
}

$nombre = trim($_POST['nombre'] ?? '');
$apellido = trim($_POST['apellido'] ?? '');
$correo = trim($_POST['correo'] ?? '');
$contrasena = $_POST['contrasena'] ?? '';

$cedula = trim($_POST['cedula'] ?? '');
$cargo = trim($_POST['cargo'] ?? '');
$dependencia = trim($_POST['dependencia'] ?? '');

if (
    empty($nombre) || empty($apellido) || empty($correo) ||
    empty($contrasena) || empty($cedula)
) {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html?error=campos");
    exit();
}

$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

$correo_safe = mysqli_real_escape_string($conexion, $correo);

$verificar = "SELECT id_usuario FROM USUARIO WHERE correo = '$correo_safe'";
$resultado = mysqli_query($conexion, $verificar);

if (mysqli_num_rows($resultado) > 0) {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html?error=correo_existe");
    exit();
}

$sql_usuario = "
INSERT INTO USUARIO (nombre, apellido, correo, contrasena, estado)
VALUES (
    '$nombre',
    '$apellido',
    '$correo_safe',
    '$contrasena_hash',
    'Activo'
)";

if (mysqli_query($conexion, $sql_usuario)) {
    $id_nuevo = mysqli_insert_id($conexion);

    $sql_cliente = "
    INSERT INTO CLIENTE (id_usuario, cedula, cargo, dependencia)
    VALUES (
        $id_nuevo,
        '$cedula',
        '$cargo',
        '$dependencia'
    )";

    if (mysqli_query($conexion, $sql_cliente)) {

        header("Location: /Proyecto_Bases/html/Usuario/login.html?registro=ok");
        exit();
    } else {
        header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html?error=db_cliente");
        exit();
    }
} else {
    header("Location: /Proyecto_Bases/html/Cliente/registrar_cliente.html?error=db_usuario");
    exit();
}
?>