<?php
require_once "conexion.php";

if (isset($_POST['id_cita'], $_POST['motivo'])) {
    $id_cita = $_POST['id_cita'];
    $motivo = $_POST['motivo'];

    // Marcar cita como cancelada (por ejemplo, actualizar estado)
    $sql1 = "UPDATE cita SET estado = 'cancelada' WHERE id = ?";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->bind_param("i", $id_cita);
    $stmt1->execute();

    // Insertar motivo en tabla cancelar_cita
    $sql2 = "INSERT INTO cancelar_cita (motivo, id_cita) VALUES (?, ?)";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bind_param("si", $motivo, $id_cita);

    if ($stmt2->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo guardar el motivo."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Faltan datos."]);
}
?>
