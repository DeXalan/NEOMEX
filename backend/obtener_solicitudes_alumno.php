<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['numeroControl'])) {
    echo json_encode(["success" => false, "message" => "No autenticado"]);
    exit;
}

$numeroControl = $_SESSION['numeroControl'];
$respuesta = [];

// 1. Solicitudes de cambio de horario
$stmt1 = $conn->prepare("SELECT motivo, estado FROM solicitud_cambio_horario WHERE noControl = ?");
$stmt1->bind_param("s", $numeroControl);
$stmt1->execute();
$res1 = $stmt1->get_result();
while ($row = $res1->fetch_assoc()) {
    $respuesta[] = [
        "tipo" => "Cambio de horario",
        "estado" => $row["estado"],
        "motivo" => $row["motivo"]
    ];
}

// 2. Materias de verano (corrección de la consulta)
$stmt2 = $conn->prepare("SELECT smv.materia, smv.estado FROM solicitud_materia_verano smv
    JOIN alumno_materia_solicitada ams ON smv.id = ams.id_solicitud
    WHERE ams.numeroControl = ?");
$stmt2->bind_param("s", $numeroControl);
$stmt2->execute();
$res2 = $stmt2->get_result();
while ($row = $res2->fetch_assoc()) {
    $respuesta[] = [
        "tipo" => "Materia de verano: " . $row["materia"],
        "estado" => $row["estado"],
        "motivo" => "-"
    ];
}

// 3. Citas canceladas
$stmt3 = $conn->prepare("SELECT c.fecha, c.hora, cc.motivo FROM cita c
    JOIN cancelar_cita cc ON c.id = cc.id_cita
    WHERE c.numeroControl = ? AND c.cancelada = 1");
$stmt3->bind_param("s", $numeroControl);
$stmt3->execute();
$res3 = $stmt3->get_result();
while ($row = $res3->fetch_assoc()) {
    $fechaHora = date("d/m/Y H:i", strtotime($row["fecha"] . " " . $row["hora"]));
    $respuesta[] = [
        "tipo" => "Cita cancelada ($fechaHora)",
        "estado" => "cancelada",
        "motivo" => $row["motivo"]
    ];
}

echo json_encode(["success" => true, "solicitudes" => $respuesta]);
?>
