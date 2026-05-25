<?php
include("proteger_admin.php");
include("conexion.php");

$id_cliente = $_GET['id'];

$sql = "SELECT * FROM SOLICITUD_CLIENTE WHERE id_cliente=$id";
$res = mysqli_query($conexion, $sql);

if (mysqli_num_rows($res) > 0) {

    echo "No se puede eliminar: el cliente tiene solicitudes registradas";

} else {

    $sqlDelete = "DELETE FROM CLIENTE WHERE id_usuario=$id";
    mysqli_query($conexion, $sqlDelete);

    echo "Cliente eliminado correctamente";
}
?>