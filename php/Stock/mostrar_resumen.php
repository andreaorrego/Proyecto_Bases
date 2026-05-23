include("proteger_admin.php");
include("conexion.php");

<h2>Resumen de Stock</h2>

<table border="1">

<tr>
    <th>Disponibles</th>
    <th>Transferidos</th>
    <th>Dados de baja</th>
</tr>

<tr>
    <td><?= $disponibles ?></td>
    <td><?= $transferidos ?></td>
    <td><?= $baja ?></td>
</tr>

</table>