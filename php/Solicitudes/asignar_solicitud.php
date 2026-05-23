<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "
SELECT * FROM SOLICITUD_CLIENTE WHERE id_solicitud=$id
";

$solicitud = mysqli_fetch_assoc(mysqli_query($conexion, $sql));

$equipos = mysqli_query($conexion, "SELECT * FROM EQUIPO");
?>

<h2>Asignar equipo</h2>

<form action="actualizar_asignacion.php" method="POST">

    <input type="hidden" 
           name="id_solicitud" 
           value="<?= $solicitud['id_solicitud'] ?>">

    <label>Equipo</label>
    <select name="id_equipo">

        <?php while($e = mysqli_fetch_assoc($equipos)) { ?>
            <option value="<?= $e['id_equipo'] ?>"
                <?= $e['id_equipo']==$solicitud['id_equipo']?"selected":"" ?>>
                <?= $e['serial'] ?> - <?= $e['marca'] ?>
            </option>
        <?php } ?>

    </select>

    <input type="text" 
           name="responsable" 
           value="<?= $solicitud['responsable'] ?>" 
           placeholder="Responsable">

    <input type="text" 
           name="dependencia" 
           value="<?= $solicitud['dependencia'] ?>" 
           placeholder="Dependencia">

    <label>Fecha retorno</label>
    <input type="date" 
           name="fecha_retorno" 
           value="<?= $solicitud['fecha_retorno'] ?>">

    <button type="submit">
        Asignar
    </button>

</form>