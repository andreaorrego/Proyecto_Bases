<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "
SELECT s.*, 
       c.cedula,
       e.serie,
       e.marca
FROM SOLICITUD_CLIENTE s
INNER JOIN CLIENTE c ON s.id_cliente = c.id_usuario
INNER JOIN EQUIPO e ON s.id_equipo = e.id_equipo
";

$resultado = mysqli_query($conexion, $sql);

$solicitudes = [];

while($fila = mysqli_fetch_assoc($resultado)) {
    $filas .= "<tr>
                <td>{$fila['id_solicitud']}</td>
                <td>{$fila['nombre_cliente']}</td>
                <td>{$fila['equipo']}</td>
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

include("/Proyecto_Bases/html/Solicitudes/listar_solicitudes.html");
?>