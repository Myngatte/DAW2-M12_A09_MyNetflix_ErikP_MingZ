<?php

require_once '../conection/conexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $duracion = $_POST['duracion']; // Viene en formato HH:MM:SS
        $generos = isset($_POST['generos']) ? $_POST['generos'] : [];

        // Iniciar transacción
        $conn->beginTransaction();

        $sql = "UPDATE tbl_pelis 
                SET nom_peli = :nombre, 
                    descripcion = :descripcion, 
                    duracion = :duracion";

        // Si se subió una nueva imagen
        if (isset($_FILES['portada']) && $_FILES['portada']['error'] === 0) {
            $portada = $_FILES['portada'];
            $portada_nombre = time() . '_' . $portada['name'];
            move_uploaded_file($portada['tmp_name'], "../../IMG/pelis/" . $portada_nombre);
            $sql .= ", portada = :portada";
        }

        $sql .= " WHERE id_peli = :id";
        
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':duracion', $duracion);
        
        if (isset($portada_nombre)) {
            $stmt->bindParam(':portada', $portada_nombre);
        }

        $stmt->execute();

        // Eliminar géneros existentes
        $sql_delete = "DELETE FROM genero_peli WHERE id_pelicula = :peli_id";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bindParam(':peli_id', $id);
        $stmt_delete->execute();

        // Insertar los nuevos géneros seleccionados
        if (!empty($generos)) {
            $sql_generos = "INSERT INTO genero_peli (id_pelicula, id_genero) VALUES (:peli_id, :genero_id)";
            $stmt_generos = $conn->prepare($sql_generos);

            foreach ($generos as $genero_id) {
                $stmt_generos->bindParam(':peli_id', $id);
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
