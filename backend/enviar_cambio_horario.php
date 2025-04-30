<?php
include 'conexion.php'; // Asegúrate de que este archivo contiene tu conexión a MySQL

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Escapar datos del formulario
    $nombre = mysqli_real_escape_string($conn, $_POST['nombre']);
    $noControl = mysqli_real_escape_string($conn, $_POST['control']);
    $motivo = mysqli_real_escape_string($conn, $_POST['motivo']);

    // Manejar imagen
    if (isset($_FILES['horario_imagen']) && $_FILES['horario_imagen']['error'] === 0) {
        $imagen = addslashes(file_get_contents($_FILES['horario_imagen']['tmp_name']));
    } else {
        echo "Error al subir la imagen.";
        exit;
    }

    // Insertar solicitud
    $sql_sch = "INSERT INTO solicitud_cambio_horario (nombreAlumno, noControl, motivo, imagen)
                VALUES ('$nombre', '$noControl', '$motivo', '$imagen')";
    if (mysqli_query($conn, $sql_sch)) {
        $id_sch = mysqli_insert_id($conn); // ID de la solicitud recién insertada
    } else {
        echo "Error al guardar solicitud: " . mysqli_error($conn);
        exit;
    }

// Guardar materias a AGREGAR
foreach ($_POST as $key => $value) {
    if (strpos($key, 'materia_agregar_') === 0 && !empty($value)) {
        $num = str_replace('materia_agregar_', '', $key);
        $nombreMateria = mysqli_real_escape_string($conn, $value);
        $codigoMateria = mysqli_real_escape_string($conn, $_POST['codigo_agregar_' . $num]);

        $sql = "INSERT INTO materia_cambio_alta (codigo, nombre, id_sch, numeroControl)
                VALUES ('$codigoMateria', '$nombreMateria', $id_sch, '$noControl')";
        mysqli_query($conn, $sql);
    }
}

// Guardar materias a DAR DE BAJA
foreach ($_POST as $key => $value) {
    if (strpos($key, 'materia_baja_') === 0 && !empty($value)) {
        $num = str_replace('materia_baja_', '', $key);
        $nombreMateria = mysqli_real_escape_string($conn, $value);
        $codigoMateria = mysqli_real_escape_string($conn, $_POST['codigo_baja_' . $num]);

        $sql = "INSERT INTO materia_cambio_baja (codigo, nombre, id_sch, numeroControl)
                VALUES ('$codigoMateria', '$nombreMateria', $id_sch, '$noControl')";
        mysqli_query($conn, $sql);
    }
}


    echo "Solicitud enviada correctamente.";
} else {
    echo "Método no permitido.";
}
?>
