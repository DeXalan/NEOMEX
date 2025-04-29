// citas_coor.js

// Función para cargar las citas al cargar la página
document.addEventListener('DOMContentLoaded', async function () {
    try {
        const response = await fetch('../../backend/obtener_citas.php');
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

// Función para cancelar una cita con motivo
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
            const { value: motivo } = await Swal.fire({
                title: 'Motivo de cancelación',
                input: 'textarea',
                inputLabel: 'Escribe el motivo',
                inputPlaceholder: 'Motivo...',
                inputAttributes: {
                    'aria-label': 'Motivo de la cancelación'
                },
                showCancelButton: true
            });

            if (!motivo) {
                Swal.fire('Cancelación abortada', 'Debes ingresar un motivo para cancelar.', 'info');
                return;
            }

            try {
                const formData = new FormData();
                formData.append('id', id);
                formData.append('motivo', motivo);

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

