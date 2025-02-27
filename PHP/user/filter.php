<?php
require_once "../conection/conexion.php";
header('Content-Type: application/json');

// Leer los datos enviados por fetch (JSON)
$input = json_decode(file_get_contents('php://input'), true);

// Obtener filtros
$name   = isset($input['name']) ? trim($input['name']) : '';
$genres = isset($input['genres']) ? $input['genres'] : [];

// Consulta base: seleccionar películas
$sql = "SELECT p.id_peli, p.nom_peli, p.portada FROM tbl_pelis p WHERE 1=1";

// Si se filtra por nombre, se agrega la condición
if (!empty($name)) {
  $sql .= " AND p.nom_peli LIKE :name";
}

// Si se han seleccionado géneros, filtramos las películas que pertenezcan a alguno de ellos
if (!empty($genres)) {
  // Creamos placeholders para cada género seleccionado
  $placeholders = implode(',', array_fill(0, count($genres), '?'));
  $sql .= " AND p.id_peli IN (
             SELECT gp.id_pelicula FROM genero_peli gp
             WHERE gp.id_genero IN ($placeholders)
           )";
}

$stmt = $conn->prepare($sql);

// Si hay filtro por nombre, lo bindeamos
if (!empty($name)) {
  $stmt->bindValue(':name', "%$name%", PDO::PARAM_STR);
}

// Si hay géneros seleccionados, bindeamos cada uno
if (!empty($genres)) {
  $i = 1;
  foreach ($genres as $genre) {
    $stmt->bindValue($i, $genre, PDO::PARAM_INT);
    $i++;
  }
}

$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Devolver las películas filtradas en formato JSON
echo json_encode($result);