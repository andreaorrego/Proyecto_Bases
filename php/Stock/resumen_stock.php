<?php
include("proteger_admin.php");
include("conexion.php");

$disponibles = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) as total FROM EQUIPO WHERE estado='Activo'"
))['total'];

$transferidos = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) as total FROM SOLICITUD_CLIENTE WHERE estado IN ('Aprobada','Entregada')"
))['total'];

$baja = mysqli_fetch_assoc(mysqli_query($conexion,
"SELECT COUNT(*) as total FROM EQUIPO WHERE estado='Inactivo'"
))['total'];
?>