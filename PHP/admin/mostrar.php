<?php
require_once '../conection/conexion.php';

$vista = isset($_GET['vista']) ? $_GET['vista'] : '';

if ($vista === 'usuarios') {
    $sql = "SELECT tbl_users.id_usr, tbl_users.nombre_usr, tbl_users.apellido_usr, 
                   tbl_users.username, tbl_users.fecha_nac, tbl_users.genero_usr,
                   tbl_users.email, tbl_roles.nom_rol 
            FROM tbl_users 
            INNER JOIN tbl_roles ON tbl_users.rol_user = tbl_roles.id_rol
            WHERE tbl_users.estado = 'Aceptado'
            ORDER BY tbl_users.id_usr";
} elseif ($vista === 'pelis') {
    $sql = "SELECT p.*, 
            GROUP_CONCAT(g.nom_genero) as nombres_generos,
            GROUP_CONCAT(g.id_genero) as ids_generos
            FROM tbl_pelis p 
            LEFT JOIN genero_peli gp ON p.id_peli = gp.id_pelicula
            LEFT JOIN tbl_pgeneros g ON gp.id_genero = g.id_genero
            GROUP BY p.id_peli";
} else {
    echo json_encode(["error" => "Vista no válida"]);
    exit;
}

$stmt = $conn->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


