function cargarSolicitudes() {
    const lista = document.getElementById("solicitudes-list");
    lista.innerHTML = "";

    fetch("obtener_solicitudes.php")
        .then(response => response.json())
        .then(solicitudes => {
            solicitudes.forEach((solicitud) => {
                if (solicitud.estado === "espera") {
                    let div = document.createElement("div");
                    div.classList.add("solicitud-card");
                    div.innerHTML = `
                        <p><strong>Número de Control:</strong> ${solicitud.noControl}</p>
                        <p><strong>Nombre:</strong> ${solicitud.nombreAlumno}</p>
                        ${solicitud.materiaAgregar ? `<p><strong>Materia a Agregar:</strong> ${solicitud.materiaAgregar}</p>` : ""}
                        ${solicitud.materiaEliminar ? `<p><strong>Materia a Eliminar:</strong> ${solicitud.materiaEliminar}</p>` : ""}
                        <p><strong>Motivo:</strong> ${solicitud.motivo}</p>

                        <div class="action-buttons">
                            <button class="confirmar-btn" onclick="confirmarSolicitud(${solicitud.id})">Confirmar</button>
                            <button class="rechazar-btn" onclick="rechazarSolicitud(${solicitud.id})">Cancelar</button>
                        </div>
                    `;
                    lista.appendChild(div);
                }
            });
        })
        .catch(error => {
            console.error("Error al cargar las solicitudes:", error);
        });
}

// Función para confirmar una solicitud (actualizar su estado a "aceptada")
function confirmarSolicitud(id) {
    alert(`Solicitud #${id} confirmada.`);
    // Llamar a la función para actualizar el estado de la solicitud a 'aceptada'
    actualizarEstado(id, 'aceptada');
}

// Función para rechazar una solicitud (actualizar su estado a "cancelada")
function rechazarSolicitud(id) {
    alert(`Solicitud #${id} cancelada.`);
    // Llamar a la función para actualizar el estado de la solicitud a 'cancelada'
    actualizarEstado(id, 'cancelada');
}

// Función para actualizar el estado de la solicitud en la base de datos
function actualizarEstado(id, estado) {
    // Realizamos una petición POST al backend para actualizar el estado de la solicitud
    fetch("actualizar_solicitud.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `id_solicitud=${id}&estado=${estado}`
    }).then(response => response.text())
      .then(data => {
          console.log(data);
          cargarSolicitudes(); // Recargar la lista de solicitudes
      });
}

// Cargar las solicitudes cuando se cargue el contenido de la página
document.addEventListener("DOMContentLoaded", cargarSolicitudes);
