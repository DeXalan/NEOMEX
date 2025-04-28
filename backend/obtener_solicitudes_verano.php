<?php
include("conexion.php");

$query = "SELECT * FROM Solicitud_Materia_Verano";
$result = mysqli_query($conn, $query);

$solicitudes = [];

while ($row = mysqli_fetch_assoc($result)) {
    $solicitudes[] = $row;
}

echo json_encode($solicitudes);
?>
