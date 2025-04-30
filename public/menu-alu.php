<?php include("../backend/Verificar_alumno.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú - Alumno</title>
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
            <h2 class="menu-h2">Alumno</h2>
            <button class="menu-button" onclick="irA('alumno/cita.php')">Solicitar Cita</button>
            <button class="menu-button" onclick="irA('alumno/citaUD.php')">Modificar Cita</button>             
            <br>
            <button class="menu-button" onclick="irA('alumno/solicitudVerano.php')">Solicitar Materia de Verano</button>
            <button class="menu-button" onclick="irA('alumno/solicitudCambio.html')">Solicitar Cambio de Horario</button>
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
