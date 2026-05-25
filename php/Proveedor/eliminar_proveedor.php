<?php
include("proteger_admin.php");
include("conexion.php");

$id_proveedor = $_GET['id'];

$sql = "SELECT * FROM EQUIPO WHERE id_proveedor=$id_proveedor";
$res = mysqli_query($conexion, $sql);

if (mysqli_num_rows($res) > 0) {
    echo "No se puede eliminar: hay equipos asociados";
} else {
    mysqli_query($conexion, "DELETE FROM PROVEEDOR WHERE id_proveedor=$id_proveedor");
    echo "Proveedor eliminado correctamente";
}
?>