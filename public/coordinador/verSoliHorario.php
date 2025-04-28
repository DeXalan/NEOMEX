<?php
include('D:/CarpetaP/htdocs/Suminex/backend/verificar_sesion_coordinador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Solicitudes de Cambio de Horario</title>
    <link rel="stylesheet" href="estiloos.css">
</head>
<body>
    <div class="header">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Solicitudes Cambio de Horario</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>

    <div class="container">
        <h2>Solicitudes Registradas</h2>
        <div id="solicitudes-list">
            <!-- Aquí se cargarán las solicitudes dinámicamente -->
        </div>
    </div>

    <script src="../js/SoliHorario_coor.js"></script>
    <script>
        function volver() {
            window.location.href = "../menu-coor.php"
        }
        
    </script>
</body>
</html>
