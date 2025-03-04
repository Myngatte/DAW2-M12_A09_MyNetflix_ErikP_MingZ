<?php
require_once '../conection/conexion.php';
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $sql = "SELECT id_usr, nombre_usr, apellido_usr, username, email, 
                       fecha_nac, genero_usr
                FROM tbl_users 
                WHERE estado = 'Pendiente'
                ORDER BY id_usr";
        
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode($data);
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $data = json_decode(file_get_contents('php://input'), true);
        
        if ($data['action'] === 'accept') {
            $sql = "UPDATE tbl_users SET estado = 'Aceptado' WHERE id_usr = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':id', $data['id_usr']);
            $stmt->execute();
            
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Acción no válida']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => $e->getMessage()]);
    }
}
?>
