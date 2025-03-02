<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener los datos del formulario
        $id_usr = $_POST['id_usr'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $fecha_nac = $_POST['fecha_nacimiento'];

        // Si la contraseña se proporciona, la actualizamos
        $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null;

        // Actualizar en la base de datos
        $sql = "UPDATE usuarios 
                SET nombre_usr = :nombre, apellido_usr = :apellido, username = :username, email = :email, 
                    genero_usr = :genero, fecha_nac = :fecha_nac" . 
                ($password ? ", password = :password" : "") . " 
                WHERE id_usr = :id_usr";

        $stmt = $conn->prepare($sql);

        // Vinculamos los parámetros
        $stmt->bindParam(':id_usr', $id_usr);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fecha_nac', $fecha_nac);

        // Si la contraseña está presente, la vinculamos
        if ($password) {
            $stmt->bindParam(':password', $password);
        }

        $stmt->execute();

        echo json_encode(['message' => 'Usuario actualizado exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al actualizar el usuario: ' . $e->getMessage()]);
    }
}
?>
