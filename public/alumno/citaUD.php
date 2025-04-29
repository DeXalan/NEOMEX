<?php include("../../backend/Verificar_alumno.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver y Modificar Citas</title>
    <link rel="stylesheet" href="estilooo.css">
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
            </tbody>
        </table>
    </div>

    <script>
        function formatearFechaVista(fechaISO) {
            const [year, month, day] = fechaISO.split("-");
            return `${day}/${month}/${year}`;
        }

        function formatearHoraVista(hora24) {
            const [h, m] = hora24.split(":"), hNum = parseInt(h);
            const ampm = hNum >= 12 ? "PM" : "AM";
            const hora12 = hNum % 12 || 12;
            return `${hora12}:${m} ${ampm}`;
        }

        function volver(){
            window.location.href = "../menu-alu.html";
        }

        function cerrarSesion(){
            window.location.href = "login.html";
        }
    </script>

    <script src="../../js/ver_citas.js"></script>
</body>
</html>
