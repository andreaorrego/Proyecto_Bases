<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "
SELECT * FROM HISTORIAL_EQUIPO
WHERE id_equipo=$id
ORDER BY fecha DESC
";

$resultado = mysqli_query($conexion, $sql);
?>

<h2>Historial del equipo</h2>

<table border="1">

<tr>
    <th>Evento</th>
    <th>Descripción</th>
    <th>Fecha</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <td><?= $fila['evento'] ?></td>
    <td><?= $fila['descripcion'] ?></td>
    <td><?= $fila['fecha'] ?></td>
</tr>
<?php } ?>

</table>