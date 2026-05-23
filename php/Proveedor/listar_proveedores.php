<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "SELECT * FROM PROVEEDOR";
$resultado = mysqli_query($conexion, $sql);
?>

<h2>Lista de Proveedores</h2>

<a href="proveedor.html">
    Registrar proveedor
</a>

<table border="1">

<tr>
    <th>ID</th>
    <th>Nombre</th>
    <th>NIT</th>
    <th>Correo</th>
    <th>Teléfono</th>
    <th>Opciones</th>
</tr>

<?php while($fila = mysqli_fetch_assoc($resultado)) { ?>
<tr>
    <td><?= $fila['id_proveedor'] ?></td>
    <td><?= $fila['nombre'] ?></td>
    <td><?= $fila['NIT'] ?></td>
    <td><?= $fila['correo'] ?></td>
    <td><?= $fila['telefono'] ?></td>

    <td>
        <a href="editar_proveedor.php?id=<?= $fila['id_proveedor'] ?>">
            Editar
        </a>
        <a href="eliminar_proveedor.php?id=<?= $fila['id_proveedor'] ?>"
           onclick="return confirm('¿Seguro que deseas eliminar este proveedor?')">
           Eliminar
        </a>
    </td>
</tr>
<?php } ?>

</table>