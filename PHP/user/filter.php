<?php
require_once "../conection/conexion.php";
header('Content-Type: application/json');

// Leer el JSON enviado por fetch
$input = json_decode(file_get_contents('php://input'), true);

// Obtener filtros
$name   = isset($input['name']) ? trim($input['name']) : '';
$genres = isset($input['genres']) ? $input['genres'] : [];

// Construir la consulta base
$sql = "SELECT p.id_peli, p.nom_peli, p.portada FROM tbl_pelis p WHERE 1=1";
$params = array();

// Si se filtra por nombre, agregamos la condición
if (!empty($name)) {
  $sql .= " AND p.nom_peli LIKE :name";
  $params[':name'] = "%$name%";
}

// Si se han seleccionado géneros, agregamos la condición usando parámetros nombrados
if (!empty($genres)) {
  $genrePlaceholders = [];
  foreach ($genres as $index => $genre) {
    $placeholder = ":genre" . $index;
    $genrePlaceholders[] = $placeholder;
    $params[$placeholder] = $genre;
  }
  $placeholdersStr = implode(',', $genrePlaceholders);
  $sql .= " AND p.id_peli IN (
             SELECT gp.id_pelicula FROM genero_peli gp
             WHERE gp.id_genero IN ($placeholdersStr)
           )";
}

$stmt = $conn->prepare($sql);

// Bindear todos los parámetros
foreach ($params as $key => $value) {
  if ($key === ':name') {
    $stmt->bindValue($key, $value, PDO::PARAM_STR);
  } else {
    $stmt->bindValue($key, $value, PDO::PARAM_INT);
  }
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($result);
