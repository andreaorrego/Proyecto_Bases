<?php
session_start();
include("conexion.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = intval($_POST['id_usuario']);
    $cargo = $_POST['cargo'];
    $dependencia = $_POST['dependencia'];
    
    $sql = "UPDATE CLIENTE SET cargo = ?, dependencia = ? WHERE id_usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssi", $cargo, $dependencia, $id);
    
    if ($stmt->execute()) {
        header("Location: listar_clientes.php?exito=1");
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>