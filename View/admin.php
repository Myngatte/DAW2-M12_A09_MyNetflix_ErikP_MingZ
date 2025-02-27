<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración</title>
</head>
<body>
    <a href='../../Procesos/destruir.php'><button class='logout'>Cerrar Sesión</button></a>
    <div class="botones">
        <button onclick="cargarDatos('usuarios')">Usuarios</button>
        <button onclick="cargarDatos('pelis')">Películas</button>
    </div>

    <h2 id="titulo">Gestión de Usuarios</h2>
    <a href='./new_user.php'><button class='new'>Nuevo Usuario</button></a>

    <table>
        <thead id="tabla-header"></thead>
        <tbody id="tabla-body"></tbody>
    </table>

    <script src="../JS/Crud.js"></script>
</body>
</html>
