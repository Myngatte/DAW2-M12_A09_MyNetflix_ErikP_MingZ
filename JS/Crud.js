// ------------------------------------------------------------MOSTRAR DATOS 
document.addEventListener("DOMContentLoaded", () => {
    cargarDatos("usuarios"); //cargar usuarios por defecto
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
    const botonCrear = document.getElementById("boton-crear");
    const botonCrearContenedor = document.getElementById("boton-crear-contenedor");

    tablaHeader.innerHTML = "";
    tablaBody.innerHTML = "";

    // Usuarios
    if (vista === "usuarios") {
        titulo.textContent = "Administración de Usuarios";
        botonCrearContenedor.innerHTML = `<button class='new' onclick="abrirModal('crear-usuario')">Nuevo Usuario</button>`;
        tablaHeader.innerHTML = `
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Username</th>
                <th>Correo Electrónico</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
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
                    <td>${user.email}</td> 
                    <td>${user.genero_usr}</td> 
                    <td>${user.fecha_nac}</td> 
                    <td>${user.nom_rol}</td>
                    <td>
                        <button class='btn' onclick="cargarDatosEditarUsuario('${user.id_usr}', '${user.nombre_usr}', '${user.apellido_usr}', '${user.username}', '${user.email}', '${user.genero_usr}', '${user.fecha_nac}', '${user.nom_rol}')">Editar</button>
                        <button class='btn-delete' onclick="cargarDatosEliminarUsuario('${user.id_usr}')">Eliminar</button>
                    </td>
                </tr>
            `;
        });
    


        // Pelis
    } else if (vista === "pelis") {
        titulo.textContent = "Administración de Películas";
        botonCrearContenedor.innerHTML = `<button class='new' onclick="abrirModal('crear-peli')">Nueva Película</button>`;
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
                    <td><img src="../IMG/pelis/${peli.portada}" width="50"></td>
                    <td>
                        <button class='btn' onclick="cargarDatosEditarPeli('${peli.id_peli}', '${peli.nom_peli}', '${peli.descripcion}', '${peli.duracion}')">Editar</button>
                        <button class='btn-delete' onclick="cargarDatosEliminarPeli('${peli.id_peli}')">Eliminar</button>
                    </td>
                </tr>
            `;
        });
    }
}

// ------------------------------------------------------------modales users
// Función para abrir modales
function abrirModal(modalId) {
    const modal = document.getElementById(`modal-${modalId}`);
    if (modal) {
        modal.style.display = "block";
    }
}

// Función para cerrar modales
function cerrarModal(modalId) {
    const modal = document.getElementById(`modal-${modalId}`);
    if (modal) {
        modal.style.display = "none";
    }
}

// Función para cargar datos en el modal de editar
function cargarDatosEditarUsuario(id, nombre, apellido, username, email, genero_usr, fecha_nac) {
    document.getElementById('id-editar').value = id;
    document.getElementById('nombre-editar').value = nombre;
    document.getElementById('apellido-editar').value = apellido;
    document.getElementById('username-editar').value = username;
    document.getElementById('email-editar').value = email; 
    document.getElementById('fecha_nacimiento-editar').value = fecha_nac;  

    // Establecer el valor del género en el select
    const generoSelect = document.getElementById('genero-editar');
    if (genero_usr === 'Masculino') {
        generoSelect.value = 'masculino';
    } else if (genero_usr === 'femenino') {
        generoSelect.value = 'Femenino';
    } else {
        generoSelect.value = '';  // Dejarlo vacío si no hay valor
    }

    abrirModal('editar-usuario');
}

// Función para cargar datos en el modal de eliminar
function cargarDatosEliminarUsuario(id) {
    document.getElementById('id-eliminar').value = id;
    abrirModal('eliminar-usuario');
}

// ------------------------------------------------------------Modales pelis
// Función para cargar datos en el modal de editar película
function cargarDatosEditarPeli(id, nombre, descripcion, duracion) {
    document.getElementById('id-editar-peli').value = id;
    document.getElementById('nombre-editar-peli').value = nombre;
    document.getElementById('descripcion-editar-peli').value = descripcion;
    document.getElementById('duracion-editar-peli').value = duracion;
    abrirModal('editar-peli');
}

// Función para cargar datos en el modal de eliminar película
function cargarDatosEliminarPeli(id) {
    document.getElementById('id-eliminar-peli').value = id;
    abrirModal('eliminar-peli');
}

// FETCH

// CREAR USUARIO
document.getElementById('form-crear-usuario').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar que se recargue la página al enviar el formulario

    const formData = new FormData(this); // Obtener los datos del formulario
    fetch('../PHP/admin/CrearU.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Usuario creado exitosamente');
            cerrarModal('crear-usuario'); // Cerrar el modal después de crear el usuario
            cargarDatos('usuarios'); // Actualizar la tabla de usuarios
        }
    })
    .catch(error => console.error('Error al crear usuario:', error));
});

 
// Editar usuario
document.getElementById('form-editar-usuario').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this); // Obtener los datos del formulario
        fetch('../PHP/admin/EditarU.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Usuario actualizado exitosamente');
            cerrarModal('editar-usuario'); // Cerrar el modal después de actualizar
            cargarDatos('usuarios'); // Actualizar la tabla de usuarios
        }
    })
    .catch(error => console.error('Error al editar usuario:', error));
});


// ELIMINAR USUARIO
function cargarDatosEliminarUsuario(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        fetch('../PHP/admin/EliminarU.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_usr: id }), // Enviar el ID del usuario
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert('Usuario eliminado exitosamente');
                cargarDatos('usuarios'); // Actualizar la tabla de usuarios
            }
        })
        .catch(error => console.error('Error al eliminar usuario:', error));
    }
}


// CREAR PELÍCULA
document.getElementById('form-crear-peli').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this); // Obtener los datos del formulario
    fetch('../PHP/admin/CrearP.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Película creada exitosamente');
            cerrarModal('crear-peli'); // Cerrar el modal después de crear la película
            cargarDatos('pelis'); // Actualizar la tabla de películas
        }
    })
    .catch(error => console.error('Error al crear película:', error));
});



// EDITAR PELÍCULA
document.getElementById('form-editar-peli').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this); // Obtener los datos del formulario
    fetch('../PHP/admin/EditarP.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Película actualizada exitosamente');
            cerrarModal('editar-peli'); // Cerrar el modal después de editar
            cargarDatos('pelis'); // Actualizar la tabla de películas
        }
    })
    .catch(error => console.error('Error al editar película:', error));
});


// ELIMINAR PELÍCULA
function cargarDatosEliminarPeli(id) {
    if (confirm('¿Estás seguro de que deseas eliminar esta película?')) {
        fetch('../PHP/admin/EliminarP.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_peli: id }), // Enviar el ID de la película
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert('Película eliminada exitosamente');
                cargarDatos('pelis'); // Actualizar la tabla de películas
            }
        })
        .catch(error => console.error('Error al eliminar película:', error));
    }
}



// -------------------------------------------------------------
