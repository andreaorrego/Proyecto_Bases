<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "
SELECT s.*, 
       c.cedula,
       e.serial,
       e.marca
FROM SOLICITUD_CLIENTE s
INNER JOIN CLIENTE c ON s.id_cliente = c.id_usuario
INNER JOIN EQUIPO e ON s.id_equipo = e.id_equipo
";

$resultado = mysqli_query($conexion, $sql);
?>

<h2>Solicitudes</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Cliente</th>
    <th>Equipo</th>
    <th>Observación</th>
    <th>Cantidad</th>
    <th>Estado</th>
    <th>Opciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <td><?= $fila['id_solicitud'] ?></td>
    <td><?= $fila['cedula'] ?></td>
    <td><?= $fila['serial'] ?> - <?= $fila['marca'] ?></td>
    <td><?= $fila['observacion'] ?></td>
    <td><?= $fila['cantidad'] ?></td>
    <td><?= $fila['estado'] ?></td>

    <td>
        <a href="asignar_solicitud.php?id=<?= $fila['id_solicitud'] ?>">
            Asignar
        </a>
        <a href="gestionar_solicitud.php?id=<?= $fila['id_solicitud'] ?>">
            Gestionar
        </a>
        <a href="devolver_equipo.php?id=<?= $fila['id_solicitud'] ?>">
            Registrar devolución
        </a>
    </td>
</tr>
<?php } ?>

</table>