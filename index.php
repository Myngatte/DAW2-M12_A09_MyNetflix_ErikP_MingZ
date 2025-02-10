<?php
require_once "./PHP/conection.php/conexion.php"; 

// Consulta SQL para obtener películas
$sql = "SELECT id_peli, nom_peli, portada FROM tbl_pelis";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$peliculas = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Películas - Meiga</title>
    <link rel="stylesheet" href="./CSS//main.css">
</head>
<body>
    <header>
        <div class="logo">🎬 MEIGA</div>
        <input type="text" placeholder="Buscar...">
        <div class="buttons">
            <a href="./View/login.php"><button>Log In</button></a>
            <a href="./View//register.php"><button class="register">Register</button></a>
        </div>
    </header>

    <h2>Películas Disponibles</h2>
    <div class="movies">
        <?php foreach ($peliculas as $peli): ?>
            <div class="movie">
                <img src="<?= htmlspecialchars($peli['portada']) ?>" alt="<?= htmlspecialchars($peli['nom_peli']) ?>">
                <p>ID: <?= $peli['id_peli'] ?></p>
                <p><?= htmlspecialchars($peli['nom_peli']) ?></p>
            </div>
        <?php endforeach; ?>
    </div>

</body>
</html>
