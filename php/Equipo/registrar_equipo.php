<?php
require_once __DIR__ . '/../conexion.php';
require_once __DIR__ . '/../Sistema/proteger_admin.php';

$serie = mysqli_real_escape_string($conexion, $_POST['serie']);
$marca = mysqli_real_escape_string($conexion, $_POST['marca']);
$modelo = mysqli_real_escape_string($conexion, $_POST['modelo']);
$tipo = mysqli_real_escape_string($conexion, $_POST['tipo_equipo']);
$id_proveedor = (int)$_POST['id_proveedor']; 

$sql_equipo = "INSERT INTO EQUIPO (serie, marca, modelo, tipo_equipo, id_proveedor) 
               VALUES('$serie', '$marca', '$modelo', '$tipo', $id_proveedor)";

if(mysqli_query($conexion, $sql_equipo)){
    
    $nuevo_id = mysqli_insert_id($conexion);
    
    mysqli_query($conexion, "INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion) 
                             VALUES ($nuevo_id, 'Registro', 'Equipo creado en el sistema')");
    
    echo "Equipo registrado correctamente.";
        header("Location: /Proyecto_Bases/php/Equipo/listar_equipo.php");
} else {
    echo "Error al registrar: " . mysqli_error($conexion);
}
?>