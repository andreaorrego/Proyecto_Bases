<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "SELECT estado, COUNT(*) as total FROM EQUIPO GROUP BY estado";
$resultado = mysqli_query($conexion, $sql);

$disponibles = 0;
$transferidos = 0;
$baja = 0;

while($fila = mysqli_fetch_assoc($resultado)) {
    if ($fila['estado'] == 'Activo') $disponibles = $fila['total'];
    if ($fila['estado'] == 'Transferido') $transferidos = $fila['total'];
    if ($fila['estado'] == 'Inactivo') $baja = $fila['total'];
}

$plantilla = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/Proyecto_Bases/html/Stock/resumen_stock.html');
$plantilla = str_replace(['{{DISPONIBLES}}', '{{TRANSFERIDOS}}', '{{BAJA}}'], 
                         [$disponibles, $transferidos, $baja], $plantilla);
echo $plantilla;
?>