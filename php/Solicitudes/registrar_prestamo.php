<?php
include("proteger_admin.php");
include("conexion.php");

$id_solicitud = $_POST['id_solicitud'];
$fecha_entrega = $_POST['fecha_entrega'];

$sql = "
INSERT INTO PRESTAMO (id_solicitud, fecha_entrega)
VALUES ($id_solicitud,'$fecha_entrega')
";

if(mysqli_query($conexion,$sql)){
    echo "Préstamo registrado correctamente";
    }else{
        echo mysqli_error($conexion);
        }
?>