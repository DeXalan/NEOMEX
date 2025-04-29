function volver(){
    window.location.href = "../menu-alu.php";
}
function cerrarSesion() {
    window.location.href = "../login.html";
}

// Enviar el formulario usando fetch
document.getElementById('form_cita').addEventListener('submit', async function(event) {
    event.preventDefault(); // Evitar recarga

    const formData = new FormData(this);

    try {
        const response = await fetch('../../backend/procesar_cita.php', {
            method: 'POST',
            body: formData
        });

        const result = await response.json(); // Esperar la respuesta en JSON

        if (result.success) {
            Swal.fire({
                icon: 'success',
                title: '¡Cita solicitada!',
                text: result.message,
                confirmButtonText: 'Aceptar'
            }).then(() => {
                window.location.href = "../menu-alu.html"; // Redirigir después de aceptar
            });
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: result.message,
                confirmButtonText: 'Intentar de nuevo'
            });
        }

    } catch (error) {
        console.error(error);
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Ocurrió un error al enviar la solicitud.',
            confirmButtonText: 'Aceptar'
        });
    }
});