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
            // Mostrar/ocultar barra de búsqueda según la vista
            const searchContainer = document.getElementById('search-container');
            searchContainer.style.display = vista === 'pelis' ? 'block' : 'none';
            
            // Guardar los datos originales para la búsqueda
            window.originalData = data;
            
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
        botonCrearContenedor.innerHTML = `
            <button class='new' onclick="abrirModal('crear-peli')">Nueva Película</button>
            <button class='new' onclick="abrirModal('filtro-generos')" style="margin-left: 10px;">Filtrar por Géneros</button>
        `;
        
        tablaHeader.innerHTML = `
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Duración</th>
                <th>Géneros</th>
                <th>Portada</th>
                <th>Acciones</th>
            </tr>
        `;

        data.forEach(peli => {
            const generos = peli.nombres_generos || 'Sin géneros';
            
            tablaBody.innerHTML += `
                <tr>
                    <td>${peli.id_peli}</td>
                    <td>${peli.nom_peli}</td>
                    <td>${peli.descripcion}</td>
                    <td>${peli.duracion}</td>
                    <td>${generos}</td>
                    <td><img src="../IMG/pelis/${peli.portada}" width="50"></td>
                    <td>
                        <button class='btn' onclick='cargarDatosEditarPeli(${JSON.stringify(peli).replace(/'/g, "&#39;")})'>Editar</button>
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
function cargarDatosEditarPeli(peli) {
    document.getElementById('id-editar-peli').value = peli.id_peli;
    document.getElementById('nombre-editar-peli').value = peli.nom_peli;
    document.getElementById('descripcion-editar-peli').value = peli.descripcion;
    document.getElementById('duracion-editar-peli').value = peli.duracion;

    // Limpiar todos los checkboxes primero
    const checkboxes = document.querySelectorAll('input[name="generos[]"]');
    checkboxes.forEach(checkbox => checkbox.checked = false);

    // Marcar los géneros que tiene la película
    if (peli.ids_generos) {
        const generosArray = peli.ids_generos.split(',');
        generosArray.forEach(generoId => {
            const checkbox = document.getElementById(`genero-editar-${generoId}`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }

    abrirModal('editar-peli');
}

// Función para cargar datos en el modal de eliminar película
function cargarDatosEliminarPeli(id) {
    document.getElementById('id-eliminar-peli').value = id;
    abrirModal('eliminar-peli');
}

// CREAR USUARIO
document.getElementById('form-crear-usuario').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    fetch('../PHP/admin/CrearU.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Usuario creado exitosamente');
            cerrarModal('crear-usuario');
            cargarDatos('usuarios');
            this.reset();
        }
    })
    .catch(error => console.error('Error al crear usuario:', error));
});

// EDITAR USUARIO
document.getElementById('form-editar-usuario').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    fetch('../PHP/admin/EditarU.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Usuario actualizado exitosamente');
            cerrarModal('editar-usuario');
            cargarDatos('usuarios');
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
            body: JSON.stringify({ id_usr: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert('Usuario eliminado exitosamente');
                cargarDatos('usuarios');
            }
        })
        .catch(error => console.error('Error al eliminar usuario:', error));
    }
}

// CREAR PELÍCULA
document.getElementById('form-crear-peli').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    
    // Obtener los géneros seleccionados
    const generosSeleccionados = [];
    this.querySelectorAll('input[name="generos[]"]:checked').forEach(checkbox => {
        generosSeleccionados.push(checkbox.value);
    });

    if (generosSeleccionados.length === 0) {
        alert('Por favor, seleccione al menos un género');
        return;
    }

    // Agregar los géneros al FormData
    formData.delete('generos[]'); // Eliminar los datos anteriores
    generosSeleccionados.forEach(genero => {
        formData.append('generos[]', genero);
    });

    fetch('../PHP/admin/CrearP.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Película creada exitosamente');
            cerrarModal('crear-peli');
            cargarDatos('pelis');
            this.reset();
            // Desmarcar todos los checkboxes
            this.querySelectorAll('input[name="generos[]"]').forEach(checkbox => {
                checkbox.checked = false;
            });
        }
    })
    .catch(error => console.error('Error al crear película:', error));
});

// EDITAR PELÍCULA
document.getElementById('form-editar-peli').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);
    
    // Obtener los géneros seleccionados
    const generosSeleccionados = [];
    this.querySelectorAll('input[name="generos[]"]:checked').forEach(checkbox => {
        generosSeleccionados.push(checkbox.value);
    });

    if (generosSeleccionados.length === 0) {
        alert('Por favor, seleccione al menos un género');
        return;
    }

    // Agregar los géneros al FormData
    formData.delete('generos[]'); // Eliminar los datos anteriores
    generosSeleccionados.forEach(genero => {
        formData.append('generos[]', genero);
    });

    fetch('../PHP/admin/EditarP.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.error) {
            alert(data.error);
        } else {
            alert('Película actualizada exitosamente');
            cerrarModal('editar-peli');
            cargarDatos('pelis');
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
            body: JSON.stringify({ id_peli: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert(data.error);
            } else {
                alert('Película eliminada exitosamente');
                cargarDatos('pelis');
            }
        })
        .catch(error => console.error('Error al eliminar película:', error));
    }
}

// Agregar evento de búsqueda dinámica
document.getElementById('search-peli').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const filteredData = window.originalData.filter(peli => 
        peli.nom_peli.toLowerCase().includes(searchTerm)
    );
    actualizarTabla('pelis', filteredData);
});

// Función para aplicar filtro de géneros
function aplicarFiltroGeneros() {
    const generosSeleccionados = Array.from(document.querySelectorAll('input[name="filtro-generos[]"]:checked'))
        .map(checkbox => checkbox.value);

    if (generosSeleccionados.length === 0) {
        actualizarTabla('pelis', window.originalData);
        cerrarModal('filtro-generos');
        return;
    }

    const filteredData = window.originalData.filter(peli => {
        if (!peli.ids_generos) return false;
        const generosPeli = peli.ids_generos.split(',');
        return generosSeleccionados.every(genero => generosPeli.includes(genero));
    });

    actualizarTabla('pelis', filteredData);
    cerrarModal('filtro-generos');
}

// FETCH
