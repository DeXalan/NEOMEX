<?php
require_once 'conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $numeroControl = $_POST['numeroControl'];
    $contraseña = $_POST['contraseña'];

    $sql = "SELECT id, nombre, contraseña, rol, numeroControl FROM Usuario WHERE numeroControl = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $numeroControl);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($contraseña, $row['contraseña'])) {
            session_start();
            $_SESSION['id'] = $row['id'];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['rol'] = $row['rol'];
            $_SESSION['numeroControl'] = $row['numeroControl'];
            // Redirige según el rol
            switch ($row['rol']) {
                case 'Alumno':
                    header("Location: ../public/menu-alu.php");
                    break;
                case 'Maestro':
                    header("Location: ../public/menu-maes.php");
                    break;
                case 'Coordinador':
                    header("Location: ../public/menu-coor.php");
                    break;
                default:
                    echo "Rol desconocido";
            }
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
    $stmt->close();
    $conn->close();
}
?>
