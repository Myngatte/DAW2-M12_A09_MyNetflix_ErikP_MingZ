<?php
header('Content-Type: application/json'); // Asegura que la respuesta sea JSON

require_once "../conection/conexion.php"; // Incluye el archivo de conexión

// Verifica que se hayan enviado los datos necesarios
if (!isset($_POST['user']) || !isset($_POST['password'])) {
    echo json_encode(['existe' => false, 'valid' => false, 'error' => 'Datos incompletos']);
    exit();
}

$usernameOrEmail = $_POST['user'];
$password = $_POST['password'];

try {
    // Busca el usuario en la base de datos
    $stmt = $conn->prepare("SELECT id_usr, username, email, contrasena, estado FROM tbl_users WHERE username = :user OR email = :user LIMIT 1");
    $stmt->bindParam(':user', $usernameOrEmail, PDO::PARAM_STR);
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        // Verifica la contraseña
        if (password_verify($password, $result['contrasena'])) {
            if ($result['estado'] === 'Pendiente') {
                echo json_encode([
                    'existe' => true,
                    'valid' => true,
                    'pendiente' => true, // Indica que el usuario está pendiente
                    'error' => 'Tu cuenta está pendiente de aprobación.'
                ]);
            } else {
                echo json_encode([
                'existe' => true,
                'valid' => true
                ]);
            }
            
        } else {
            echo json_encode([
                'existe' => true,
                'valid' => false
            ]);
        }
    } else {
        // Usuario no encontrado
        echo json_encode([
            'existe' => false,
            'valid' => false
        ]);
    }

} catch (PDOException $e) {
    // En caso de error en la base de datos
    echo json_encode([
        'existe' => false,
        'valid' => false,
        'error' => 'Error en la base de datos: ' . $e->getMessage()
    ]);
}