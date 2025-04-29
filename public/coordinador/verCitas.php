<?php
include('../../backend/verificar_sesion_coordinador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver Citas Programadas</title>
    <link rel="stylesheet" href="estiloos.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="header_Citas">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Citas Programadas</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>

    <div class="container_Citas">
        <h2>Citas Programadas</h2>
        <table class="table-citas">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Alumno</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Asunto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody id="citas-list">
                <!-- Aquí se cargarán dinámicamente las citas -->
            </tbody>
        </table>
    </div>

    <script>
        function cerrarSesion() {
            window.location.href = "../login.html";
        }
        function volver() {
            window.location.href = "../menu-coor.php"
        }
    </script>
    <script src="../../js/citas_coor.js"></script>
</body>
</html>
    