<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Alumno')  {
    header("Location: ../public/login.html");
    exit();
}

// Suponiendo que guardaste 'nombre' y 'numeroControl' en la sesión:
$nombre = $_SESSION['nombre'] ?? '';
$numeroControl = $_SESSION['numeroControl'] ?? '';
?>
