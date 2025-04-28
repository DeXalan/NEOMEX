<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $horaInicio = $_POST['horaInicio'];
    $horaFin = $_POST['horaFin'];
    $todoElDia = isset($_POST['todoElDia']) ? 1 : 0;

    if ($todoElDia) {
        $horaInicio = '09:00:00';
        $horaFin = '19:00:00';
    }

    $sql = "INSERT INTO Horario_Coordinador (fecha, horaInicio, horaFin, disponible) VALUES (?, ?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $fecha, $horaInicio, $horaFin);

    if ($stmt->execute()) {
        echo "Horario registrado correctamente";
    } else {
        echo "Error al registrar horario: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
