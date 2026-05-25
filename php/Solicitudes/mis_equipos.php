<?php
session_start();
include("conexion.php");

$id_cliente = $_SESSION['id_usuario'];

$sql = "
SELECT s.*, e.serial, e.marca, e.tipo_equipo
FROM SOLICITUD_CLIENTE s
INNER JOIN EQUIPO e ON s.id_equipo = e.id_equipo
WHERE s.id_cliente = $id_cliente
AND s.estado IN ('Aprobada','Entregada')
";

$resultado = mysqli_query($conexion, $sql);
?>

<h2>Mis equipos asignados</h2>

<table border="1">

<tr>
    <th>Equipo</th>
    <th>Tipo</th>
    <th>Observación</th>
    <th>Cantidad</th>
    <th>Estado</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <td><?= $fila['serial'] ?> - <?= $fila['marca'] ?></td>
    <td><?= $fila['tipo_equipo'] ?></td>
    <td><?= $fila['observacion'] ?></td>
    <td><?= $fila['cantidad'] ?></td>
    <td><?= $fila['estado'] ?></td>
</tr>
<?php } ?>

</table>