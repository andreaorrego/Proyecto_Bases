<?php
session_start();

include("proteger_cliente.php");
include("conexion.php");

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../../html/login.html");
    exit();
}

$id_cliente = $_SESSION['id_usuario'];

$id_equipo = trim($_POST['id_equipo']);
$observacion = trim($_POST['observacion']);
$cantidad = trim($_POST['cantidad']);
$fecha_retorno = trim($_POST['fecha_retorno']);

if (
    empty($id_equipo) ||
    empty($cantidad) ||
    empty($fecha_retorno)
) {

    echo "<script>
            alert('Debe completar todos los campos obligatorios');
            window.history.back();
          </script>";
    exit();
}

$sql = "
INSERT INTO SOLICITUD_CLIENTE
(
    id_cliente,
    id_equipo,
    observacion,
    cantidad,
    fecha_retorno
)
VALUES
(
    '$id_cliente',
    '$id_equipo',
    '$observacion',
    '$cantidad',
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