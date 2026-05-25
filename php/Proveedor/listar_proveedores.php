<?php

include(__DIR__ . "/../Sistema/proteger_admin.php");
include(__DIR__ . "/../conexion.php");

$sql = "SELECT * FROM PROVEEDOR";
$resultado = mysqli_query($conexion, $sql);

$filas_html = "";

if (mysqli_num_rows($resultado) > 0) {

    while ($fila = mysqli_fetch_assoc($resultado)) {

        $filas_html .= "
        <tr>
            <td>{$fila['id_proveedor']}</td>
            <td>{$fila['nombre']}</td>
            <td>{$fila['NIT']}</td>
            <td>{$fila['correo']}</td>
            <td>{$fila['telefono']}</td>
            <td>
                <a href='editar_proveedor.php?id={$fila['id_proveedor']}'>Editar</a>

                <a href='eliminar_proveedor.php?id={$fila['id_proveedor']}'
                   onclick=\"return confirm('¿Seguro que deseas eliminar este proveedor?\")'>
                   Eliminar
                </a>
            </td>
        </tr>";
    }

} else {

    $filas_html = "
    <tr>
        <td colspan='6'>No hay proveedores registrados.</td>
    </tr>";
}

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] .
    '/Proyecto_Bases/html/Proveedores/listar_proveedores.html'
);

echo str_replace(
    '{{FILAS_PROVEEDORES}}',
    $filas_html,
    $plantilla
);
?>