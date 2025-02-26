<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
    <h2>Login</h2>
    <form action="../PHP/user/login.php" method="POST" class="form-section">
    <img src="../IMG/Web/logo.png" alt="Meiga Logo" class="logo">

    <label for="user">Nombre de Usuario:</label>
    <input type="text" id="user" name="user"><br><br>

    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password"><br><br>

    <a href="./register.php">¿No tienes una cuenta? Regístrate </a>
    <br><br>

    <button type="submit">Login</button>
    </form>
</body>
</html>