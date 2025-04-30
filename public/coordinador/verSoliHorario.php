<?php
include('../../backend/verificar_sesion_coordinador.php');
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

    <script>
        async function cargarSolicitudes() {
            try {
                const response = await fetch("../../backend/obtener_solicitudes_cambio_horario.php");
                const data = await response.json();

                if (data.success) {
                    const solicitudes = data.solicitudes;
                    const solicitudesList = document.getElementById('solicitudes-list');
                    solicitudesList.innerHTML = '';

                    solicitudes.forEach(solicitud => {
                        const solicitudElement = document.createElement('div');
                        solicitudElement.classList.add('solicitud');

                        // Datos del alumno
                        solicitudElement.innerHTML = `
                            <h3>Nombre: ${solicitud.nombreAlumno}</h3>
                            <p>No. de Control: ${solicitud.noControl}</p>
                            <p>Motivo: ${solicitud.motivo}</p>
                            <p><strong>Materias de Alta:</strong> ${solicitud.altas.join(', ')}</p>
                            <p><strong>Materias de Baja:</strong> ${solicitud.bajas.join(', ')}</p>
                        `;

                        // Imagen
                        if (solicitud.imagen) {
                            solicitudElement.innerHTML += `
                                <button onclick="verImagen('${solicitud.imagen}')">Abrir Imagen</button>
                            `;
                        }

                        // Botones de aceptar o rechazar
                        solicitudElement.innerHTML += `
                            <button onclick="cambiarEstado(${solicitud.id_solicitud}, 'aceptada')">Aceptar</button>
                            <button onclick="cambiarEstado(${solicitud.id_solicitud}, 'cancelada')">Rechazar</button>
                        `;

                        solicitudesList.appendChild(solicitudElement);
                    });
                }
            } catch (error) {
                console.error("Error al cargar solicitudes:", error);
            }
        }

        function verImagen(imagenBase64) {
            const imgWindow = window.open();
            imgWindow.document.write('<img src="data:image/png;base64,' + imagenBase64 + '" />');
        }
        async function cambiarEstado(idSolicitud, estado) {
            try {
                const response = await fetch(`../../backend/cambiar_estado_solicitud.php?id_solicitud=${idSolicitud}&estado=${estado}`);
                const data = await response.json();

                if (data.success) {
                    alert("Solicitud " + estado);
                    cargarSolicitudes(); // Recargar las solicitudes
                } else {
                    alert("Error al cambiar estado: " + data.message);
                }
            } catch (error) {
                console.error("Error al cambiar estado:", error);
            }
        }


        function volver() {
            window.location.href = "../menu-coor.php";
        }

        function cerrarSesion() {
            // Redirige al logout
            window.location.href = "../../backend/logout.php";
        }

        // Cargar las solicitudes cuando la página se cargue
        window.onload = cargarSolicitudes;
    </script>
</body>
</html>
