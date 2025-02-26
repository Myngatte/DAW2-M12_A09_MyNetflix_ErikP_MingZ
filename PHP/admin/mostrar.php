<?php
include '../PHP/conection.php/conexion.php';

$stmtUsuarios = $conn->prepare("SELECT * FROM tbl_users");
$stmtUsuarios->execute();
$usuarios = $stmtUsuarios->fetchAll(PDO::FETCH_ASSOC);

$stmtPeliculas = $conn->prepare("SELECT * FROM tbl_pelis");
$stmtPeliculas->execute();
$peliculas = $stmtPeliculas->fetchAll(PDO::FETCH_ASSOC);

echo json_encode(['usuarios' => $usuarios, 'peliculas' => $peliculas]);
?>
