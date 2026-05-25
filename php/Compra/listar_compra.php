<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "SELECT sc.*, e.serial, e.marca
        FROM SOLICITUD_COMPRA sc
        INNER JOIN EQUIPO e ON sc.id_equipo = e.id_equipo";

$resultado = mysqli_query($conexion, $sql);
$filas_html = "";

while($fila = mysqli_fetch_assoc($resultado)) {
    $filas_html .= "<tr>
        <td>{$fila['id_compra']}</td>
        <td>{$fila['serie']} - {$fila['marca']}</td>
        <td>{$fila['cantidad']}</td>
        <td>{$fila['motivo']}</td>
        <td>{$fila['estado']}</td>
        <td>
            <a href='cambiar_compra.php?id={$fila['id_compra']}'>Marcar como recibida</a>
        </td>
    </tr>";
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Compra/listar_compra.html');
echo str_replace('{{FILAS_SOLICITUDES}}', $filas_html, $plantilla);
?>