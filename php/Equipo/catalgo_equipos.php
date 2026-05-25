<?php
session_start();
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_cliente.php';

$sql = "SELECT e.*, p.nombre AS proveedor
        FROM EQUIPO e
        INNER JOIN PROVEEDOR p ON e.id_proveedor = p.id_proveedor
        WHERE e.estado = 'Activo'";

$resultado = mysqli_query($conexion, $sql);

$filas = "";

while($fila = mysqli_fetch_assoc($resultado)) {
    
    if ($fila['estado'] == 'Activo') {
$accion = "<a href='nueva_solicitud.php?id_equipo={$fila['id_equipo']}' class='btn-solicitar'>Solicitar</a>";    
} else {
        $accion = "<span style='color: #999;'>No disponible</span>";
    }

    $filas .= "<tr>
                <td>{$fila['tipo_equipo']}</td>
                <td>{$fila['marca']} {$fila['modelo']}</td>
                <td>{$fila['serie']}</td>
                <td>{$fila['proveedor']}</td>
                <td>{$accion}</td>
               </tr>";
}

if (empty($filas)) {
    $filas = "<tr><td colspan='5'>No hay equipos disponibles en este momento.</td></tr>";
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Equipo/catalogo_equipo.html');
$plantilla = str_replace('{{FILAS_EQUIPOS}}', $filas, $plantilla);

echo $plantilla;
?>