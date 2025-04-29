<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Alumno')  {
    header("Location: ../public/login.html");
    exit();
}
?>