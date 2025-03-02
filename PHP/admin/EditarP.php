<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener los datos del formulario
        $id_peli = $_POST['id_peli'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion'];

        // Actualizar en la base de datos
        $sql = "UPDATE peliculas 
                SET nom_peli = :nombre, descripcion = :descripcion, duracion = :duracion 
                WHERE id_peli = :id_peli";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':id_peli', $id_peli);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':duracion', $duracion);

        $stmt->execute();

        echo json_encode(['message' => 'Película actualizada exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al actualizar la película: ' . $e->getMessage()]);
    }
}
?>
