<?php
include("proteger_admin.php");
include("conexion.php");

$sql = "
SELECT 
    c.id_usuario,
    u.nombre,
    u.apellido,
    c.cedula,
    c.cargo,
    c.dependencia
FROM CLIENTE c
INNER JOIN USUARIO u ON c.id_usuario = u.id_usuario
";

$resultado = $conexion->query($sql);
?>

<h2>Lista de Clientes</h2>

<a href="clientes.html">
    Agregar cliente
</a>

<table border="1">

<tr>
    <th>ID Usuario</th>
    <th>Nombre</th>
    <th>Apellido</th>
    <th>Cédula</th>
    <th>Cargo</th>
    <th>Dependencia</th>
    <th>Opciones</th>
</tr>

<?php while($fila = $resultado->fetch_assoc()) { ?>
<tr>
    <td><?= $fila['id_usuario'] ?></td>
    <td><?= $fila['nombre'] ?></td>
    <td><?= $fila['apellido'] ?></td>
    <td><?= $fila['cedula'] ?></td>
    <td><?= $fila['cargo'] ?></td>
    <td><?= $fila['dependencia'] ?></td>

    <td>
        <a href="editar_cliente.php?id=<?= $fila['id_usuario'] ?>">
            Editar
        </a>

        <a href="eliminar_cliente.php?id=<?= $fila['id_usuario'] ?>"
           onclick="return confirm('¿Seguro que quieres eliminar este cliente?')">
           Eliminar
        </a>
    </td>
</tr>
<?php } ?>

</table>