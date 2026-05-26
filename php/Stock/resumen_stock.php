<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$sql = "SELECT estado, COUNT(*) as total 
        FROM EQUIPO 
        GROUP BY estado";

$resultado = mysqli_query($conexion, $sql);

$disponibles = 0;
$transferidos = 0;
$baja = 0;

while ($fila = mysqli_fetch_assoc($resultado)) {
    switch ($fila['estado']) {

        case 'Activo':
            $disponibles = $fila['total'];
            break;

        case 'Transferido':
            $transferidos = $fila['total'];
            break;

        case 'Inactivo':
            $baja = $fila['total'];
            break;
    }
}

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Stock/resumen_stock.html'
);

$plantilla = str_replace(
    ['{{DISPONIBLES}}', '{{TRANSFERIDOS}}', '{{BAJA}}'],
    [$disponibles, $transferidos, $baja],
    $plantilla
);

echo $plantilla;
?>