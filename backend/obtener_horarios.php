<?php
require_once 'conexion.php';

$hoy = date('Y-m-d');
$sql = "SELECT fecha, horaInicio, horaFin FROM Horario_Coordinador WHERE fecha >= ? AND disponible = 0 ORDER BY fecha, horaInicio";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $hoy);
$stmt->execute();
$resultado = $stmt->get_result();

$horarios = [];
while ($fila = $resultado->fetch_assoc()) {
    $horarios[] = $fila;
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode($horarios);
?>
