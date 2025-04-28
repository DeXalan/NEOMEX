<?php include("../backend/verificar_sesion_coordinador.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú - Coordinador</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body class="body-menu">

    <header class="header-menu">
        <h1 class="header-h1">Sistema para Agendar Citas</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </header>

    <div class="menu-container">
        <h1 class="menu-h1">Menú</h1>
        
        <div class="menu">
            <h2 class="menu-h2">Coordinador</h2>
            <button class="menu-button" onclick="irA('coordinador/disponibilidad.php')">Disponibilidad</button>
            <button class="menu-button" onclick="irA('coordinador/verCitas.php')">Ver Citas Programadas</button>
            <button class="menu-button" onclick="irA('coordinador/VerSoliHorario.php')">Revisar Solicitudes de Cambio De Horario</button>
            <button class="menu-button" onclick="irA('coordinador/verSoliVerano.php')">Revisar Solicitudes de Materias de Verano</button>
        </div>
    </div>

    <script>
        function irA(pagina) {
            window.location.href = pagina;
        }

        function cerrarSesion() {
            alert("Sesión cerrada correctamente");
            window.location.href = "inicio.html"; 
        }
    </script>
</body>
</html>
