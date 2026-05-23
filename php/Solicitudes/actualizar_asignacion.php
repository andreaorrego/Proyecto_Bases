<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_POST['id_solicitud'];
$id_equipo = $_POST['id_equipo'];
$responsable = $_POST['responsable'];
$dependencia = $_POST['dependencia'];
$fecha_retorno = $_POST['fecha_retorno'];

$sql = "
UPDATE SOLICITUD_CLIENTE SET
id_equipo='$id_equipo',
responsable='$responsable',
dependencia='$dependencia',
fecha_retorno='$fecha_retorno',
estado='Aprobada'
WHERE id_solicitud=$id
";

mysqli_query($conexion,"
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id_equipo, 'Transferencia', 'Equipo asignado a solicitud')
");

if ($stock_disponible > 0) {
    echo "Equipo asignado correctamente";
} else {
    mysqli_query($conexion,"
    INSERT INTO SOLICITUD_COMPRA (id_equipo, cantidad, motivo)
    VALUES ($id_equipo, 1, 'Falta de stock')
    ");
    echo "No hay stock. Se generó solicitud al área de compras.";
}

//mysqli_query($conexion, $sql);

header("Location: listar_solicitudes.php");
exit();
?>