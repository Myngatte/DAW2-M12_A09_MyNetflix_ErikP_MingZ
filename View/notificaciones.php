<?php
require_once "../PHP/conection/conexion.php"; 

if(!isset($_SESSION["activeUser"])){
    header("Location: ./login.php");
    exit();
}
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
        <thead id="tabla-encabezado">
        </thead>
        <tbody id="tabla-solicitudes">
        </tbody>
    </table>

    <script src="../JS/solicitudes.js"></script>
</body>
</html>
