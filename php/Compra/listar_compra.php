<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "
SELECT sc.*, e.serial, e.marca
FROM SOLICITUD_COMPRA sc
INNER JOIN EQUIPO e ON sc.id_equipo = e.id_equipo
";

$resultado = mysqli_query($conexion, $sql);
?>

<h2>Solicitudes de compra</h2>

    <table border="1">

    <tr>
        <th>ID</th>
        <th>Equipo</th>
        <th>Cantidad</th>
        <th>Motivo</th>
        <th>Estado</th>
    </tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
    <tr>
        <td><?= $fila['id_compra'] ?></td>
        <td><?= $fila['serial'] ?> - <?= $fila['marca'] ?></td>
        <td><?= $fila['cantidad'] ?></td>
        <td><?= $fila['motivo'] ?></td>
        <td><?= $fila['estado'] ?></td>
    </tr>
<?php } ?>

<a href="cambiar_compra.php?id=<?= $fila['id_compra'] ?>">
    Marcar como recibida
</a>

</table>