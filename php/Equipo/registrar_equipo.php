<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: /Proyecto_Bases/html/Equipo/registrar_equipo.html");
    exit();
}

$campos = ['serie', 'marca', 'modelo', 'tipo_equipo', 'id_proveedor'];

foreach ($campos as $campo) {
    if (empty($_POST[$campo])) {
        die("Todos los campos son obligatorios.");
    }
}

$serie = mysqli_real_escape_string($conexion, $_POST['serie']);
$marca = mysqli_real_escape_string($conexion, $_POST['marca']);
$modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
$tipo_equipo = mysqli_real_escape_string($conexion, $_POST['tipo_equipo']);
$id_proveedor = (int) $_POST['id_proveedor'];

$sql_proveedor = "SELECT id_proveedor 
                  FROM PROVEEDOR 
                  WHERE id_proveedor = $id_proveedor";

$resultado_proveedor = mysqli_query($conexion, $sql_proveedor);

if (mysqli_num_rows($resultado_proveedor) === 0) {
    die("El proveedor seleccionado no existe.");
}

$sql_equipo = "
INSERT INTO EQUIPO (
    serie,
    marca,
    modelo,
    tipo_equipo,
    id_proveedor
) VALUES (
    '$serie',
    '$marca',
    '$modelo',
    '$tipo_equipo',
    $id_proveedor
)";

if (mysqli_query($conexion, $sql_equipo)) {

    $nuevo_id = mysqli_insert_id($conexion);

    $sql_historial = "
    INSERT INTO HISTORIAL_EQUIPO (
        id_equipo,
        evento,
        descripcion
    ) VALUES (
        $nuevo_id,
        'Registro',
        'Equipo creado en el sistema'
    )";

    mysqli_query($conexion, $sql_historial);

    header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
    exit();

} else {
    echo "Error al registrar el equipo: " . mysqli_error($conexion);
}
?>