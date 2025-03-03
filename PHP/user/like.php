<?php
require_once "../conection/conexion.php";
header('Content-Type: application/json');

// Verificar que el usuario esté logueado
if(!isset($_SESSION["activeUser"])) {
  echo json_encode(["success" => false, "message" => "Debes iniciar sesión."]);
  exit();
}

// Leer la petición JSON
$data = json_decode(file_get_contents('php://input'), true);
if (!isset($data['movieId'])) {
  echo json_encode(["success" => false, "message" => "ID de película no especificado."]);
  exit();
}

$movieId = (int)$data['movieId'];
$userId = $_SESSION["activeUser"]; // Asumimos que aquí se guarda el ID del usuario

try {
  // Verificamos si ya existe un like para este usuario y película
  $sqlCheck = "SELECT id_like FROM tbl_likes WHERE user_liked = :user AND peli_liked = :movie";
  $stmtCheck = $conn->prepare($sqlCheck);
  $stmtCheck->bindParam(':user', $userId, PDO::PARAM_INT);
  $stmtCheck->bindParam(':movie', $movieId, PDO::PARAM_INT);
  $stmtCheck->execute();
  $like = $stmtCheck->fetch(PDO::FETCH_ASSOC);

  if($like) {
    // Si existe, se quita el like (DELETE)
    $sqlDelete = "DELETE FROM tbl_likes WHERE id_like = :id";
    $stmtDelete = $conn->prepare($sqlDelete);
    $stmtDelete->bindParam(':id', $like['id_like'], PDO::PARAM_INT);
    $stmtDelete->execute();
    $liked = false;
  } else {
    // Si no existe, se inserta un nuevo like
    $sqlInsert = "INSERT INTO tbl_likes (user_liked, peli_liked) VALUES (:user, :movie)";
    $stmtInsert = $conn->prepare($sqlInsert);
    $stmtInsert->bindParam(':user', $userId, PDO::PARAM_INT);
    $stmtInsert->bindParam(':movie', $movieId, PDO::PARAM_INT);
    $stmtInsert->execute();
    $liked = true;
  }

  // Obtener el total de likes actualizado para la película
  $sqlCount = "SELECT COUNT(*) AS total FROM tbl_likes WHERE peli_liked = :movie";
  $stmtCount = $conn->prepare($sqlCount);
  $stmtCount->bindParam(':movie', $movieId, PDO::PARAM_INT);
  $stmtCount->execute();
  $countData = $stmtCount->fetch(PDO::FETCH_ASSOC);
  $likeCount = $countData['total'];

  echo json_encode([
    "success"   => true,
    "liked"     => $liked,
    "likeCount" => $likeCount
  ]);
} catch(PDOException $e) {
  echo json_encode([
    "success" => false,
    "message" => "Error: " . $e->getMessage()
  ]);
}
?>