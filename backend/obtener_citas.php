<?php
require_once 'conexion.php';

// Solo mostrar citas donde cancelada = 0
$sql = "SELECT c.id, u.nombre AS alumno, c.fecha, c.hora, c.asunto 
        FROM Cita c 
        INNER JOIN Usuario u ON c.numeroControl = u.numeroControl
        WHERE c.cancelada = 0";

$result = $conn->query($sql);

$citas = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

header('Content-Type: application/json');
echo json_encode($citas);

$conn->close();
?>
