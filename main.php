<?php 
require_once "./PHP/conection/conexion.php"; 

if(!isset($_SESSION["activeUser"])){
    header("Location: ./View/login.php");
    exit();
}

// Consulta SQL para obtener películas
try {
  $sql = "SELECT p.id_peli, p.nom_peli, p.portada, 
         (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes 
          FROM tbl_pelis p";
  $stmt = $conn->prepare($sql);
  $stmt->execute();
  $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

  // Consulta para obtener géneros (tabla tbl_pgeneros)
  $sqlGen = "SELECT id_genero, nom_genero FROM tbl_pgeneros";
  $stmtGen = $conn->prepare($sqlGen);
  $stmtGen->execute();
  $generos = $stmtGen->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
  echo "Error:" . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Películas - Meiga</title>
  <link rel="stylesheet" href="./CSS/main.css">
  <!-- Cargamos Bootstrap para los botones outline -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <header>
    <div class="logo">🎬 MEIGA</div>
    <!-- Filtro por nombre, fuera del modal -->
    <input type="text" id="filterName" placeholder="Buscar por nombre...">
    
    <div class="buttons">
      <button id="openFilterModal">Filtrar por Género</button>
      <a href="./login.php?session=exit"><button>Cerrar Sesión</button></a>
      <a href="./View/register.php"><button class="register">Register</button></a>
    </div>
  </header>

  <h2>Películas Disponibles</h2>

  <!-- Contenedor de películas -->
  <div class="movies">
    <?php foreach ($peliculas as $peli): ?>
      <div class="movie">
        <a href="<?php echo "./View/movie.php?id=" . $peli['id_peli']?>">
        <img src="<?= htmlspecialchars('./IMG/Pelis/' . $peli['portada']) ?>" 
             alt="<?= htmlspecialchars($peli['nom_peli']) ?>">
        <p><?= htmlspecialchars($peli['nom_peli']) ?></p>
        <span class="likes-tooltip">Likes: <?= $peli['likes'] ?></span>
        </a>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Modal para filtrar por géneros -->
  <div id="filterModal" class="modal">
    <div class="modal-content">
      <span id="closeFilterModal" class="close">&times;</span>
      <h3>Filtrar por Género</h3>
      <!-- Lista de botones (tags) para los géneros -->
      <div id="genreTags" class="d-flex flex-wrap gap-2">
        <?php foreach ($generos as $gen): ?>
          <button type="button" class="btn btn-outline-primary genre-btn" data-genre="<?= htmlspecialchars($gen['id_genero']) ?>">
            <?= htmlspecialchars($gen['nom_genero']) ?>
          </button>
        <?php endforeach; ?>
      </div>
      <button id="applyFilter" class="btn btn-primary mt-3" style="width: 100%;">Aplicar Filtro</button>
    </div>
  </div>

  <!-- Cargamos nuestro JS externo -->
  <script src="./JS/filter.js"></script>
</body>
</html>
