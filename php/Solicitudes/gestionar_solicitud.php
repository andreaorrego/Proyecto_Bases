<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$solicitud = mysqli_fetch_assoc(mysqli_query($conexion,
    "SELECT * FROM SOLICITUD_CLIENTE WHERE id_solicitud=$id"
));
?>

<h2>Gestionar solicitud</h2>

<form action="actualizar_estado.php" method="POST">

    <input type="hidden" name="id_solicitud" value="<?= $solicitud['id_solicitud'] ?>">

    <select name="estado">
        <option <?= $solicitud['estado']=="Pendiente"?"selected":"" ?>>Pendiente</option>
        <option <?= $solicitud['estado']=="Aprobada"?"selected":"" ?>>Aprobada</option>
        <option <?= $solicitud['estado']=="Rechazada"?"selected":"" ?>>Rechazada</option>
        <option <?= $solicitud['estado']=="Entregada"?"selected":"" ?>>Entregada</option>
        <option <?= $solicitud['estado']=="Devuelta"?"selected":"" ?>>Devuelta</option>
    </select>

    <button type="submit">
        Actualizar estado
    </button>

</form>