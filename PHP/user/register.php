<?php
require "../conection.php/conexion.php";

try {
    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar datos del formulario
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contrasena = password_hash($_POST['contrasena'], PASSWORD_BCRYPT); 
        $nombre_usr = $_POST['nombre_usr'];
        $apellido_usr = $_POST['apellido_usr'];
        $fecha_nac = $_POST['fecha_nac'];
        $genero_usr = $_POST['genero_usr'];
        $estado = 'Pendiente'; 
        $rol_user = 2;

        // Preparar la consulta SQL
        $sql = "INSERT INTO tbl_users (username, email, contrasena, nombre_usr, apellido_usr, fecha_nac, genero_usr, estado, rol_user)
                VALUES (:username, :email, :contrasena, :nombre_usr, :apellido_usr, :fecha_nac, :genero_usr, :estado, :rol_user)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':nombre_usr', $nombre_usr);
        $stmt->bindParam(':apellido_usr', $apellido_usr);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->bindParam(':genero_usr', $genero_usr);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':rol_user', $rol_user);

        // Ejecutar la consulta
        $stmt->execute();

        // Mensaje de éxito
        header("../../view/register.php?register=success");
        exit();
    }
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>