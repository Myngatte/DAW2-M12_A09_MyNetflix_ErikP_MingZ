<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener el ID del usuario
        $id_usr = $_POST['id_usr'];

        // Eliminar el usuario de la base de datos
        $sql = "DELETE FROM usuarios WHERE id_usr = :id_usr";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_usr', $id_usr);

        $stmt->execute();

        echo json_encode(['message' => 'Usuario eliminado exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar el usuario: ' . $e->getMessage()]);
    }
}
?>
