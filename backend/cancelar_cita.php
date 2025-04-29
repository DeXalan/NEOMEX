<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cita = $_POST['id'] ?? null;
    $motivo = $_POST['motivo'] ?? 'Sin motivo especificado';

    if (!$id_cita) {
        echo json_encode(['success' => false, 'message' => 'ID de cita no proporcionado']);
        exit;
    }

    // Marcar la cita como cancelada
    $update = "UPDATE cita SET cancelada = 1 WHERE id = ?";
    $stmt_update = $conn->prepare($update);
    if (!$stmt_update) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare update: ' . $conn->error]);
        exit;
    }
    $stmt_update->bind_param("i", $id_cita);
    if (!$stmt_update->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error al cancelar la cita: ' . $stmt_update->error]);
        exit;
    }

    // Insertar en cancelar_cita
    $insert = "INSERT INTO cancelar_cita (id_cita, motivo) VALUES (?, ?)";
    $stmt_insert = $conn->prepare($insert);
    if (!$stmt_insert) {
        echo json_encode(['success' => false, 'message' => 'Error en prepare insert: ' . $conn->error]);
        exit;
    }
    $stmt_insert->bind_param("is", $id_cita, $motivo);
    if (!$stmt_insert->execute()) {
        echo json_encode(['success' => false, 'message' => 'Error al registrar cancelación: ' . $stmt_insert->error]);
        exit;
    }

    echo json_encode(['success' => true, 'message' => 'Cita cancelada correctamente']);
}


$conn->close();
?>
