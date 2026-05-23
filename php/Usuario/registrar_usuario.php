<?php
include("proteger_admin.php");
include("conexion.php");

$nombre=$_POST['nombre'];
$apellido=$_POST['apellido'];
$correo=$_POST['correo'];
$contrasena=password_hash(
$_POST['contrasena'],
PASSWORD_DEFAULT
);

$sql="
INSERT INTO USUARIO (nombre,apellido,correo,contrasena)
VALUES ('$nombre','$apellido','$correo','$contrasena')";

if(mysqli_query($conexion,$sql)){
    echo "Usuario registrado";
    }else{
        echo mysqli_error($conexion);
    }
?>