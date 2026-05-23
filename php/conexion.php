<?php

$conexion = mysqli_connect(
    "localhost",
    "root",
    "",
    "inventario_universidad"
);

if($conexion->connect_error){
    die("Error de conexión". $conexion->connect_error);
}
?>