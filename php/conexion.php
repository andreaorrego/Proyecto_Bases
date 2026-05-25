<?php
$conexion = mysqli_connect("127.0.0.1", "root", "", "inventario_universidad", 3307);

if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");

?>