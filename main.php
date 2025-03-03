<?php 

require_once "./PHP/conection/conexion.php"; 

if(!isset($_SESSION["activeUser"])){
    header("Location: ./View/login.php");
    exit();
}

// Consulta para obtener todas las películas (usada en la vista general)
try {
    $sql = "SELECT p.id_peli, p.nom_peli, p.portada, 
           (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes 
           FROM tbl_pelis p";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para todos los géneros que tengan películas
    $sqlGen = "SELECT DISTINCT g.id_genero, g.nom_genero
               FROM genero_peli gp 
               JOIN tbl_pgeneros g ON gp.id_genero = g.id_genero";
    $stmtGenre = $conn->prepare($sqlGen);
    $stmtGenre->execute();
    $genres = $stmtGenre->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener hasta 5 géneros que tengan películas
    $sqlGen = "SELECT DISTINCT g.id_genero, g.nom_genero
               FROM genero_peli gp 
               JOIN tbl_pgeneros g ON gp.id_genero = g.id_genero 
               LIMIT 5";
    $stmtGenre = $conn->prepare($sqlGen);
    $stmtGenre->execute();
    $generos = $stmtGenre->fetchAll(PDO::FETCH_ASSOC);

    // Para cada género, obtenemos hasta 10 películas
    $secciones = [];
    foreach ($generos as $gen) {
        $genId = $gen['id_genero'];
        $sqlPelis = "
          SELECT p.id_peli, p.nom_peli, p.portada, (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes
          FROM genero_peli gp
          JOIN tbl_pelis p ON gp.id_pelicula = p.id_peli
          WHERE gp.id_genero = :genId
          LIMIT 10
        "; 
        $stmtPelis = $conn->prepare($sqlPelis);
        $stmtPelis->bindValue(':genId', $genId, PDO::PARAM_INT);
        $stmtPelis->execute();
        $pelisGenero = $stmtPelis->fetchAll(PDO::FETCH_ASSOC);

        $secciones[] = [
            'id_genero'  => $genId,
            'nom_genero' => $gen['nom_genero'],
            'peliculas'  => $pelisGenero
        ];
    }
        // Consulta para TOP Movies (máximo 10 con más likes)
    $sqlTop = "SELECT p.id_peli, p.nom_peli, p.portada,
              (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes
               FROM tbl_pelis p
               ORDER BY likes DESC
               LIMIT 5";
    $stmtTop = $conn->prepare($sqlTop);
    $stmtTop->execute();
    $topMovies = $stmtTop->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Error:" . $e->getMessage();
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Películas - Meiga</title>
  <link rel="stylesheet" href="./CSS/main.css">
  <!-- Bootstrap (para algunos estilos de botones, etc.) -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
  <header>
    <div class="logo">🎬 MEIGA</div>
    <!-- Filtro por nombre (fuera del modal) -->
    <input type="text" id="filterName" placeholder="Buscar por nombre...">
    <div class="buttons">
      <button id="openFilterModal">Filtrar por Género</button>
      <a href="./View/login.php?session=exit"><button>Cerrar Sesión</button></a>
      <a href="./View/register.php"><button class="register">Register</button></a>
    </div>
  </header>

  <h2>Películas Disponibles</h2>
<!-- Sección Top Movies: siempre visible -->
  <div class="movies">
    <div class="genre-section">
      <h3>The BIG 5</h3>
      <div class="movies-row">
        <?php foreach ($topMovies as $movie): ?>
          <div class="movie">
            <a href="./View/movie.php?id=<?= $movie['id_peli'] ?>">
              <img src="<?= htmlspecialchars('./IMG/Pelis/' . $movie['portada']) ?>" 
                  alt="<?= htmlspecialchars($movie['nom_peli']) ?>">
              <p><?= htmlspecialchars($movie['nom_peli']) ?></p>
              <span class="likes-tooltip">Likes: <?= htmlspecialchars($movie['likes']) ?></span>
            </a>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
  <!-- Contenedor de películas: se llena inicialmente con la vista por secciones -->
  <div class="movies">
    <?php if (!empty($secciones)): ?>
      <?php foreach ($secciones as $sec): ?>
        <div class="genre-section">
          <h3><?php echo htmlspecialchars($sec['nom_genero']); ?></h3>
          <div class="movies-row">
            <?php foreach ($sec['peliculas'] as $peli): ?>
              <div class="movie">
                <a href="./View/movie.php?id=<?php echo $peli['id_peli']; ?>">
                  <img src="<?= htmlspecialchars('./IMG/Pelis/' . $peli['portada']) ?>" 
                       alt="<?= htmlspecialchars($peli['nom_peli']) ?>">
                  <p><?= htmlspecialchars($peli['nom_peli']) ?></p>
                  <span class="likes-tooltip">Likes: <?= htmlspecialchars($peli['likes'])?></span>
                </a>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <!-- Si por alguna razón no hay secciones, mostramos todas las películas flat -->
      <?php foreach ($peliculas as $peli): ?>
        <div class="movie">
          <a href="movie.php?id=<?php echo $peli['id_peli']; ?>">
            <img src="<?= htmlspecialchars('./IMG/Pelis/' . $peli['portada']) ?>" 
                 alt="<?= htmlspecialchars($peli['nom_peli']) ?>">
            <p><?= htmlspecialchars($peli['nom_peli']) ?></p>
            <span class="likes-tooltip">Likes: <?= $peli['likes'] ?></span>
          </a>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <!-- Modal para filtrar por géneros (usando botones tipo tag) -->
  <div id="filterModal" class="modal">
    <div class="modal-content">
      <span id="closeFilterModal" class="close">&times;</span>
      <h3>Filtrar por Género</h3>
      <div id="genreTags" class="d-flex flex-wrap gap-2">
        <?php foreach ($genres as $gen): ?>
          <button type="button" class="btn btn-outline-primary genre-btn" data-genre="<?= htmlspecialchars($gen['id_genero']) ?>">
            <?= htmlspecialchars($gen['nom_genero']) ?>
          </button>
        <?php endforeach; ?>
      </div>
      <button id="applyFilter" class="btn btn-primary mt-3" style="width: 100%;">Aplicar Filtro</button>
    </div>
  </div>

  <!-- Cargamos nuestro script de filtrado vía AJAX -->
  <script src="./JS/filter.js"></script>
</body>
</html>
