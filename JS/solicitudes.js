document.addEventListener("DOMContentLoaded", () => {
    cargarSolicitudes();
});

function cargarSolicitudes() {
    fetch('../PHP/admin/solicitud.php')
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            actualizarTabla(data);
        })
        .catch(error => console.error("Error al obtener solicitudes:", error));
}

function actualizarTabla(data) {
    const tablaBody = document.getElementById("tabla-solicitudes");
    tablaBody.innerHTML = "";

    data.forEach(user => {
        tablaBody.innerHTML += `
            <tr>
                <td>${user.id_usr}</td>
                <td>${user.nombre_usr}</td>
                <td>${user.apellido_usr}</td>
                <td>${user.username}</td>
                <td>${user.email}</td>
                <td>${user.genero_usr}</td>
                <td>${user.fecha_nac}</td>
                <td>
                    <button class='btn' onclick="aceptarUsuario(${user.id_usr})">Aceptar</button>
                </td>
            </tr>
        `;
    });
}

function aceptarUsuario(id) {
    if (confirm('¿Estás seguro de que deseas aceptar este usuario?')) {
        fetch('../PHP/admin/solicitud.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ 
                id_usr: id,
                action: 'accept'
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert('Usuario aceptado exitosamente');
                cargarSolicitudes(); // Recargar la tabla
            }
        })
        .catch(error => console.error('Error al aceptar usuario:', error));
    }
} 