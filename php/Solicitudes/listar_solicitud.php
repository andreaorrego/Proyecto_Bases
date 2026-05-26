<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$sql = "
SELECT 
    s.id_solicitud,
    s.observacion,
    s.cantidad,
    s.estado,
    c.cedula,
    e.serie,
    e.marca
FROM SOLICITUD_CLIENTE s
INNER JOIN CLIENTE c ON s.id_cliente = c.id_usuario
INNER JOIN EQUIPO e ON s.id_equipo = e.id_equipo
";

$resultado = mysqli_query($conexion, $sql);

$filas = ""; 

while ($fila = mysqli_fetch_assoc($resultado)) {
    $filas .= "<tr>
        <td>{$fila['id_solicitud']}</td>
        <td>{$fila['cedula']}</td>
        <td>{$fila['serie']} - {$fila['marca']}</td>
        <td>{$fila['observacion']}</td>
        <td>{$fila['cantidad']}</td>
        <td>{$fila['estado']}</td>
        <td>
            <select onchange='gestionarSolicitud(this.value, {$fila['id_solicitud']})'>
                <option value=''>Seleccione</option>
                <option value='ver'>Ver</option>
                <option value='editar'>Editar</option>
                <option value='eliminar'>Eliminar</option>
            </select>
        </td>
    </tr>";
}

include(__DIR__ . "/../../html/Solicitudes/listar_solicitud.html");
?>