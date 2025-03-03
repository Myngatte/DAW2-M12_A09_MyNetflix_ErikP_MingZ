<?php
require '../PHP/admin/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitudes Pendientes</title>
    <link rel="stylesheet" href="../CSS/admin.css">
</head>
<body>
    <a href='../PHP/destroy_session.php'><button class='logout'>Cerrar Sesión</button></a>
    <a href="admin.php"><button class='back'>Volver</button></a>

    <h2>Solicitudes Pendientes</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Username</th>
                <th>Email</th>
                <th>Género</th>
                <th>Fecha de Nacimiento</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tabla-solicitudes">
        </tbody>
    </table>

    <script src="../JS/solicitudes.js"></script>
</body>
</html>
