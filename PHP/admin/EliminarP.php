<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener el ID de la película
        $id_peli = $_POST['id_peli'];

        // Eliminar la película de la base de datos
        $sql = "DELETE FROM peliculas WHERE id_peli = :id_peli";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id_peli', $id_peli);

        $stmt->execute();

        echo json_encode(['message' => 'Película eliminada exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al eliminar la película: ' . $e->getMessage()]);
    }
}
?>
