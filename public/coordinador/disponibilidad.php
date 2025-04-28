<?php
include('D:/CarpetaP/htdocs/Suminex/backend/verificar_sesion_coordinador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Disponibilidad</title>
    <link rel="stylesheet" href="estiloos.css">
</head>
<body>

    <header class="header">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Registrar Disponibilidad</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </header>

    <div class="container">
        <form action="/suminex/backend/guardar_horario.php" method="POST">
            <label for="fecha">Fecha:</label>
            <input type="date" name="fecha" required>
            <label for="horaInicio">Hora Inicio:</label>
            <input type="time" name="horaInicio" min="09:00" max="19:00" required>
            <label for="horaFin">Hora Fin:</label>
            <input type="time" name="horaFin" min="09:00" max="19:00" required>
            <input type="checkbox" name="todoElDia" value="1"> No disponible todo el día
            <button type="submit">Guardar Horario</button>
        </form>

        <!-- Lista donde se mostrarán las disponibilidades agregadas -->
        <div class="disponibilidad-list">
            <h2>Registro De Horas No Disponibles</h2>
            <ul id="lista-disponibilidad"></ul>
        </div>
    </div>
    <script src="../js/script.js"></script>
    <script>
        function agregarDisponibilidad() {
            let dia = document.getElementById("dia").value;
            let horaInicio = document.getElementById("hora-inicio").value;
            let horaFin = document.getElementById("hora-fin").value;

            if (horaInicio && horaFin) {
                let lista = document.getElementById("lista-disponibilidad");
                let nuevoItem = document.createElement("li");
                nuevoItem.textContent = `${dia}: ${horaInicio} - ${horaFin}`;
                
                // Agregar opción de eliminar
                let botonEliminar = document.createElement("button");
                botonEliminar.textContent = "❌";
                botonEliminar.classList.add("delete-btn");
                botonEliminar.onclick = function() {
                    lista.removeChild(nuevoItem);
                };

                nuevoItem.appendChild(botonEliminar);
                lista.appendChild(nuevoItem);
            } else {
                alert("Por favor, seleccione un horario válido.");
            }
        }

        function cerrarSesion() {
            window.location.href = "login.html"; // Redireccionar a la página de login
        }

        function volver() {
            window.location.href = "../menu-coor.php"
        }
    </script>

</body>
</html>
