<?php include("../../backend/Verificar_maestro.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver y Modificar Citas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="header-c">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Solicitar Cita</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>

    <div class="container">
        <h2>Mis Citas</h2>
        <table class="table-ud">
            <thead>
                <tr>
                    <th class="th-ud">Fecha</th>
                    <th class="th-ud">Hora</th>
                    <th class="th-ud">Asunto</th>
                    <th class="th-ud">Acciones</th>
                </tr>
            </thead>
            <tbody id="citas-body">
                <!-- Citas se agregarán dinámicamente aquí -->
            </tbody>
        </table>
    </div>

    <script src="../../js/ver_citas.js"></script>
    <script>
        function volver(){
            window.location.href = "../menu-maes.html";
        }

        function cerrarSesion(){
            window.location.href = "../login.html";
        }

        document.addEventListener("DOMContentLoaded", cargarCitas);

    </script>
</body>
</html>
