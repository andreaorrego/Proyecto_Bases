<?php

include(__DIR__ . "/../Sistema/proteger_admin.php");
include(__DIR__ . "/../conexion.php");

$sql = "SELECT u.nombre,
               u.apellido,
               u.correo,
               c.cargo,
               c.dependencia
        FROM USUARIO u
        LEFT JOIN CLIENTE c
        ON u.id_usuario = c.id_usuario";

$resultado = mysqli_query($conexion, $sql);

$filas_html = "";

if (mysqli_num_rows($resultado) > 0) {

    while ($fila = mysqli_fetch_assoc($resultado)) {

        $nombre_completo = $fila['nombre'] . ' ' . $fila['apellido'];

        $cargo = $fila['cargo'] ?? 'N/A';
        $dependencia = $fila['dependencia'] ?? 'N/A';

        $filas_html .= "
        <tr>
            <td>{$nombre_completo}</td>
            <td>{$fila['correo']}</td>
            <td>{$cargo}</td>
            <td>{$dependencia}</td>
        </tr>";
    }

} else {

    $filas_html = "
    <tr>
        <td colspan='4'>No hay usuarios registrados.</td>
    </tr>";
}

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] .
    '/Proyecto_Bases/html/Usuario/listar_usuarios.html'
);

$resultado_final = str_replace(
    '{{FILAS_USUARIOS}}',
    $filas_html,
    $plantilla
);

echo $resultado_final;
?>