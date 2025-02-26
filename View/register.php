<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="../CSS/register.css">
</head>
<body>
<h2>Formulario de Registro</h2>
<div class="container">
<div class="form-section">
    <form action="../PHP/user/register.php" method="POST" class="form-container">
        <div class="form-column">
            <!-- Primera columna -->
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" placeholder="ej: Paco013"><br><br>
            <span style="color: red;" id="username_mal"><?php echo (isset($_GET['error']) && $_GET['error'] === "emailExistente") ? "Este email ya existe." : "";?></span>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" placeholder="ej: paco013@example.com"><br><br>
            <span style="color: red;" id="correo_mal"><?php echo (isset($_GET['error']) && $_GET['error'] === "emailExistente") ? "Este email ya existe." : "";?></span>

            <label for="nombre_usr">Nombre:</label>
            <input type="text" id="nombre_usr" name="nombre_usr" placeholder="ej: Paco"><br><br>

            <label for="apellido_usr">Apellido:</label>
            <input type="text" id="apellido_usr" name="apellido_usr" placeholder="ej: Cerotrece"><br><br>

            <label for="genero_usr">Género:</label>
            <select id="genero_usr" name="genero_usr">
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select><br><br>
        </div>
        <div class="form-column2">
            <!-- Segunda columna -->
            <img src="../IMG/Web/logo.png" alt="Meiga Logo" class="logo">

            <label for="fecha_nac">Fecha de Nacimiento:</label>
            <input type="date" id="fecha_nac" name="fecha_nac"><br><br>
            <label for="contrasena">Contraseña:</label>
            <input type="password" id="contrasena" name="contrasena"><br><br>

            <label for="confirmar_contrasena">Confirmar Contraseña:</label>
            <input type="password" id="confirmar_contrasena" name="confirmar_contrasena"><br><br>

        </div>
    </form>
    <div class="form-button">
        <a class="login-link" href="./login.php">Ya tienes una cuenta? Inicia sesión</a>
        <button type="submit">Registrarse</button>
    </div>
</div>
</div>
</body>
</html>
