<?php

require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $genero = $_POST['genero'];
        $fecha_nac = $_POST['fecha_nacimiento'];

        $sql = "UPDATE tbl_users 
                SET nombre_usr = :nombre, 
                    apellido_usr = :apellido, 
                    username = :username, 
                    email = :email, 
                    genero_usr = :genero, 
                    fecha_nac = :fecha_nac 
                WHERE id_usr = :id";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':apellido', $apellido);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':genero', $genero);
        $stmt->bindParam(':fecha_nac', $fecha_nac);

        $stmt->execute();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
