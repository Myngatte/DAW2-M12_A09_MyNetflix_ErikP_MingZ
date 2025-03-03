<?php

require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $fecha_nac = $_POST['fecha_nacimiento'];
        $rol_user = 2; // Usuario normal por defecto
        $contrasena = "Password123";

        // Hashear la contraseña con BCRYPT
        $hashedPassword = password_hash($contrasena, PASSWORD_BCRYPT);

        // Sentencia SQL para insertar el usuario con la contraseña hasheada
        $sql = "INSERT INTO tbl_users (nombre_usr, apellido_usr, username, email, genero_usr, fecha_nac, rol_user, contrasena) 
                VALUES (:nombre, :apellido, :username, :email, :genero, :fecha_nac, :rol_user, :contrasena)";

        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->bindParam(':rol_user', $rol_user);
        $stmt->bindParam(':contrasena', $hashedPassword);

        $stmt->execute();

        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}

?>
