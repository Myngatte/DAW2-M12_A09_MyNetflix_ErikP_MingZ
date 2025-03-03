<?php
require_once './conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion']; // Viene en formato HH:MM:SS
        $generos = isset($_POST['generos']) ? $_POST['generos'] : [];
        
        // Manejo de la imagen
        $portada = $_FILES['portada'];
        $portada_nombre = time() . '_' . $portada['name'];
        move_uploaded_file($portada['tmp_name'], "../../IMG/pelis/" . $portada_nombre);

        // Iniciar transacción
        $conn->beginTransaction();

        // Insertar la película
        $sql = "INSERT INTO tbl_pelis (nom_peli, descripcion, duracion, portada) 
                VALUES (:nombre, :descripcion, :duracion, :portada)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':duracion', $duracion);
        $stmt->bindParam(':portada', $portada_nombre);

        $stmt->execute();
        
        // Obtener el ID de la película recién insertada
        $peli_id = $conn->lastInsertId();

        // Insertar los géneros seleccionados
        if (!empty($generos)) {
            $sql_generos = "INSERT INTO genero_peli (id_pelicula, id_genero) VALUES (:peli_id, :genero_id)";
            $stmt_generos = $conn->prepare($sql_generos);

            foreach ($generos as $genero_id) {
                $stmt_generos->bindParam(':peli_id', $peli_id);
                $stmt_generos->bindParam(':genero_id', $genero_id);
                $stmt_generos->execute();
            }
        }

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
