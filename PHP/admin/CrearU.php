<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $fecha_nac = $_POST['fecha_nacimiento'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar la contraseña

        // Insertar en la base de datos
        $sql = "INSERT INTO usuarios (nombre_usr, apellido_usr, username, email, genero_usr, fecha_nac, password) 
                VALUES (:nombre, :apellido, :username, :email, :genero, :fecha_nac, :password)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->bindParam(':password', $password);

        $stmt->execute();

        echo json_encode(['message' => 'Usuario creado exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al crear el usuario: ' . $e->getMessage()]);
    }
}
?>
