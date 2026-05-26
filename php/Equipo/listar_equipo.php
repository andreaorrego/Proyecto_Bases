<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$sql = "SELECT e.*, p.nombre AS proveedor
        FROM EQUIPO e
        INNER JOIN PROVEEDOR p
        ON e.id_proveedor = p.id_proveedor
        WHERE 1=1";

if (!empty($_GET['tipo'])) {
    $tipo = mysqli_real_escape_string(
        $conexion,
        $_GET['tipo']
    );
    $sql .= " AND e.tipo_equipo LIKE '%$tipo%'";
}

if (!empty($_GET['estado'])) {
    $estado = mysqli_real_escape_string(
        $conexion,
        $_GET['estado']
    );
    $sql .= " AND e.estado = '$estado'";
}

$resultado = mysqli_query($conexion, $sql);
$filas_html = "";

if (mysqli_num_rows($resultado) > 0) {
    while ($fila = mysqli_fetch_assoc($resultado)) {
        $filas_html .= "
        <tr>
            <td>{$fila['id_equipo']}</td>
            <td>{$fila['serie']}</td>
            <td>{$fila['marca']}</td>
            <td>{$fila['modelo']}</td>
            <td>{$fila['tipo_equipo']}</td>
            <td>{$fila['estado']}</td>
            <td>{$fila['proveedor']}</td>
            <td>
                <a href='editar_equipo.php?id={$fila['id_equipo']}' class='btn-opcion'>Editar</a>
                <a href='dar_baja_equipo.php?id={$fila['id_equipo']}' class='btn-opcion'>Dar de baja</a>
                <a href='devolver_equipo.php?id={$fila['id_equipo']}' class='btn-opcion'>Devolver</a>
            </td>
        </tr>";
    }
} else {
    $filas_html = "
    <tr>
        <td colspan='8'>No hay equipos registrados.</td>
    </tr>";
}

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] .
    '/Proyecto_Bases/html/Equipo/listar_equipos.html'
);

echo str_replace(
    '{{FILAS_EQUIPOS}}',
    $filas_html,
    $plantilla
);
?>