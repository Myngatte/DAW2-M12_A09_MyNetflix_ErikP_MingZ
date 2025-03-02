<?php
session_start();
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Obtener los datos del formulario
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion'];
        $portada = $_FILES['portada']['name'];

        // Subir la portada
        $targetDir = "../IMG/pelis/";
        $targetFile = $targetDir . basename($portada);
        move_uploaded_file($_FILES['portada']['tmp_name'], $targetFile);

        // Insertar en la base de datos
        $sql = "INSERT INTO peliculas (nom_peli, descripcion, duracion, portada) 
                VALUES (:nombre, :descripcion, :duracion, :portada)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':portada', $portada);

        $stmt->execute();

        echo json_encode(['message' => 'Película creada exitosamente']);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al crear la película: ' . $e->getMessage()]);
    }
}
?>
