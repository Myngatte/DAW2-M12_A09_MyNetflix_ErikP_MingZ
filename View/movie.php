<?php 
require_once "../PHP/conection/conexion.php"; 

if(!isset($_SESSION["activeUser"])){
    header("Location: ../View/login.php");
    exit();
}

if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("Location: ../main.php");
    exit();
}

$id = htmlspecialchars($_GET["id"]);
// Consulta SQL para obtener películas
try {
  $sql = "SELECT *, 
         (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes 
          FROM tbl_pelis p WHERE p.id_peli = :id";
  $stmt = $conn->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
  $peli = $stmt->fetch(PDO::FETCH_ASSOC);

  // Consulta para obtener géneros (tabla tbl_pgeneros)
  $sqlGen = "SELECT id_genero, nom_genero FROM tbl_pgeneros WHERE id_genero = :id";
  $stmtGen = $conn->prepare($sqlGen);
  $stmtGen->bindParam(':id', $id);
  $stmtGen->execute();
  $generos = $stmtGen->fetchAll(PDO::FETCH_ASSOC);
  
} catch (PDOException $e) {
  echo "Error:" . $e->getMessage();
  exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?php echo htmlspecialchars($peli['nom_peli']); ?> - Meiga</title>
  <link rel="stylesheet" href="../CSS/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  <!-- Puedes usar tu propio CSS o Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<header>
    <div class="logo">🎬 MEIGA</div>    
    <div class="buttons">
      <a href="./login.php?session=exit"><button>Cerrar Sesión</button></a>
      <a href="./register.php"><button class="register">Register</button></a>
    </div>
  </header>

  <!-- Botón para cerrar o volver (por ejemplo, a main.php) -->
  <a href="main.php" class="close-btn" title="Volver">&times;</a>

  <div class="container-peli">
    <div class="poster">
      <img src="../IMG/Pelis/<?php echo htmlspecialchars($peli['portada']); ?>" 
           alt="<?php echo htmlspecialchars($peli['nom_peli']); ?>">
    </div>
    <div class="info">
      <h1><?php echo htmlspecialchars($peli['nom_peli']); ?></h1>
      <p><strong>Sinopsis:</strong> <?php echo htmlspecialchars($peli['descripcion']); ?></p>
      
      <div class="duration-likes">
        <span><strong>Duración:</strong> <?php echo htmlspecialchars($peli['duracion']); ?></span>
        <span><button id="likeBtn" data-movie-id="<?php echo $peli['id_peli']; ?>">
            <?php
                // Opcional: si ya se ha dado like, muestra un corazón relleno, de lo contrario sin relleno.
                // Esto se puede determinar con una consulta previa al servidor.
                echo '<i class="far fa-heart"></i>';
            ?>
        </button><span id="likeCount"><?php echo htmlspecialchars($peli['likes']); ?></span></span>
      </div>
      
      
      <button class="btn-watch">VER AHORA</button>
    </div>

    <!-- Sección para mostrar el staff asociado a la película -->
    <?php if (!empty($staffs)): ?>
      <div class="staff-section">
        <h2>Staff</h2>
        <div class="staff-list">
          <?php foreach ($staffs as $staff): ?>
            <div class="staff-member">
              <?php echo htmlspecialchars($staff['nom_staff'] . ' ' . $staff['apellido_staff']); ?>
              <br>
              <small><?php echo htmlspecialchars($staff['nom_rol_staff']); ?></small>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
  <script src="../JS/like.js"></script>
</body>
</html>