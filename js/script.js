document.addEventListener("DOMContentLoaded", function () {
    const todoElDiaCheckbox = document.querySelector('input[name="todoElDia"]');
    const horaInicioInput = document.querySelector('input[name="horaInicio"]');
    const horaFinInput = document.querySelector('input[name="horaFin"]');
    const fechaInput = document.querySelector('input[name="fecha"]');
    const formulario = document.getElementById("horario-form");

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

    // NUEVO CÓDIGO PARA EVITAR HORARIOS PASADOS HOY
    fechaInput.addEventListener("change", function () {
        ajustarHorasPermitidas();
    });

    horaInicioInput.addEventListener("input", function () {
        validarHoraInicio();
    });

    function ajustarHorasPermitidas() {
        const fechaSeleccionada = new Date(fechaInput.value);
        const hoy = new Date();
        hoy.setHours(0, 0, 0, 0); // eliminar horas, minutos y segundos de 'hoy'

        if (fechaSeleccionada.getTime() === hoy.getTime()) {
            const ahora = new Date();
            const horas = ahora.getHours().toString().padStart(2, '0');
            const minutos = ahora.getMinutes().toString().padStart(2, '0');
            const horaActual = `${horas}:${minutos}`;

            horaInicioInput.min = horaActual;
            horaFinInput.min = horaActual;
        } else {
            horaInicioInput.min = "09:00";
            horaFinInput.min = "09:00";
        }

        horaInicioInput.max = "19:00";
        horaFinInput.max = "19:00";
    }

    function validarHoraInicio() {
        if (horaInicioInput.value && horaFinInput.value && horaInicioInput.value >= horaFinInput.value) {
            Swal.fire({
                icon: "warning",
                title: "¡Atención!",
                text: "La hora de inicio debe ser menor que la hora de fin.",
                confirmButtonText: "Entendido"
            });
            horaInicioInput.value = "";
        }
    }

    formulario.addEventListener("submit", function (e) {
        e.preventDefault();

        Swal.fire({
            title: '¿Estás seguro?',
            text: "¿Deseas guardar este horario como no disponible?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sí, guardar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                formulario.submit();
            }
        });
    });
});
