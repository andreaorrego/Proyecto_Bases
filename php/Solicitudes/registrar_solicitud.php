<?php
include("proteger_admin.php");
include("conexion.php");

$id_cliente = $_POST['id_cliente'];
$id_equipo = $_POST['id_equipo'];
$observacion = $_POST['observacion'];
$cantidad = $_POST['cantidad'];
$fecha_retorno = $_POST['fecha_retorno'];

$sql = "
INSERT INTO SOLICITUD_CLIENTE (id_cliente, id_equipo, observacion, cantidad, fecha_retorno)
VALUES ($id_cliente, $id_equipo, '$observacion', $cantidad, '$fecha_retorno')
";

if(mysqli_query($conexion,$sql)){
    echo "Solicitud registrada correctamente";
    }else{
        echo mysqli_error($conexion);
        }
?>