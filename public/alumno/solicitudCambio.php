<?php include("../../backend/Verificar_alumno.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitud de Cambio de Horario</title>
    <link rel="stylesheet" href="estilooo.css">
</head>
<body class="body-ok">
    <div class="header-c">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Solicitud de Cambio de Horario</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>

    <div class="container">
        <h2>Complete los datos</h2>
        <!-- AÑADIDO: enctype para soportar archivos -->
        <form id="solicitud-form" enctype="multipart/form-data" method="POST" action="../../backend/enviar_cambio_horario.php">
            <label for="control">Número de Control:</label>
            <input type="text" id="control" name="control" value="<?php echo $numeroControl; ?>" readonly>

            <label for="nombre">Nombre del Alumno:</label>
            <input type="text" id="nombre" name="nombre" required>

            <div class="buttons-container">
                <button type="button" id="add-materia-agregar">+ Agregar Materia</button>
                <button type="button" id="add-materia-baja">+ Dar de Baja Materia</button>
            </div>

            <div id="materias-agregar"></div>
            <div id="materias-baja"></div>

            <label for="motivo">Motivo:</label>
            <textarea id="motivo" name="motivo" required></textarea>

            <!-- NUEVO: campo para subir imagen -->
            <label for="horario_imagen">Adjuntar imagen del horario (JPG, PNG):</label>
            <input type="file" id="horario_imagen" name="horario_imagen" accept="image/*" required>

            <button class="button-b" type="submit">Enviar Solicitud</button>
        </form>
    </div>

    <script>
        function volver(){
            window.location.href="../menu-alu.php";
        }
        function cerrarSesion() {
            window.location.href = "../login.html";
        }

        let contadorAgregar = 0;
        let contadorBaja = 0;

        document.getElementById("add-materia-agregar").addEventListener("click", function () {
            contadorAgregar++;
            let div = document.createElement("div");
            div.classList.add("materia-group");
            div.innerHTML = `
                <label>Código de Materia a Agregar:</label>
                <input type="text" name="codigo_agregar_${contadorAgregar}"> <br>
                <label>Nombre de la Materia a Agregar:</label>
                <input type="text" name="materia_agregar_${contadorAgregar}"> <br>
                <button type="button" class="remove-btn">Eliminar</button>
            `;
            div.querySelector(".remove-btn").addEventListener("click", function () {
                div.remove();
            });
            document.getElementById("materias-agregar").appendChild(div);
        });

        document.getElementById("add-materia-baja").addEventListener("click", function () {
            contadorBaja++;
            let div = document.createElement("div");
            div.classList.add("materia-group");
            div.innerHTML = `
                <label>Código de Materia a Dar de Baja:</label>
                <input type="text" name="codigo_baja_${contadorBaja}"> <br>
                <label>Nombre de la Materia a Dar de Baja:</label>
                <input type="text" name="materia_baja_${contadorBaja}"> <br>
                <button type="button" class="remove-btn">Eliminar</button>
            `;
            div.querySelector(".remove-btn").addEventListener("click", function () {
                div.remove();
            });
            document.getElementById("materias-baja").appendChild(div);
        });
    </script>
</body>
</html>
