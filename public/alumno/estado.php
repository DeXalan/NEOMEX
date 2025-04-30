<?php include("../../backend/Verificar_alumno.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis Solicitudes</title>
    <link rel="stylesheet" href="estilooo.css">
</head>
<body>
    <h1>Estado de mis solicitudes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Solicitud</th>
                <th>Estado</th>
                <th>Motivo</th>
            </tr>
        </thead>
        <tbody id="tabla-solicitudes">
            <tr><td colspan="3">Cargando...</td></tr>
        </tbody>
    </table>

    <script>
    document.addEventListener("DOMContentLoaded", async () => {
        try {
            const res = await fetch("../../backend/obtener_solicitudes_alumno.php");
            const data = await res.json();

            const tbody = document.getElementById("tabla-solicitudes");
            tbody.innerHTML = "";

            if (!data.success || data.solicitudes.length === 0) {
                tbody.innerHTML = `<tr><td colspan="3">No hay solicitudes registradas.</td></tr>`;
                return;
            }

            data.solicitudes.forEach(s => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${s.tipo}</td>
                    <td>${s.estado}</td>
                    <td>${s.motivo}</td>
                `;
                tbody.appendChild(row);
            });
        } catch (err) {
            console.error(err);
            alert("Error al cargar las solicitudes.");
        }
    });
    </script>
</body>
</html>
