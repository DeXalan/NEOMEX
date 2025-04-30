document.addEventListener('DOMContentLoaded', () => {
    const correoInput = document.querySelector('input[name="correo"]');
    const rolInfo = document.createElement('p');
    correoInput.parentNode.insertBefore(rolInfo, correoInput.nextSibling);

    correoInput.addEventListener('input', () => {
        const correo = correoInput.value.trim();
        let rol = '';

        if (/^lis\d{8}@irapuato\.tecnm\.mx$/.test(correo)) {
            rol = 'Alumno';
        } else if (/^[a-z]+\.[a-z]+@irapuato\.tecnm\.mx$/.test(correo)) {
            rol = 'Maestro';
        } else {
            rol = 'Correo no válido';
        }

        rolInfo.textContent = 'Rol detectado: ' + rol;
    });

    // Validar antes de enviar el formulario
    const form = document.querySelector('form');
    form.addEventListener('submit', (e) => {
        const correo = correoInput.value.trim();
        if (
            !/^lis\d{8}@irapuato\.tecnm\.mx$/.test(correo) &&
            !/^[a-z]+\.[a-z]+@irapuato\.tecnm\.mx$/.test(correo)
        ) {
            e.preventDefault();
            alert('El correo ingresado no es válido. Usa tu correo institucional.');
        }
    });
});

