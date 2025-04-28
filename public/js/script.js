<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

document.addEventListener("DOMContentLoaded", function () {
    const todoElDiaCheckbox = document.querySelector('input[name="todoElDia"]');
    const horaInicioInput = document.querySelector('input[name="horaInicio"]');
    const horaFinInput = document.querySelector('input[name="horaFin"]');
    const formulario = document.getElementById("horario-form");

    // Deshabilitar campos si se selecciona todo el día
    todoElDiaCheckbox.addEventListener("change", function () {
        if (this.checked) {
            horaInicioInput.disabled = true;
            horaFinInput.disabled = true;
            horaInicioInput.value = "";
            horaFinInput.value = "";
        } else {
            horaInicioInput.disabled = false;
            horaFinInput.disabled = false;
        }
    });

    // Validar que la hora de fin sea mayor a la de inicio
    horaFinInput.addEventListener("change", function () {
        if (horaInicioInput.value && horaFinInput.value <= horaInicioInput.value) {
            Swal.fire({
                icon: "warning",
                title: "¡Atención!",
                text: "La hora de fin debe ser mayor que la hora de inicio.",
                confirmButtonText: "Entendido"
            });
            horaFinInput.value = "";
        }
    });

    // Confirmación al enviar el formulario
    formulario.addEventListener("submit", function (e) {
        e.preventDefault(); // Evita que se envíe de inmediato

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas guardar este horario como no disponible?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formulario.submit(); // Ahora sí envía el formulario
            }
        });
    });
});

