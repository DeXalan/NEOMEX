<?php include("../../backend/Verificar_alumno.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Materia de Verano</title>
    <link rel="stylesheet" href="estilooo.css">
</head>
<body>
    <div class="header-c">
        <button class="logout-button" onclick="volver()">🡸</button>
        <h1>Solicitud de Materia de Verano</h1>
        <button class="logout-button" onclick="cerrarSesion()">Cerrar Sesión</button>
    </div>

    <div class="container">
        <h2>Complete los datos</h2>
        <form id="form-solicitud" onsubmit="enviarSolicitud(event)">
            <label for="numeroControl">Número de Control:</label>
            <input type="text" id="numeroControl" name="numeroControl" required>

            <label for="nombre">Nombre Completo:</label>
            <input type="text" id="nombre" name="nombre" required>

            <label for="materia">Materia a Solicitar:</label>
            <select id="materia" name="materia" required>
                <option value="" disabled selected>Seleccione una materia</option>
                <option value="AC. CUL DEP II">AC. CUL DEP II</option>
                <option value="AC. CUL. DEP I">AC. CUL. DEP I</option>
                <option value="ADMINISTRACION DE REDES">ADMINISTRACION DE REDES</option>
                <option value="ADMON BAS. DATO">ADMON BAS. DATO</option>
                <option value="ALGE. LINE.">ALGE. LINE.</option>
                <option value="ARQ. DE COMP">ARQ. DE COMP</option>
                <option value="ARQUITECTURA Y DISEÑO">ARQUITECTURA Y DISEÑO</option>
                <option value="CALC. DIF.">CALC. DIF.</option>
                <option value="CALC. INTEG.">CALC. INTEG.</option>
                <option value="CALC. VECT.">CALC. VECT.</option>
                <option value="CONMUTACION Y ENRUTAMIENTO">CONMUTACION Y ENRUTAMIENTO</option>
                <option value="CONTA. FINAN.">CONTA. FINAN.</option>
                <option value="CULT. EMPRES.">CULT. EMPRES.</option>
                <option value="DES. SUST.">DES. SUST.</option>
                <option value="ECUA DIFEREN">ECUA DIFEREN</option>
                <option value="ESTRUC. DATOS">ESTRUC. DATOS</option>
                <option value="FISICA GRAL.">FISICA GRAL.</option>
                <option value="FUND ING SOFTWA">FUND ING SOFTWA</option>
                <option value="FUND. BASES DAT">FUND. BASES DAT</option>
                <option value="FUND. INV.">FUND. INV.</option>
                <option value="FUND. PROGR.">FUND. PROGR.</option>
                <option value="FUND. TELECOMUN">FUND. TELECOMUN</option>
                <option value="GRAFICACION">GRAFICACION</option>
                <option value="GEST PROY SOFTW">GEST PROY SOFTW</option>
                <option value="ING. SOFTWARE">ING. SOFTWARE</option>
                <option value="INGLES 1">INGLES 1</option>
                <option value="INGLES 2">INGLES 2</option>
                <option value="INGLES 3">INGLES 3</option>
                <option value="INGLES 4">INGLES 4</option>
                <option value="INGLES 5">INGLES 5</option>
                <option value="INGLES 6">INGLES 6</option>
                <option value="INTELIGENCIA ARTIFICIAL">INTELIGENCIA ARTIFICIAL</option>
                <option value="INVS. DE OPER.">INVS. DE OPER.</option>
                <option value="LENG.AUTOMATS I">LENG.AUTOMATS I</option>
                <option value="LENG. AUTO. II">LENG. AUTO. II</option>
                <option value="LENGUAJES DE INTERFAZ">LENGUAJES DE INTERFAZ</option>
                <option value="MAT. DISCRETAS">MAT. DISCRETAS</option>
                <option value="METOD. NUMER.">METOD. NUMER.</option>
                <option value="MODELO DE DESARROLLO (CMMI)">MODELO DE DESARROLLO (CMMI)</option>
                <option value="PRIN ELEC Y APL">PRIN ELEC Y APL</option>
                <option value="PROB. Y ESTD.">PROB. Y ESTD.</option>
                <option value="PROCESO PERSONAL">PROCESO PERSONAL</option>
                <option value="PROGRAMACION DE MOVILES">PROGRAMACION DE MOVILES</option>
                <option value="PROG LOG FUNC">PROG LOG FUNC</option>
                <option value="PROG ORIEN OBJE">PROG ORIEN OBJE</option>
                <option value="PROG. WEB">PROG. WEB</option>
                <option value="QUIM. GRAL.">QUIM. GRAL.</option>
                <option value="REDES COMPU">REDES COMPU</option>
                <option value="SIST. OPERT">SIST. OPERT</option>
                <option value="SIST.  PROGRA">SIST.  PROGRA</option>
                <option value="SIMULACION">SIMULACION</option>
                <option value="TALL BASE DATOS">TALL BASE DATOS</option>
                <option value="TALL. DE ADM.">TALL. DE ADM.</option>
                <option value="TALL. DE ET.">TALL. DE ET.</option>
                <option value="TALLER DE INVESTIGACION II">TALLER DE INVESTIGACION II</option>
                <option value="TALLER SIS OPER">TALLER SIS OPER</option>
                <option value="TOP AVAN PROG">TOP AVAN PROG</option>
                <option value="TUTORIAS I">TUTORIAS I</option>
                <option value="TUTORIAS II">TUTORIAS II</option>
                <option value="TUTORIAS III">TUTORIAS III</option>
                <option value="VERIFICACION Y VALIDACION">VERIFICACION Y VALIDACION</option>
            </select>
            

            <button type="submit" class="button-b">Enviar Solicitud</button>
        </form>

        <div id="mensaje-confirmacion" class="mensaje-confirmacion" style="display: none;">
            ✅ Solicitud enviada correctamente.
        </div>
    </div>

    <script>
        function volver(){
            window.location.href="../menu-alu.html";
        }
        
        function cerrarSesion() {
            window.location.href = "../login.html";
        }

        function enviarSolicitud(event) {
            event.preventDefault();

            // Obtener los datos del formulario
            let numeroControl = document.getElementById("numeroControl").value;
            let nombre = document.getElementById("nombre").value;
            let materia = document.getElementById("materia").value;

            if (numeroControl && nombre && materia) {
                // Mostrar mensaje de confirmación
                document.getElementById("mensaje-confirmacion").style.display = "block";
                
                // Limpiar formulario después de enviar
                document.getElementById("form-solicitud").reset();

                // Simulación de envío a la base de datos (puedes modificarlo según tu backend)
                console.log(`Solicitud enviada: ${numeroControl} - ${nombre} - ${materia}`);
            } else {
                alert("⚠️ Por favor, complete todos los campos.");
            }
        }
        function enviarSolicitud(event) {
    event.preventDefault();

    let numeroControl = document.getElementById("numeroControl").value;
    let nombre = document.getElementById("nombre").value;
    let materia = document.getElementById("materia").value;

    if (numeroControl && nombre && materia) {
        fetch("../../backend/procesar_solicitud.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `numeroControl=${encodeURIComponent(numeroControl)}&nombre=${encodeURIComponent(nombre)}&materia=${encodeURIComponent(materia)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                document.getElementById("mensaje-confirmacion").style.display = "block";
                document.getElementById("form-solicitud").reset();
            } else {
                alert(data.mensaje);
            }
        })
        .catch(error => {
            console.error("Error:", error);
            alert("❌ Error al enviar la solicitud.");
        });
    } else {
        alert("⚠️ Por favor, complete todos los campos.");
    }
}

    </script>
</body>
</html>
