<?php
    // Puedes agregar configuraciones adicionales aquí si es necesario
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meiga - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./CSS/index.css">
</head>
<body>
    <div class="overlay"></div>
    <div class="container vh-100 d-flex align-items-center justify-content-center">
        <div class="container-content text-center">
            <img src="logo.png" alt="Meiga Logo" class="logo">
            <h1>¡Bienvenido a Meiga!</h1>
            <div class="row mt-4 justify-content-center">
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <p>Si eres nuevo:</p>
                    <a href="./view/register.php" class="btn btn-custom">Registrarse</a>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <p>Si ya eres uno de los nuestros:</p>
                    <a href="./view/login.php" class="btn btn-custom">Inicia Sesión</a>  
                </div>
            </div>
        </div>
    </div>
</body>
</html>
