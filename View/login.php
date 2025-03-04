<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../CSS/login.css">
</head>
<body>
<?php if(isset($_GET['register']) && $_GET['register'] === 'success'): ?>
  <script>
    Swal.fire({
      title: 'Login completado!',
      text: 'El login se ha completado con éxito.',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });
  </script>
  <?php endif; ?>
  <h2>Formulario de Login</h2>
    <form method="POST" id="formLogin">
        <img src="../IMG/Web/logo.png" alt="Logo" class="logo">
      
        <label for="username">Usuario/Email</label>
        <input type="text" id="user" name="user"><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>
        <span style="color: red;" id="login_mal"></span><br><br>
        
        <button type="submit">Login</button><br><br>
        <a href="./register.php">¿No tienes una cuenta? Regístrate</a>
    </form>
    <script src="../JS/login.js"></script>
</body>
</html>