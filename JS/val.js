// Validaciones del form crear empleado

// ------------------------------------------------------------------------------------------------------------------
// Para prevenir que se envie el formulario

window.onload = function() {
    document.getElementById('formRegister').addEventListener('submit', function(event) {
        if (!validarFormulario()) {
            event.preventDefault();
        }
    });
    document.getElementById('username').addEventListener('keyup', function() {
        validarUsuario(this);
    });
    document.getElementById('username').addEventListener('blur', function() {
        validarUsuario(this);
    });
    document.getElementById('email').addEventListener('keyup', function() {
        validarEmail(this);
    });
    document.getElementById('email').addEventListener('blur', function() {
        validarEmail(this);
    });
    document.getElementById('nombre').addEventListener('keyup', function() {
        validarNombre(this);
    });
    document.getElementById('nombre').addEventListener('blur', function() {
        validarNombre(this);
    });
    document.getElementById('apellido').addEventListener('keyup', function() {
        validarApellido(this);
    });
    document.getElementById('apellido').addEventListener('blur', function() {
        validarApellido(this);
    });
    document.getElementById('descripcion').addEventListener('keyup', function() {
        validarDesc(this);
    });
    document.getElementById('descripcion').addEventListener('blur', function() {
        validarDesc(this);
    });
    document.getElementById('password').addEventListener('keyup', function() {
        validarPswd(this);
    });
    document.getElementById('password').addEventListener('blur', function() {
        validarPswd(this);
    });
};

// ------------------------------------------------------------------------------------------------------------------
// Validar campos

function validarFormulario() {
    let usuarioValido = validarUsuario(document.getElementById('username'));
    let emailValido = validarEmail(document.getElementById('email'));
    let nombreValido = validarNombre(document.getElementById('nombre'));
    let apellidoValido = validarApellido(document.getElementById('apellido'));
    let descValido = validarDesc(document.getElementById('descripcion'));
    let pswdValido = validarPswd(document.getElementById('password'));

    return usuarioValido && emailValido && nombreValido && apellidoValido && descValido && pswdValido;
}

// ------------------------------------------------------------------------------------------------------------------
// Validaciones campos

// VALIDACION USUARIO
// - No puede estar vacío.
// - No puede contener mas de 30 caracteres.

function validarUsuario(input) {
    const userField = input.value.trim();
    const userError = document.getElementById("username_mal");

    if (userField === "") {
        userError.textContent = "El nombre de usuario no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (userField.length > 30) {
        userError.textContent = "El nombre de usuario no puede contener mas de 30 caracteres.";
        input.classList.add("error");
        return false;
    }

    userError.textContent = "";
    input.classList.remove("error");

    return true;
}


// VALIDACION EMAIL
// - No puede estar vacio
// - Formato email
// - No puede contener mas de 50 caracteres

function validarEmail(input) {
    const emailField = input.value.trim();
    const emailError = document.getElementById("correo_mal");
    const regexCorreo = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if (emailField === "") {
        emailError.textContent = "El email no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (!regexCorreo.test(emailField)) {
        emailError.textContent = "El email no tiene el formato correcto.";
        input.classList.add("error");
        return false;
    }

    if (emailField.length > 50) {
        emailError.textContent = "El campo no puede contener más de 50 caracteres.";
        input.classList.add("error");
        return false;
    }

    emailError.textContent = "";
    input.classList.remove("error");

    return true;
}


// VALIDACION NOMBRE
// - No puede estar vacío.
// - No puede contener mas de 50 caracteres.

function validarNombre(input) {
    const nameField = input.value.trim();
    const nameError = document.getElementById("nombre_mal");

    if (nameField === "") {
        nameError.textContent = "El nombre no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (nameField.length > 50) {
        nameError.textContent = "El nombre no puede contener mas de 50 caracteres.";
        input.classList.add("error");
        return false;
    }

    nameError.textContent = "";
    input.classList.remove("error");

    return true;
}


// VALIDACION APELLIDO
// - No puede estar vacío
// - No puede contener mas de 50 caracteres

function validarApellido(input) {
    const surnameField = input.value.trim();
    const surnameError = document.getElementById("apellido_mal");

    if (surnameField === "") {
        surnameError.textContent = "El apellido no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (surnameField.length > 50) {
        surnameError.textContent = "El apellido no puede contener mas de 60 caracteres.";
        input.classList.add("error");
        return false;
    }

    surnameError.textContent = "";
    input.classList.remove("error");

    return true;
}


// VALIDACION DESCRIPCION
// - No puede contener mas de 100 caracteres.

function validarDesc(input) {
    const descField = input.value.trim();
    const descError = document.getElementById("descripcion_mal");

    if (descField.length > 100) {
        descError.textContent = "La descripcion no puede contener mas de 100 caracteres.";
        input.classList.add("error");
        return false;
    }

    descError.textContent = "";
    input.classList.remove("error");

    return true;
}


// VALIDACION PASSWORD
// - No puede estar vacío.
// - Minimo 6 caracteres
// - No puede contener mas de 60 caracteres.

function validarPswd(input) {
    const pswdField = input.value.trim();
    const pswdError = document.getElementById("pswd_mal");

    if (pswdField === "") {
        pswdError.textContent = "La contraseña no puede estar vacía.";
        input.classList.add("error");
        return false;
    }

    if (pswdField.length < 6) {
        pswdError.textContent = "La contraseña tiene que tener minimo 6 caracteres.";
        input.classList.add("error");
        return false;
    }

    if (pswdField.length > 60) {
        pswdError.textContent = "La contraseña no puede contener mas de 60 caracteres.";
        input.classList.add("error");
        return false;
    }

    pswdError.textContent = "";
    input.classList.remove("error");

    return true;
}