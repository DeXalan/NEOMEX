<?php
include 'conexion.php'; // Asegúrate que este archivo tiene la conexión $conn

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $numeroControl = $_POST['numeroControl'];
    $nombre = $_POST['nombre'];
    $materia = $_POST['materia'];
    $periodo = "Verano " . date("Y");

    // Verificar si ya solicitó esa materia
    $sql_verificar = "SELECT smv.id FROM solicitud_materia_verano smv 
                      INNER JOIN alumno_materia_solicitada ams 
                      ON smv.id = ams.id_solicitud
                      WHERE ams.numeroControl = ? AND smv.materia = ? AND smv.periodo = ?";
    $stmt = $conn->prepare($sql_verificar);
    $stmt->bind_param("sss", $numeroControl, $materia, $periodo);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        echo json_encode(["status" => "error", "mensaje" => "⚠️ Ya has solicitado esta materia."]);
        exit;
    }

    // Verificar si la materia ya existe en ese periodo
    $sql_buscar = "SELECT id, numSolicitudes FROM solicitud_materia_verano WHERE materia = ? AND periodo = ?";
    $stmt = $conn->prepare($sql_buscar);
    $stmt->bind_param("ss", $materia, $periodo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        // Ya existe, incrementar solicitudes
        $id_materia = $row['id'];
        $sql_update = "UPDATE solicitud_materia_verano SET numSolicitudes = numSolicitudes + 1 WHERE id = ?";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bind_param("i", $id_materia);
        $stmt_update->execute();
    } else {
        // Nueva materia para ese periodo
        $sql_insert = "INSERT INTO solicitud_materia_verano (materia, numSolicitudes, periodo) VALUES (?, 1, ?)";
        $stmt_insert = $conn->prepare($sql_insert);
        $stmt_insert->bind_param("ss", $materia, $periodo);
        $stmt_insert->execute();
        $id_materia = $stmt_insert->insert_id;
    }

    // Insertar en alumno_materia_solicitada
    $sql_relacion = "INSERT INTO alumno_materia_solicitada (numeroControl, id_solicitud) VALUES (?, ?)";
    $stmt_relacion = $conn->prepare($sql_relacion);
    $stmt_relacion->bind_param("si", $numeroControl, $id_materia);
    $stmt_relacion->execute();

    echo json_encode(["status" => "success", "mensaje" => "✅ Solicitud enviada correctamente."]);
}
?>
