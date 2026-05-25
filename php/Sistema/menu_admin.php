<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}

if ($_SESSION['rol'] != "admin") {
    header("Location: /Proyecto_Bases/php/Usuario/menu.php");
    exit();
}

$plantilla = file_get_contents(
    $_SERVER['DOCUMENT_ROOT'] .
    '/Proyecto_Bases/html/Usuario/menu_admin.html'
);

echo $plantilla;
?>