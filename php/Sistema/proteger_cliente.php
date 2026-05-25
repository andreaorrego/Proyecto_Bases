<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] != "cliente") {
    header("Location: /Proyecto_Bases/html/Usuario/login.html");
    exit();
}
?>