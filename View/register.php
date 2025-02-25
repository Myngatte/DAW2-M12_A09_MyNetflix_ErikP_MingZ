<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <script src="../JS/val.js"></script>
    <link rel="stylesheet" href="../CSS/main.css">
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="../PHP/user/register.php" method="POST" id="formRegister">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username"><br>
        <span style="color: red;" id="username_mal"></span><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email"><br>
        <span style="color: red;" id="correo_mal"></span><br><br>


        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre"><br>
        <span style="color: red;" id="nombre_mal"></span><br><br>


        <label for="apellido_usr">Apellido:</label>
        <input type="text" id="apellido" name="apellido"><br>
        <span style="color: red;" id="apellido_mal"></span><br><br>


        <label for="fecha_nac">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nac" name="fecha_nac"><br>
        <span style="color: red;" id="fecha_nac_mal"></span><br><br>


        <label for="genero_usr">Género:</label>
        <select id="genero_usr" name="genero_usr">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select><br><br>


        <label for="contrasena">Contraseña:</label>
        <input type="password" id="password" name="password"><br>
        <span style="color: red;" id="pswd_mal"></span><br><br>

        <label for="contrasena">Repetir Contraseña:</label>
        <input type="password" id="rep" name="password"><br>
        <span style="color: red;" id="rep_mal"></span><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
