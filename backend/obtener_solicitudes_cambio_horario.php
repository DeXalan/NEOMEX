<?php
require_once('conexion.php');

$respuesta = [];

$sql = "SELECT sh.id, sh.nombreAlumno, sh.noControl, sh.motivo, sh.estado, sh.imagen
        FROM solicitud_cambio_horario sh
        WHERE sh.estado = 'espera'"; // Puedes modificar la condición si necesitas filtrar por estado o alguna otra condición

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Obtener las materias de alta y baja asociadas a esta solicitud
    $id_sch = $row['id'];
    
    // Materias de alta
    $stmt_altas = $conn->prepare("SELECT nombre, codigo FROM materia_cambio_alta WHERE id_sch = ?");
    $stmt_altas->bind_param("i", $id_sch);
    $stmt_altas->execute();
    $result_altas = $stmt_altas->get_result();
    $altas = [];
    while ($materia = $result_altas->fetch_assoc()) {
        $altas[] = $materia['nombre'] . " - " . $materia['codigo'];
    }

    // Materias de baja
    $stmt_bajas = $conn->prepare("SELECT nombre, codigo FROM materia_cambio_baja WHERE id_sch = ?");
    $stmt_bajas->bind_param("i", $id_sch);
    $stmt_bajas->execute();
    $result_bajas = $stmt_bajas->get_result();
    $bajas = [];
    while ($materia = $result_bajas->fetch_assoc()) {
        $bajas[] = $materia['nombre'] . " - " . $materia['codigo'];
    }

    $respuesta[] = [
        'id_solicitud' => $row['id'],
        'nombreAlumno' => $row['nombreAlumno'],
        'noControl' => $row['noControl'],
        'motivo' => $row['motivo'],
        'estado' => $row['estado'],
        'altas' => $altas,
        'bajas' => $bajas,
        'imagen' => base64_encode($row['imagen']) // Imagen en formato base64
    ];
}

echo json_encode(["success" => true, "solicitudes" => $respuesta]);
?>
