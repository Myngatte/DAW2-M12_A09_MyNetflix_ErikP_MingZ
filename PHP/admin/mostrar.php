<?php
include '../conection.php/conexion.php';

$vista = isset($_GET['vista']) ? $_GET['vista'] : '';

if ($vista === 'usuarios') {
    $sql = "SELECT tbl_users.id_usr, tbl_users.nombre_usr, tbl_users.apellido_usr, 
                   tbl_users.username, tbl_roles.nom_rol 
            FROM tbl_users 
            INNER JOIN tbl_roles ON tbl_users.rol_user = tbl_roles.id_rol
            ORDER BY tbl_users.id_usr";
} elseif ($vista === 'pelis') {
    $sql = "SELECT id_peli, nom_peli, descripcion, duracion, portada 
            FROM tbl_pelis 
            ORDER BY id_peli";
} else {
    echo json_encode(["error" => "Vista no válida"]);
    exit;
}

$stmt = $conn->query($sql);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($data);


