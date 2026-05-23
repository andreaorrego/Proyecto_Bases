<?php
include("conexion.php");

$sql = "SELECT * FROM USUARIO";
$resultado = mysqli_query($conexion, $sql);
?>

<h2>Usuarios</h2>

<table border="1">

<tr>
    <th>ID</th>
    <th>Correo</th>
    <th>Acciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <td><?= $fila['id_usuario'] ?></td>
    <td><?= $fila['correo'] ?></td>

    <td>
        <a href="hacer_admin.php?id=<?= $fila['id_usuario'] ?>">
            Hacer admin
        </a>
    </td>
</tr>
<?php } ?>

</table>