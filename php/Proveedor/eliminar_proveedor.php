<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "DELETE FROM PROVEEDOR WHERE id_proveedor=$id";

if(mysqli_query($conexion, $sql)){
    header("Location: listar_proveedores.php");
    exit();
} else {
    echo mysqli_error($conexion);
}
?>