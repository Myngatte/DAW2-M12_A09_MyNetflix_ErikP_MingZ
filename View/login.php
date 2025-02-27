<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../CSS/index.css">
</head>
<body>
<?php if(isset($_GET['register']) && $_GET['register'] === 'success'): ?>
  <script>
    Swal.fire({
      title: '¡Registro completado!',
      text: 'El registro se ha completado con éxito.',
      icon: 'success',
      confirmButtonText: 'Aceptar'
    });
  </script>
  <?php endif; ?>
  <h2>Formulario de Registro</h2>
    <form method="POST" id="formLogin">
        <label for="username">Usuario/Email</label>
        <input type="text" id="user" name="user"><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password"><br><br>
        <span style="color: red;" id="login_mal"></span><br><br>
        
        <button type="submit">Registrar</button>
    </form>
    <script src="../JS/login.js"></script>
</body>
</html>