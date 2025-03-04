<?php

require_once '../conection/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id_usr'];

        // Iniciar transacción
        $conn->beginTransaction();

        // Primero eliminar los likes del usuario
        $sql_likes = "DELETE FROM tbl_likes WHERE user_liked = :id";
        $stmt_likes = $conn->prepare($sql_likes);
        $stmt_likes->bindParam(':id', $id);
        $stmt_likes->execute();

        // Luego eliminar el usuario
        $sql = "DELETE FROM tbl_users WHERE id_usr = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        // Confirmar transacción
        $conn->commit();
        echo json_encode(['success' => true]);
    } catch (PDOException $e) {
        // Revertir cambios si hay error
        $conn->rollBack();
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
