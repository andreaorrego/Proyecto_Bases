<?php
include("proteger_admin.php");
include("conexion.php");

$id = mysqli_real_escape_string($conexion, $_GET['id']);

$sql = "SELECT evento, descripcion, fecha 
        FROM HISTORIAL_EQUIPO 
        WHERE id_equipo = '$id' 
        ORDER BY fecha DESC";

$resultado = mysqli_query($conexion, $sql);
$filas_html = "";

if (mysqli_num_rows($resultado) > 0) {
    while($fila = mysqli_fetch_assoc($resultado)) {
        $filas_html .= "<tr>
            <td>{$fila['evento']}</td>
            <td>{$fila['descripcion']}</td>
            <td>{$fila['fecha']}</td>
        </tr>";
    }
} else {
    $filas_html = "<tr><td colspan='3'>No hay historial registrado para este equipo.</td></tr>";
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Historial/historial.html');
echo str_replace('{{FILAS_HISTORIAL}}', $filas_html, $plantilla);
?>