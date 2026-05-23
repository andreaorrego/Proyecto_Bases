<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$equipo = mysqli_fetch_assoc(mysqli_query($conexion,
    "SELECT * FROM EQUIPO WHERE id_equipo=$id"
));

$proveedores = mysqli_query($conexion, "SELECT * FROM PROVEEDOR");
?>

<form action="actualizar_equipo.php" method="POST">

    <input type="hidden" name="id_equipo" value="<?= $equipo['id_equipo'] ?>">

    <input type="text" name="serie" value="<?= $equipo['serie'] ?>">
    <input type="text" name="marca" value="<?= $equipo['marca'] ?>">
    <input type="text" name="modelo" value="<?= $equipo['modelo'] ?>">
    <input type="text" name="tipo" value="<?= $equipo['tipo'] ?>">

    <select name="estado">
        <option <?= $equipo['estado']=="Nuevo"?"selected":"" ?>>Nuevo</option>
        <option <?= $equipo['estado']=="Usado"?"selected":"" ?>>Usado</option>
        <option <?= $equipo['estado']=="Mantenimiento"?"selected":"" ?>>Mantenimiento</option>
    </select>

    <select name="id_proveedor">

        <?php while($p = mysqli_fetch_assoc($proveedores)) { ?>
            <option value="<?= $p['id_proveedor'] ?>"
                <?= $p['id_proveedor']==$equipo['id_proveedor']?"selected":"" ?>>
                <?= $p['nombre'] ?>
            </option>
        <?php } ?>

    </select>

    <button type="submit">
        Actualizar
    </button>
</form>