<?php
include('../../backend/verificar_sesion_coordinador.php');
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Solicitudes de Materias de Verano</title>
  <link rel="stylesheet" href="estiloos.css">
</head>
<body>
  <div class="header">
    <button class="logout-button" onclick="volver()">🡸</button>
    <h1>Solicitudes de Materias de Verano</h1>
    <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
  </div>

  <div class="container">
    <h2>Solicitudes Registradas</h2>
    <table>
      <thead>
        <tr>
          <th>Materia</th>
          <th>Total Alumnos</th>
          <th>Periodo</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody id="tabla-solicitudes">
      </tbody>
    </table>
  </div>

  <script>
    function volver() {
      window.location.href = "../menu-coor.php";
    }

    function cerrarSesion() {
      window.location.href = "../login.html";
    }

    function cargarSolicitudes() {
      fetch("../../backend/obtener_solicitudes_verano.php")
        .then(response => response.json())
        .then(data => {
          const tabla = document.getElementById("tabla-solicitudes");
          tabla.innerHTML = "";

          data.forEach(solicitud => {
            if (solicitud.estado === "espera") {
              const row = document.createElement("tr");
              row.innerHTML = `
                <td>${solicitud.materia}</td>
                <td>${solicitud.numSolicitudes}</td>
                <td>${solicitud.periodo}</td>
                <td>
                  <button class="btn-confirmar" onclick="actualizarEstado(${solicitud.id}, 'aceptada')">Confirmar</button>
                  <button class="btn-rechazar" onclick="actualizarEstado(${solicitud.id}, 'rechazada')">No se abrirá</button>
                </td>
              `;
              tabla.appendChild(row);
            }
          });
        });
    }

    function actualizarEstado(id, estado) {
      fetch("../../backend/actualizar_estado_verano.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id=${id}&estado=${estado}`
      })
      .then(response => response.text())
      .then(data => {
        alert(data);
        cargarSolicitudes();
      });
    }

    document.addEventListener("DOMContentLoaded", cargarSolicitudes);
  </script>
</body>
</html>
