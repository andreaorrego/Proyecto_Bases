<?php
include("proteger_admin.php");
include("conexion.php");

$nombre = $_POST['nombre'];
$nit = $_POST['nit'];
$correo = $_POST['correo'];
$telefono = $_POST['telefono'];

$sql = "
INSERT INTO PROVEEDOR (nombre, NIT, correo, telefono)
VALUES ('$nombre', '$nit', '$correo', '$telefono')
";

if(mysqli_query($conexion,$sql)){
    echo "Proveedor registrado correctamente";
    
    header("Location: listar_proveedores.php");
    exit();
    
    }else{
        echo mysqli_error($conexion);
        }
?>