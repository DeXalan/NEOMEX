<?php
session_start();

if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'Coordinador')  {
    // Redirige si no es coordinador
    header("Location: ../login.html");
    exit();
}
?>
