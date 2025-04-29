let citas = [];

document.addEventListener("DOMContentLoaded", cargarCitas);

async function cargarCitas() {
    try {
        const res = await fetch("../../backend/obtener_citas_usuario.php");
        citas = await res.json();

        const tbody = document.getElementById("citas-body");
        tbody.innerHTML = "";

        if (citas.length === 0) {
            tbody.innerHTML = `<tr><td colspan="4">No tienes citas programadas.</td></tr>`;
            return;
        }

        citas.forEach((cita, index) => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td class="td-ud">${formatearFechaVista(cita.fecha)}</td>
                <td class="td-ud">${formatearHoraVista(cita.hora)}</td>
                <td class="td-ud">${cita.asunto}</td>
                <td class="td-ud">
                    <button class="btn-modificar" onclick="editarCita(${index})">Modificar</button>
                    <button class="btn-cancelar" onclick="cancelarCita(${index})">Cancelar</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    } catch (error) {
        console.error("Error al cargar citas:", error);
        alert("Error al obtener las citas.");
    }
}

function editarCita(index) {
    const tbody = document.getElementById("citas-body");
    const row = tbody.children[index];
    const cita = citas[index];
    row.innerHTML = `
        <td class="td-ud"><input type="date" value="${cita.fecha}"></td>
        <td class="td-ud"><input type="time" value="${cita.hora}"></td>
        <td class="td-ud"><input type="text" value="${cita.asunto}"></td>
        <td class="td-ud">
            <button class="btn-modificar" onclick="guardarCita(${index})">Guardar</button>
            <button class="btn-cancelar" onclick="cargarCitas()">Cancelar</button>
        </td>
    `;
}

async function guardarCita(index) {
    const row = document.getElementById("citas-body").children[index];
    const inputs = row.querySelectorAll("input");

    const formData = new FormData();
    formData.append("id", citas[index].id);
    formData.append("fecha", inputs[0].value);
    formData.append("hora", inputs[1].value);
    formData.append("asunto", inputs[2].value);

    try {
        const res = await fetch("../../backend/modificar_cita.php", {
            method: "POST",
            body: formData,
        });
        const data = await res.json();

        if (data.success) {
            alert("Cita modificada.");
            cargarCitas();
        } else {
            alert("Error al modificar: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Error al conectar con el servidor.");
    }
}

async function cancelarCita(index) {
    const motivo = prompt("¿Cuál es el motivo de la cancelación?");
    if (!motivo) return;

    const formData = new FormData();
    formData.append("id_cita", citas[index].id);
    formData.append("motivo", motivo);

    try {
        const res = await fetch("../../backend/cancelar_cita_alu.php", {
            method: "POST",
            body: formData,
        });
        const data = await res.json();

        if (data.success) {
            alert("Cita cancelada.");
            cargarCitas();
        } else {
            alert("Error al cancelar: " + data.message);
        }
    } catch (err) {
        console.error(err);
        alert("Error de conexión al cancelar.");
    }
}

function formatearFechaVista(fechaISO) {
    const [year, month, day] = fechaISO.split("-");
    return `${day}/${month}/${year}`;
}

function formatearHoraVista(hora24) {
    const [h, m] = hora24.split(":"), hNum = parseInt(h);
    const ampm = hNum >= 12 ? "PM" : "AM";
    const hora12 = hNum % 12 || 12;
    return `${hora12}:${m} ${ampm}`;
}
