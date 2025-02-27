document.addEventListener("DOMContentLoaded", () => {
    cargarDatos("usuarios"); // Cargar usuarios por defecto
});

function cargarDatos(vista) {
    fetch(`../PHP/admin/mostrar.php?vista=${vista}`)
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
                return;
            }
            actualizarTabla(vista, data);
        })
        .catch(error => console.error("Error al obtener datos:", error));
}

function actualizarTabla(vista, data) {
    const tablaHeader = document.getElementById("tabla-header");
    const tablaBody = document.getElementById("tabla-body");
    const titulo = document.getElementById("titulo");

    tablaHeader.innerHTML = "";
    tablaBody.innerHTML = "";

    if (vista === "usuarios") {
        titulo.textContent = "Gestión de Usuarios";
        tablaHeader.innerHTML = `
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Username</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        `;

        data.forEach(user => {
            tablaBody.innerHTML += `
                <tr>
                    <td>${user.id_usr}</td>
                    <td>${user.nombre_usr}</td>
                    <td>${user.apellido_usr}</td>
                    <td>${user.username}</td>
                    <td>${user.nom_rol}</td>
                    <td>
                        <a href='./edit_user.php?id=${user.id_usr}'><button class='btn'>Editar</button></a>
                        <a href='../../Procesos/delete_user.php?id=${user.id_usr}'><button class='btn-delete'>Eliminar</button></a>
                    </td>
                </tr>
            `;
        });

    } else if (vista === "pelis") {
        titulo.textContent = "Gestión de Películas";
        tablaHeader.innerHTML = `
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Duración</th>
                <th>Portada</th>
                <th>Acciones</th>
            </tr>
        `;

        data.forEach(peli => {
            tablaBody.innerHTML += `
                <tr>
                    <td>${peli.id_peli}</td>
                    <td>${peli.nom_peli}</td>
                    <td>${peli.descripcion}</td>
                    <td>${peli.duracion}</td>
                    <td><img src="${peli.portada}" width="50"></td>
                    <td>
                        <a href='./edit_peli.php?id=${peli.id_peli}'><button class='btn'>Editar</button></a>
                        <a href='../../Procesos/delete_peli.php?id=${peli.id_peli}'><button class='btn-delete'>Eliminar</button></a>
                    </td>
                </tr>
            `;
        });
    }
}
