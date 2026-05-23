<?php
session_start();
include("proteger_admin.php");
include("conexion.php");

if (!isset($_SESSION['correo'])) {
    header("Location: login.html");
    exit();
}
?>

<h1>Bienvenido al sistema</h1>

<p>Usuario: <?php echo $_SESSION['correo']; ?></p>

<a href="logout.php">
    Cerrar sesión
</a>