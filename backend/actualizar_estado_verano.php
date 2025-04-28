<?php
include("conexion.php");

$id = $_POST['id'];
$estado = $_POST['estado'];

$query = "UPDATE Solicitud_Materia_Verano SET estado = ? WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("si", $estado, $id);

if ($stmt->execute()) {
    echo "Estado actualizado correctamente.";
} else {
    echo "Error al actualizar el estado.";
}

$stmt->close();
$conn->close();
?>
