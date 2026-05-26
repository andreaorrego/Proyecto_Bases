<?php
session_start();
require_once __DIR__ . "/../conexion.php";

// 1. Verificamos que sea un envío por POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die("Acceso no permitido.");
}

// 2. Recibimos los datos del formulario
$id = isset($_POST['id_usuario']) ? (int) $_POST['id_usuario'] : 0;
$cargo = trim($_POST['cargo'] ?? '');
$dependencia = trim($_POST['dependencia'] ?? '');

// 3. Validación de datos
if ($id <= 0 || empty($cargo) || empty($dependencia)) {
    die("Error: Datos incompletos. Asegúrate de llenar todos los campos.");
}

// 4. Ejecutamos el UPDATE
$sql = "UPDATE CLIENTE SET cargo = ?, dependencia = ? WHERE id_usuario = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en la preparación de la consulta: " . $conexion->error);
}

$stmt->bind_param("ssi", $cargo, $dependencia, $id);

if ($stmt->execute()) {
    echo "¡Consulta ejecutada correctamente!<br>";
    echo "Filas afectadas: " . $stmt->affected_rows . "<br>";
    echo "ID recibido: " . $id . "<br>";
    echo "Cargo recibido: " . $cargo . "<br>";
    echo "Dependencia recibida: " . $dependencia . "<br>";
    
    // Si ves "Filas afectadas: 0", el problema es el WHERE
    if ($stmt->affected_rows === 0) {
        echo "<br><strong>ALERTA:</strong> La consulta no encontró ningún cliente con id_usuario = $id.";
    }
} else {
    echo "Error en la ejecución: " . $stmt->error;
}
$stmt->close();
exit();

if ($stmt->execute()) {
    // 5. Éxito: Redirigimos a la lista de usuarios
    header("Location: /Proyecto_Bases/php/Usuario/listar_usuario.php");
    exit();
} else {
    echo "Error al actualizar en la base de datos: " . $stmt->error;
}

$stmt->close();
?>