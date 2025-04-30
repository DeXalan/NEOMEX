<?php include("../backend/Verificar_maestro.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú - Maestro</title>
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
            <h2 class="menu-h2">Maestro</h2>
            <button class="menu-button" onclick="irA('maestro/cita.php')">Solicitar Cita</button>
            <button class="menu-button" onclick="irA('maestro/citaUD.php')">Modificar Cita</button>
        </div>

    </div>

    <script>
        function irA(pagina) {
            const paginasCompartidas = [
                "cita.html",
                "citaUD.html",
                "verDisponibilidad.html"
            ];

            if (paginasCompartidas.includes(pagina)) {
                window.location.href = `${pagina}?origen=menu-alu.html`;
            } else {
                window.location.href = pagina;
            }
        }


        function cerrarSesion() {
            alert("Sesión cerrada correctamente");
            window.location.href = "inicio.html"; 
        }
    </script>
</body>
</html>
