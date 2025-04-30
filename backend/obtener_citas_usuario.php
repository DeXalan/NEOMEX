<?php
session_start();
require_once "conexion.php";

$id_usuario = $_SESSION['numeroControl'];

$sql = "SELECT id, fecha, hora, asunto FROM cita WHERE numeroControl = ? AND cancelada = 0";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

$citas = [];
while ($row = $result->fetch_assoc()) {
    $citas[] = $row;
}

echo json_encode($citas);
?>
