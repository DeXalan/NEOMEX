<?php 
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $numeroControl = $_POST['numeroControl'];
    $correo = $_POST['correo'];
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);

    // Detectar el rol por el correo
    if (preg_match('/^lis\d{8}@irapuato\.tecnm\.mx$/', $correo)) {
        $rol = 'Alumno';
    } elseif (preg_match('/^[a-z]+\.[a-z]+@irapuato\.tecnm\.mx$/', $correo)) {
        $rol = 'Maestro';
    } else {
        echo "Correo no válido para el sistema.";
        exit;
    }

    $sql = "INSERT INTO Usuario (nombre, numeroControl, correo, contraseña, rol) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $nombre, $numeroControl, $correo, $contraseña, $rol);
    
    if ($stmt->execute()) {
        require_once 'correo_confirmacion.php';
        enviarCorreoConfirmacion($correo, $nombre);
        echo "
        <!DOCTYPE html>
        <html lang='es'>
        <head>
            <meta charset='UTF-8'>
            <title>Registro exitoso</title>
            <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
        </head>
        <body>
            <script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registro exitoso',
                    text: 'Has sido registrado como $rol',
                    showConfirmButton: false,
                    timer: 2000
                }).then(() => {
                    window.location.href = '../public/login.html';
                });
            </script>
        </body>
        </html>
        ";
    } else {
        echo "Error: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
