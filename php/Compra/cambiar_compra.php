<?php
include("proteger_admin.php");
include("conexion.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    
    $id = mysqli_real_escape_string($conexion, $_GET['id']);

    $sql = "UPDATE SOLICITUD_COMPRA SET estado = 'Recibida' WHERE id_compra = $id";
    
    if (mysqli_query($conexion, $sql)) {
        header("Location: listar_compra.php?mensaje=actualizado");
    } else {
        echo "Error al actualizar: " . mysqli_error($conexion);
        exit();
    }

} else {
    header("Location: listar_compra.php");
}
exit();
?>