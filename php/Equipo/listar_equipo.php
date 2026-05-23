<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "
SELECT e.*, p.nombre AS proveedor
FROM EQUIPO e
INNER JOIN PROVEEDOR p ON e.id_proveedor = p.id_proveedor
WHERE 1=1
";

if (!empty($_GET['tipo'])) {
    $tipo = $_GET['tipo'];
    $sql .= " AND e.tipo_equipo LIKE '%$tipo%'";
}

if (!empty($_GET['estado'])) {
    $estado = $_GET['estado'];
    $sql .= " AND e.estado = '$estado'";
}

if (!empty($_GET['proveedor'])) {
    $proveedor = $_GET['proveedor'];
    $sql .= " AND p.nombre LIKE '%$proveedor%'";
}

$resultado = mysqli_query($conexion, $sql);

echo "<table border='1'>
<tr>
    <th>ID</th>
    <th>Serie</th>
    <th>Marca</th>
    <th>Modelo</th>
    <th>Tipo</th>
    <th>Estado</th>
    <th>Proveedor</th>
    <th>Opciones</th>
</tr>";

while($fila = mysqli_fetch_assoc($resultado)) {
    echo "<tr>
        <td>{$fila['id_equipo']}</td>
        <td>{$fila['serial']}</td>
        <td>{$fila['marca']}</td>
        <td>{$fila['modelo']}</td>
        <td>{$fila['tipo_equipo']}</td>
        <td>{$fila['estado']}</td>
        <td>{$fila['proveedor']}</td>
        <td>
            <a href='editar_equipo.php?id={$fila['id_equipo']}'>Editar</a>
            <a href='dar_baja_equipo.php?id={$fila['id_equipo']}'>Dar de baja</a>
        </td>
    </tr>";
}

echo "</table>";
?>