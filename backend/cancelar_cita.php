<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cita = $_POST['id_cita'];
    $motivo = $_POST['motivo'];

    // Primero, marcar la cita como cancelada
    $update = $conn->prepare("UPDATE Cita SET cancelada = TRUE WHERE id = ?");
    $update->bind_param("i", $id_cita);
    $update->execute();

    // Luego, guardar el motivo en la tabla Cancelar_Cita
    $insert = $conn->prepare("INSERT INTO Cancelar_Cita (id_cita, motivo) VALUES (?, ?)");
    $insert->bind_param("is", $id_cita, $motivo);
    $insert->execute();

    echo "Cita cancelada correctamente.";
}
?>
