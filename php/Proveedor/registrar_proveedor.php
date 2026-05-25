<?php
include(__DIR__ . "/../Sistema/proteger_admin.php");
include(__DIR__ . "/../conexion.php");

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: /Proyecto_Bases/html/Proveedores/registrar_proveedor.html");
    exit();
}

$stmt = $conexion->prepare(
    "INSERT INTO PROVEEDOR (nombre, NIT, correo, telefono)
     VALUES (?, ?, ?, ?)"
);

$stmt->bind_param(
    "ssss",
    $_POST['nombre'],
    $_POST['nit'],
    $_POST['correo'],
    $_POST['telefono']
);

if ($stmt->execute()) {
    header("Location: /Proyecto_Bases/php/Sistema/menu_admin.php");
    exit();
} else {
    echo "Error al registrar: " . $stmt->error;
}

$stmt->close();
?>