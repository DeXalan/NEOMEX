<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_solicitud = $_POST['id_solicitud'];
    $estado = $_POST['estado'];

    // Actualizamos el estado de la solicitud
    $update = $conn->prepare("UPDATE Solicitud_Cambio_Horario SET estado = ? WHERE id = ?");
    $update->bind_param("si", $estado, $id_solicitud);

    if ($update->execute()) {
        echo "Solicitud actualizada correctamente";
    } else {
        echo "Error al actualizar la solicitud: " . $conn->error;
    }

    $update->close();
    $conn->close();
}
?>
