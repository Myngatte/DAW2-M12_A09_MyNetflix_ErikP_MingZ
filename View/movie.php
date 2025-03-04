<?php 
require_once "../PHP/conection/conexion.php"; 

if (!isset($_SESSION["activeUser"])) {
    header("Location: ../View/login.php");
    exit();
}

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: ../main.php");
    exit();
}

$id = htmlspecialchars($_GET["id"]);

try {
    // Consulta para obtener la película
    $sql = "SELECT *, 
            (SELECT COUNT(*) FROM tbl_likes l WHERE l.peli_liked = p.id_peli) AS likes 
            FROM tbl_pelis p WHERE p.id_peli = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $peli = $stmt->fetch(PDO::FETCH_ASSOC);

    // Consulta para verificar si el usuario ha dado like
    $sqlCheck = "SELECT id_like FROM tbl_likes WHERE user_liked = :user AND peli_liked = :movie";
    $stmtCheck = $conn->prepare($sqlCheck);
    $stmtCheck->bindParam(':user', $_SESSION["activeUser"], PDO::PARAM_INT);
    $stmtCheck->bindParam(':movie', $id, PDO::PARAM_INT);
    $stmtCheck->execute();
    $like = $stmtCheck->fetch(PDO::FETCH_ASSOC);

    if ($like) {
        $heartPage = '<i class="fas fa-heart"></i>';
    } else {
        $heartPage = '<i class="far fa-heart"></i>';
    }

    // Consulta para obtener el staff de la película
    $sqlStaff = "SELECT s.nom_staff, s.apellido_staff, rs.nom_rol_staff
                 FROM tbl_staff s
                 JOIN staff_peli sp ON s.id_staff = sp.id_staff
                 JOIN tbl_rol_staff rs ON s.rol_staff = rs.id_rol_staff
                 WHERE sp.id_pelicula = :id";
    $stmtStaff = $conn->prepare($sqlStaff);
    $stmtStaff->bindParam(':id', $id);
    $stmtStaff->execute();
    $staffs = $stmtStaff->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener los géneros de la película
    $sqlGen = "SELECT g.nom_genero
               FROM tbl_pgeneros g
               JOIN genero_peli gp ON g.id_genero = gp.id_genero
               WHERE gp.id_pelicula = :id";
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<header>
    <div class="logo">🎬 MEIGA</div>    
    <div class="buttons">
        <a href="../PHP/destroy_session.php"><button>Cerrar Sesión</button></a>
        <a href="./register.php"><button class="register">Register</button></a>
    </div>
</header>

<a href="../main.php" class="btn-volver" title="Volver"></a>

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
            <span>
                <button id="likeBtn" data-movie-id="<?php echo $peli['id_peli']; ?>">
                    <?php echo $heartPage; ?>
                </button>
                <span id="likeCount"><?php echo htmlspecialchars($peli['likes']); ?></span>
            </span>
        </div>
        <?php if (!empty($generos)): ?>
            <div class="genres-section">
                <div class="genres-list">
                    <?php foreach ($generos as $genero): ?>
                        <span class="genre"><?php echo htmlspecialchars($genero['nom_genero']); ?></span>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($staffs)): ?>
            <div class="staff-section">
                <h3>Staff</h3>
                <div class="staff-list">
                    <?php foreach ($staffs as $staff): ?>
                        <div class="staff-member">
                            <?php echo htmlspecialchars($staff['nom_staff'] . ' ' . $staff['apellido_staff']); ?>
                            <br>
                            <small><?php echo htmlspecialchars($staff['nom_rol_staff']); ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div><br>
        <?php endif; ?>
        <button class="btn-watch">VER AHORA</button>
    </div>
</div>

<script src="../JS/like.js"></script>
</body>
</html>