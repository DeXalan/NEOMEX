<?php
session_start();
require_once('conexion.php');
header('Content-Type: application/json');

if (!isset($_GET['id_solicitud'], $_GET['estado'])) {
    echo json_encode(["success" => false, "message" => "Datos incompletos"]);
    exit;
}

$id_solicitud = $_GET['id_solicitud'];
$estado = $_GET['estado'];

$estados_validos = ['espera', 'aceptada', 'cancelada'];
if (!in_array($estado, $estados_validos)) {
    echo json_encode(["success" => false, "message" => "Estado inválido"]);
    exit;
}

$stmt = $conn->prepare("UPDATE solicitud_cambio_horario SET estado = ? WHERE id = ?");
if (!$stmt) {
    echo json_encode(["success" => false, "message" => "Error prepare: " . $conn->error]);
    exit;
}
$stmt->bind_param("si", $estado, $id_solicitud);
if ($stmt->execute()) {
    echo json_encode(["success" => true]);
} else {
    echo json_encode(["success" => false, "message" => "Error al ejecutar: " . $stmt->error]);
}
