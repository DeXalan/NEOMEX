<?php
require_once "conexion.php";

if (isset($_POST['id'], $_POST['fecha'], $_POST['hora'], $_POST['asunto'])) {
    $id = $_POST['id'];
    $fecha = $_POST['fecha'];
    $hora = $_POST['hora'];
    $asunto = $_POST['asunto'];

    $sql = "UPDATE cita SET fecha = ?, hora = ?, asunto = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $fecha, $hora, $asunto, $id);

    if ($stmt->execute()) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "No se pudo modificar."]);
    }
} else {
    echo json_encode(["success" => false, "message" => "Datos incompletos."]);
}
?>
