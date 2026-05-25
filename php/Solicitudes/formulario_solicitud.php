<?php
include("proteger_cliente.php");
include("conexion.php");

$sql = "SELECT * FROM EQUIPO WHERE estado='Activo'";
$equipos = mysqli_query($conexion, $sql);
?>

<h2>Solicitar equipo</h2>

<form action="registrar_solicitud.php" method="POST">

    <label>Equipo:</label>
    <select name="id_equipo" required>
        <?php while($e = mysqli_fetch_assoc($equipos)) { ?>
            <option value="<?= $e['id_equipo'] ?>">
                <?= $e['tipo_equipo'] ?> - <?= $e['marca'] ?>
            </option>
        <?php } ?>
    </select>

    <br><br>

    <input type="number" name="cantidad" placeholder="Cantidad" required>

    <br><br>

    <textarea name="observacion" placeholder="Descripción / motivo" required></textarea>

    <br><br>

    <button type="submit">
        Enviar solicitud
    </button>

</form>