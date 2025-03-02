<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <a href='../PHP/destroy_session.php'><button class='logout'>Cerrar Sesión</button></a>

    <h2 id="titulo">Administración de Usuarios</h2>
    <div id="boton-crear-contenedor">
        <button class='new' id="boton-crear" onclick="abrirModal('crear-usuario')">Nuevo Usuario</button>
    </div>

    <div class="botones">
        <button onclick="cargarDatos('usuarios')">Usuarios</button>
        <button onclick="cargarDatos('pelis')">Películas</button>
    </div>

    <table>
        <thead id="tabla-header"></thead>
        <tbody id="tabla-body"></tbody>
    </table>

    <!-- Modal para Crear Usuario -->
    <div id="modal-crear-usuario" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('crear-usuario')">&times;</span>
            <h2>Crear Usuario</h2>
            <form id="form-crear-usuario">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" >

                <label for="apellido">Apellido:</label>
                <input type="text" id="apellido" name="apellido" >

                <label for="username">Username:</label>
                <input type="text" id="username" name="username">

                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" >

                <label for="genero">Género:</label>
                <select id="genero" name="genero" >
                    <option value="">Seleccione</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>

                <label for="fecha_nacimiento">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" >

                <button type="submit">Crear</button>
            </form>
        </div>
    </div>


    <!-- Modal para Editar Usuario -->
    <div id="modal-editar-usuario" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('editar-usuario')">&times;</span>
            <h2>Editar Usuario</h2>
            <form id="form-editar-usuario">
                <input type="hidden" id="id-editar" name="id">
                
                <label for="nombre-editar">Nombre:</label>
                <input type="text" id="nombre-editar" name="nombre" >
                
                <label for="apellido-editar">Apellido:</label>
                <input type="text" id="apellido-editar" name="apellido" >
                
                <label for="username-editar">Username:</label>
                <input type="text" id="username-editar" name="username" >
                
                <label for="email-editar">Correo Electrónico:</label>
                <input type="email" id="email-editar" name="email" >
                
                <label for="genero-editar">Género:</label>
                <select id="genero-editar" name="genero" >
                    <option value="">Seleccione</option>
                    <option value="masculino">Masculino</option>
                    <option value="femenino">Femenino</option>
                </select>
                
                <label for="fecha_nacimiento-editar">Fecha de Nacimiento:</label>
                <input type="date" id="fecha_nacimiento-editar" name="fecha_nacimiento" >
                
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal para Eliminar Usuario -->
    <div id="modal-eliminar-usuario" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('eliminar-usuario')">&times;</span>
            <h2>Eliminar Usuario</h2>
            <p>¿Estás seguro de que deseas eliminar este usuario?</p>
            <form id="form-eliminar-usuario">
                <input type="hidden" id="id-eliminar" name="id">
                <button type="submit">Eliminar</button>
                <button type="button" onclick="cerrarModal('eliminar-usuario')">Cancelar</button>
            </form>
        </div>
    </div>

    <!-- Modal para Crear Película -->
    <div id="modal-crear-peli" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('crear-peli')">&times;</span>
            <h2>Crear Película</h2>
            <form id="form-crear-peli" enctype="multipart/form-data">
                <label for="nombre-peli">Nombre:</label>
                <input type="text" id="nombre-peli" name="nombre" >
                <label for="descripcion-peli">Descripción:</label>
                <textarea id="descripcion-peli" name="descripcion" ></textarea>
                <label for="duracion-peli">Duración (minutos):</label>
                <input type="number" id="duracion-peli" name="duracion" >
                <label for="portada-peli">Portada:</label>
                <input type="file" id="portada-peli" name="portada" accept="image/*" >
                <button type="submit">Crear</button>
            </form>
        </div>
    </div>

    <!-- Modal para Editar Película -->
    <div id="modal-editar-peli" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('editar-peli')">&times;</span>
            <h2>Editar Película</h2>
            <form id="form-editar-peli" enctype="multipart/form-data">
                <input type="hidden" id="id-editar-peli" name="id">
                <label for="nombre-editar-peli">Nombre:</label>
                <input type="text" id="nombre-editar-peli" name="nombre" >
                <label for="descripcion-editar-peli">Descripción:</label>
                <textarea id="descripcion-editar-peli" name="descripcion" ></textarea>
                <label for="duracion-editar-peli">Duración (minutos):</label>
                <input type="number" id="duracion-editar-peli" name="duracion" >
                <label for="portada-editar-peli">Portada:</label>
                <input type="file" id="portada-editar-peli" name="portada" accept="image/*">
                <button type="submit">Guardar Cambios</button>
            </form>
        </div>
    </div>

    <!-- Modal para Eliminar Película -->
    <div id="modal-eliminar-peli" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModal('eliminar-peli')">&times;</span>
            <h2>Eliminar Película</h2>
            <p>¿Estás seguro de que deseas eliminar esta película?</p>
            <form id="form-eliminar-peli">
                <input type="hidden" id="id-eliminar-peli" name="id">
                <button type="submit">Eliminar</button>
                <button type="button" onclick="cerrarModal('eliminar-peli')">Cancelar</button>
            </form>
        </div>
    </div>

    <script src="../JS/Crud.js"></script>
</body>
</html>