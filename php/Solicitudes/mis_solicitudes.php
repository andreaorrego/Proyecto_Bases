<?php
session_start();
include("proteger_cliente.php");
include("conexion.php");

$id_cliente = $_SESSION['id_usuario'];

$sql = "SELECT s.*, e.serial, e.marca
        FROM SOLICITUD_CLIENTE s
        INNER JOIN EQUIPO e ON s.id_equipo = e.id_equipo
        WHERE s.id_cliente = $id_cliente";

$resultado = mysqli_query($conexion, $sql);

$filas = "";
while($fila = mysqli_fetch_assoc($resultado)) {
    $filas .= "<tr>
                <td>{$fila['serial']} - {$fila['marca']}</td>
                <td>{$fila['observacion']}</td>
                <td>{$fila['cantidad']}</td>
                <td>{$fila['estado']}</td>
                <td>{$fila['fecha_solicitud']}</td>
               </tr>";
}

if (empty($filas)) {
    $filas = "<tr><td colspan='5'>No tienes solicitudes registradas.</td></tr>";
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Solicitudes/mis_solicitudes.html');
$plantilla = str_replace('{{FILAS_SOLICITUDES}}', $filas, $plantilla);

echo $plantilla;
?>