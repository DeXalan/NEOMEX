<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
document.addEventListener("DOMContentLoaded", function () {
    fetch("obtener_citas.php")
        .then(response => response.json())
        .then(citas => {
            const citasList = document.getElementById("citas-list");
            citasList.innerHTML = "";

            citas.forEach(cita => {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${cita.id}</td>
                    <td>${cita.alumno}</td>
                    <td>${cita.fecha}</td>
                    <td>${cita.hora}</td>
                    <td>${cita.asunto}</td>
                    <td>
                        <button onclick="cancelarCita(${cita.id})">Cancelar</button>
                    </td>
                `;
                citasList.appendChild(row);
            });
        });
});

function cancelarCita(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        input: 'textarea',
        inputLabel: 'Motivo de cancelación',
        inputPlaceholder: 'Escribe el motivo...',
        showCancelButton: true,
        confirmButtonText: 'Sí, cancelar cita',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed && result.value.trim() !== "") {
            fetch('/ruta/backend/cancelar_cita.php', {
                method: 'POST',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: `id_cita=${id}&motivo=${encodeURIComponent(result.value)}`
            })
            .then(response => response.text())
            .then(data => {
                Swal.fire('Cancelado', data, 'success').then(() => {
                    location.reload(); // Recargar para actualizar la tabla
                });
            });
        }
    });
}