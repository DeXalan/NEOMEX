<?php include("../../backend/Verificar_maestro.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Citas</title>
    <link rel="stylesheet" href="estilo.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="header-c">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Solicitar Cita</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>
    <div class="cita-container">
        <h2>Solicita</h2>
        <form id="form_cita" class="form_cita">
        <label for="nombre">Nombre:</label>
            <input class="input-c" type="text" id="nombre" name="nombre" value="<?php echo htmlspecialchars($nombre); ?>" readonly required>

            <label for="num_control">Número de Control:</label>
            <input class="input-c" type="text" id="num_control" name="num_control" value="<?php echo htmlspecialchars($numeroControl); ?>" readonly required>
      
          <label for="fecha">Fecha:</label>
          <input class="input-c" type="date" id="fecha" name="fecha" required>
      
          <label for="hora">Hora:</label>
          <input class="input-c" type="time" id="hora" name="hora" required>
      
          <label for="asunto">Asunto:</label>
          <textarea class="input-c" id="asunto" name="asunto" rows="3" required></textarea>
      
          <button type="submit" class="button_cita">Solicitar Cita</button>
        </form>

        <script src="../../js/citas_maes.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const fechaInput = document.getElementById('fecha');
                const hoy = new Date().toISOString().split('T')[0];
                fechaInput.min = hoy;
            });
            function volver(){
                window.location.href="../menu-maes.php";
            }
            function cerrarSesion() {
                window.location.href = "../login.html";
            }
        </script>
      </div>

</body>
</html>