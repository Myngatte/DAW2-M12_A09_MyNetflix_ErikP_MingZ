<?php
require_once "../conection/conexion.php";

try {
    // Verificar si el formulario fue enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Recuperar datos del formulario
        $username = $_POST['username'];
        $email = $_POST['email'];
        $contrasena = password_hash($_POST['password'], PASSWORD_BCRYPT); 
        $nombre_usr = $_POST['nombre'];
        $apellido_usr = $_POST['apellido'];
        $fecha_nac = $_POST['fecha_nac'];
        $genero_usr = $_POST['genero_usr'];
        $estado = 'Pendiente'; 
        $rol_user = 2;

        $sqlUser = "SELECT * FROM tbl_USERS WHERE username = :usr";
        $stmt1 = $conn->prepare($sqlUser);
        $stmt1->bindParam(':usr', $username);
        $stmt1->execute();
        $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        if ($result1 && count($result1) > 0) {
            header("Location: ../../View/register.php?error=usuarioExistente"); 
            exit();
        }

        $checkEmail = "SELECT * FROM tbl_USERS WHERE email = :em";
        $stmt = $conn->prepare($checkEmail);
        $stmt->bindParam(':em', $email); 
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && count($result) > 0) {
            header("Location: ../../View/register.php?error=emailExistente"); 
            exit();
        }

        // Preparar la consulta SQL
        $sql = "INSERT INTO tbl_users (username, email, contrasena, nombre_usr, apellido_usr, fecha_nac, genero_usr, estado, rol_user)
                VALUES (:username, :email, :contrasena, :nombre_usr, :apellido_usr, :fecha_nac, :genero_usr, :estado, :rol_user)";
        $stmt = $conn->prepare($sql);

        // Vincular parámetros
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->bindParam(':nombre_usr', $nombre_usr);
        $stmt->bindParam(':apellido_usr', $apellido_usr);
        $stmt->bindParam(':fecha_nac', $fecha_nac);
        $stmt->bindParam(':genero_usr', $genero_usr);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':rol_user', $rol_user);

        // Ejecutar la consulta
        $stmt->execute();

        // Mensaje de éxito
        header("Location: ../../View/login.php?register=success");
        exit();
    }
} catch (PDOException $e) {
    // Manejo de errores
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    $conn = null;
}
?>