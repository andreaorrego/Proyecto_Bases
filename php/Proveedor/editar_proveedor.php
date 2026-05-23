<?php
include("proteger_admin.php");
include("conexion.php");

$id = $_GET['id'];

$sql = "SELECT * FROM PROVEEDOR WHERE id_proveedor=$id";
$resultado = mysqli_query($conexion, $sql);
$proveedor = mysqli_fetch_assoc($resultado);
?>

<h2>Editar Proveedor</h2>

<form action="actualizar_proveedor.php" method="POST">

    <input type="hidden" name="id_proveedor" value="<?= $proveedor['id_proveedor'] ?>">

    <input type="text" 
            name="nombre" 
            value="<?= $proveedor['nombre'] ?>" 
            required>

    <input type="text" 
            name="nit" 
            value="<?= $proveedor['NIT'] ?>" 
            required>

    <input type="email" 
            name="correo" 
            value="<?= $proveedor['correo'] ?>" 
            required>

    <input type="text" 
            name="telefono" 
            value="<?= $proveedor['telefono'] ?>" 
            required>

    <button type="submit">
        Actualizar
    </button>

</form>