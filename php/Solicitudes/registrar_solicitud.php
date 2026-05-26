<?php
session_start();

require_once __DIR__ . "/../conexion.php";
require_once __DIR__ . "/../Sistema/proteger_cliente.php";

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../html/login.html");
    exit();
}

$id_cliente = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: ../../html/Usuario/perfil_cliente.html");
    exit();
}

$id_equipo = trim($_POST['id_equipo'] ?? '');
$observacion = trim($_POST['observacion'] ?? '');
$cantidad = trim($_POST['cantidad'] ?? '');
$fecha_retorno = trim($_POST['fecha_retorno'] ?? '');

if (empty($id_equipo) || empty($cantidad) || empty($fecha_retorno)) {
    echo "<script>
            alert('Debe completar todos los campos obligatorios');
            window.history.back();
          </script>";
    exit();
}

$id_equipo = (int) $id_equipo;
$cantidad = (int) $cantidad;
$observacion = mysqli_real_escape_string($conexion, $observacion);
$fecha_retorno = mysqli_real_escape_string($conexion, $fecha_retorno);

$sql = "
INSERT INTO SOLICITUD_CLIENTE (
    id_cliente,
    id_equipo,
    observacion,
    cantidad,
    fecha_retorno
) VALUES (
    $id_cliente,
    $id_equipo,
    '$observacion',
    $cantidad,
    '$fecha_retorno'
)
";

if (mysqli_query($conexion, $sql)) {
    echo "<script>
            alert('Solicitud registrada correctamente');
            window.location.href='../../html/Usuario/perfil_cliente.html';
          </script>";
} else {
    echo "<script>
            alert('Error al registrar la solicitud');
            window.history.back();
          </script>";
}

mysqli_close($conexion);
?>