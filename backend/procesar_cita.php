<?php
session_start();
header('Content-Type: application/json');

include("conexion.php"); // tu conexión a la base de datos

$nombre = $_POST['nombre'];
$numeroControl = $_POST['num_control'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$asunto = $_POST['asunto'];

// Verificar si ya existe una cita en esa fecha y hora
$sql = "SELECT * FROM cita WHERE fecha = ? AND hora = ? AND cancelada = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $fecha, $hora);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'Ya existe una cita programada en esa fecha y hora.']);
    exit();
}

// Verificar disponibilidad del coordinador
$sqlHorario = "SELECT * FROM horario_coordinador WHERE fecha = ? AND horaInicio <= ? AND horaFin >= ? AND disponible = 0";
$stmtHorario = $conn->prepare($sqlHorario);
$stmtHorario->bind_param("sss", $fecha, $hora, $hora);
$stmtHorario->execute();
$resultHorario = $stmtHorario->get_result();

if ($resultHorario->num_rows > 0) {
    echo json_encode(['success' => false, 'message' => 'El coordinador no está disponible en ese horario.']);
    exit();
}

// Insertar la cita
$sqlInsert = "INSERT INTO cita (fecha, hora, asunto, numeroControl) VALUES (?, ?, ?, ?)";
$stmtInsert = $conn->prepare($sqlInsert);
$stmtInsert->bind_param("ssss", $fecha, $hora, $asunto, $numeroControl);

if ($stmtInsert->execute()) {
    echo json_encode(['success' => true, 'message' => 'Tu cita ha sido solicitada correctamente.']);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al solicitar la cita.']);
}
?>
