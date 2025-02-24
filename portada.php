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
    <style>
        body {
            background: url('fondoPortada.png') no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
        }
        .overlay {
            background: rgba(7, 98, 42, 0.65);
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
            border-radius: 10%;
        }
        .btn-custom {
            background-color:rgb(0, 55, 109);
            color:rgb(0, 116, 232);
            border-radius: 5px;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #001F3F;
        }
    </style>
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
                    <a href="registro.php" class="btn btn-custom">Registrarse</a>
                </div>
                <div class="col-md-6 d-flex flex-column align-items-center">
                    <p>Si ya eres uno de los nuestros:</p>
                    <a href="login.php" class="btn btn-custom">Inicia Sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
