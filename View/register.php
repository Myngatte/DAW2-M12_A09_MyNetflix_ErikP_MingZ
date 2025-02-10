<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="username">Nombre de Usuario:</label>
        <input type="text" id="username" name="username"><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email"><br><br>

        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena"><br><br>

        <label for="nombre_usr">Nombre:</label>
        <input type="text" id="nombre_usr" name="nombre_usr"><br><br>

        <label for="apellido_usr">Apellido:</label>
        <input type="text" id="apellido_usr" name="apellido_usr"><br><br>

        <label for="fecha_nac">Fecha de Nacimiento:</label>
        <input type="date" id="fecha_nac" name="fecha_nac"><br><br>

        <label for="genero_usr">Género:</label>
        <select id="genero_usr" name="genero_usr">
            <option value="Masculino">Masculino</option>
            <option value="Femenino">Femenino</option>
        </select><br><br>

        <button type="submit">Registrar</button>
    </form>
</body>
</html>
