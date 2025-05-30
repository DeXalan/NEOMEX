<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function enviarCorreoConfirmacion($correoDestino, $nombreUsuario) {
    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'nomamesweymx@gmail.com'; // Cambia esto
        $mail->Password   = 'xdxx btzf zpom ybta'; // Contraseña de aplicación
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Datos del correo
        $mail->setFrom('tu_correo@gmail.com', 'Sistema de Citas');
        $mail->addAddress($correoDestino, $nombreUsuario);
        $mail->isHTML(true);
        $mail->Subject = 'Confirmación de registro';
        $mail->Body    = "<h3>Hola $nombreUsuario,</h3><p>Tu cuenta ha sido registrada exitosamente en el sistema.</p>";

        $mail->send();
        // Si quieres depurar: echo "Correo enviado";
    } catch (Exception $e) {
        error_log("No se pudo enviar el correo. Error: {$mail->ErrorInfo}");
    }
}
?>
