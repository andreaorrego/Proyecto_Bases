<?php
session_start();

if (!isset($_SESSION['id_usuario'])) {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}

if ($_SESSION['rol'] == "admin") {

    $plantilla = file_get_contents(
        $_SERVER['DOCUMENT_ROOT'] .
        '/Proyecto_Bases/html/Usuario/menu_admin.html'
    );

    echo $plantilla;
    exit();
}

if ($_SESSION['rol'] == "cliente") {

    $plantilla = file_get_contents(
        $_SERVER['DOCUMENT_ROOT'] .
        '/Proyecto_Bases/html/Usuario/menu_cliente.html'
    );

    echo $plantilla;
    exit();
}

session_destroy();
header("Location: /Proyecto_Bases/html/Usuario/login.html");
exit();
?>