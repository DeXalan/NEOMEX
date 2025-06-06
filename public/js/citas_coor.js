// citas_coor.js

// Función para cargar las citas al cargar la página
document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('../../backend/citas_programadas.php'); // <- Ajusta si tu PHP se llama diferente
        const citas = await response.json();

        const citasList = document.getElementById('citas-list');

        if (citas.length === 0) {
            citasList.innerHTML = `
                <tr>
                    <td colspan="6">No hay citas programadas.</td>
                </tr>
            `;
            return;
        }

        citas.forEach(cita => {
            const row = document.createElement('tr');

            row.innerHTML = `
                <td>${cita.id}</td>
                <td>${cita.alumno}</td>
                <td>${cita.fecha}</td>
                <td>${cita.hora}</td>
                <td>${cita.asunto}</td>
                <td>
                    <button class="btn-accion" onclick="cancelarCita(${cita.id})">Cancelar</button>
                </td>
            `;

            citasList.appendChild(row);
        });

    } catch (error) {
        console.error('Error cargando citas:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudieron cargar las citas.',
            confirmButtonText: 'Aceptar'
        });
    }
});

// Función para cancelar una cita
function cancelarCita(id) {
    Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas cancelar esta cita?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, cancelar',
        cancelButtonText: 'No, conservar'
    }).then(async (result) => {
        if (result.isConfirmed) {
            try {
                const formData = new FormData();
                formData.append('id', id);

                const response = await fetch('../../backend/cancelar_cita.php', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    Swal.fire('Cancelado', result.message, 'success')
                        .then(() => location.reload()); // recargar página
                } else {
                    Swal.fire('Error', result.message, 'error');
                }
            } catch (error) {
                console.error('Error cancelando cita:', error);
                Swal.fire('Error', 'No se pudo cancelar la cita.', 'error');
            }
        }
    });
}
