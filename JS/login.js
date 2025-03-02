document.getElementById('formLogin').addEventListener('submit', async function(event) {
    event.preventDefault();

    const user = document.getElementById('user').value;
    const password = document.getElementById('password').value;
    const loginError = document.getElementById('login_mal');

    try {
        const response = await fetch('../PHP/user/login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `user=${encodeURIComponent(user)}&password=${encodeURIComponent(password)}`
        });

        if (!response.ok) {
            throw new Error('Error en la comunicación con el servidor.');
        }

        const result = await response.json();
        console.log("Respuesta del servidor:", result); // Verifica la respuesta

        if (result.existe) {
            if (result.pendiente) {
                // Muestra un SweetAlert si el usuario está pendiente
                Swal.fire({
                    title: 'Pendiente de Aceptación',
                    text: 'Tu cuenta está pendiente de ser aceptada. Por favor, espera a que sea aprobada por el administrador.',
                    icon: 'info',
                    confirmButtonText: 'Aceptar'
                });
            } else if (result.valid) {
                // Redirige al usuario si las credenciales son válidas
                window.location.href = "../main.php";
            } else {
                // Muestra un mensaje de error si las credenciales son incorrectas
                loginError.textContent = 'Las credenciales son incorrectas.';
            }
        } else {
            // Muestra un mensaje de error si el usuario no existe
            loginError.textContent = 'El usuario o email no existen.';
        }

    } catch (error) {
        console.error('Error:', error);
        loginError.textContent = 'Error al conectar con el servidor. Inténtelo de nuevo más tarde.';
    }
});