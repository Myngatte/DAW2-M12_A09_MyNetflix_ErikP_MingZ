<?php
require_once '../conection/conexion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = $data['id_peli'];

        // Iniciar transacción
        $conn->beginTransaction();

        // Primero eliminar los registros de la tabla intermedia genero_peli
        $sql_generos = "DELETE FROM genero_peli WHERE id_pelicula = :id";
        $stmt_generos = $conn->prepare($sql_generos);
        $stmt_generos->bindParam(':id', $id);
        $stmt_generos->execute();

        // Eliminar los likes relacionados con la película
        $sql_likes = "DELETE FROM tbl_likes WHERE peli_liked = :id";
        $stmt_likes = $conn->prepare($sql_likes);
        $stmt_likes->bindParam(':id', $id);
        $stmt_likes->execute();

        // Luego eliminar la película
        $sql = "DELETE FROM tbl_pelis WHERE id_peli = :id";
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
