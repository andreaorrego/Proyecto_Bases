<?php
include("proteger_admin.php");
include("conexion.php");

$serie = $_POST['serie'];
$marca = $_POST['marca'];
$modelo = $_POST['modelo'];
$tipo = $_POST['tipo_equipo'];
$id_proveedor = $_POST['id_proveedor'];

$sql = "
INSERT INTO EQUIPO (serie, marca, modelo, tipo_equipo, id_proveedor)
VALUES('$serie', '$marca', '$modelo', '$tipo', $id_proveedor)
";

mysqli_query($conexion,"
INSERT INTO HISTORIAL_EQUIPO (id_equipo, evento, descripcion)
VALUES ($id_equipo, 'Registro', 'Equipo creado en el sistema')
");

if(mysqli_query($conexion,$sql)){
    echo "Equipo registrado correctamente";
    }else{
        echo mysqli_error($conexion);
        }
?>