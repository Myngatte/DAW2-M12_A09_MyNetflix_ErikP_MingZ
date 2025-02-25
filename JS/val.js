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
    document.getElementById('fecha_nac').addEventListener('blur', function() {
        validarDesc(this);
    });
    document.getElementById('password').addEventListener('blur', function() {
        validarPswd(this);
    });
    document.getElementById('rep').addEventListener('blur', function() {
        validarRepPswd(this);
    });
};

// ------------------------------------------------------------------------------------------------------------------
// Validar campos

function validarFormulario() {
    let usuarioValido = validarUsuario(document.getElementById('username'));
    let emailValido = validarEmail(document.getElementById('email'));
    let nombreValido = validarNombre(document.getElementById('nombre'));
    let apellidoValido = validarApellido(document.getElementById('apellido'));
    let descValido = validarDesc(document.getElementById('fecha_nac'));
    let pswdValido = validarPswd(document.getElementById('password'));
    let repValido = validarRepPswd(document.getElementById('password'));

    return usuarioValido && emailValido && nombreValido && apellidoValido && descValido && pswdValido && repValido;
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
    const regexNombre = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s[A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/

    if (nameField === "") {
        nameError.textContent = "El nombre no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (!regexNombre.test(nameField)) {
        pswdError.textContent = "Un nombre solo puede contener letras.";
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
    const regexAp = /^[A-Za-zÁÉÍÓÚáéíóúÑñ]+(?:\s[A-Za-zÁÉÍÓÚáéíóúÑñ]+)*$/

    if (surnameField === "") {
        surnameError.textContent = "El apellido no puede estar vacío.";
        input.classList.add("error");
        return false;
    }

    if (!regexAp.test(surnameField)) {
        pswdError.textContent = "Un apellido solo puede contener letras.";
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


// VALIDACION fecha_nac
// - No puede contener mas de 100 caracteres.

function validarDesc(input) {
    const fechField = new Date(input.value);
    const hoy = new Date();
    const fechError = document.getElementById("fecha_nac_mal");

    // Calcular la edad
    let edad = hoy.getFullYear() - fechField.getFullYear();
    const mes = hoy.getMonth() - fechField.getMonth();

    if (mes < 0 || (mes === 0 && hoy.getDate() < fechField.getDate())) {
      edad--;
    }

    if (edad < 16) {
        fechError.textContent = "Debes de tener más de 16 años para crearte una cuenta.";
        input.classList.add("error");
        return false;
    }

    fechError.textContent = "";
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
    const regexPswd = /^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if (pswdField === "") {
        pswdError.textContent = "La contraseña no puede estar vacía.";
        input.classList.add("error");
        return false;
    }
    
    if (!regexPswd.test(pswdField)) {
        pswdError.textContent = "La contraseña debe tener una mayúscula y minúscula, un número, un carácter especial y ha de ser de un mínimo de 8 carácteres.";
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

function validarRepPswd(input){
    const repPswdField = input.value.trim();
    const pswdField = document.getElementById("password").value.trim();
    const repError = document.getElementById("rep_mal").value.trim();

    if (repPswdField != pswdField){
        repError.textContent = "Se ha de repetir la contraseña correctamente";
        input.classList.add("error");
        return false;
    }

    repError.textContent = "";
    input.classList.remove("error");

    return true;
}

// window.onload = function() {
//     document.getElementById('formLogin').addEventListener('submit', function(event) {
//         if (!validarLogin()) {
//             event.preventDefault();
//         }
//     });    
// };

// function validarFormulario() {
//     let userValido = validarUser(document.getElementById('user'));
//     let pwdValido = validarLoginPwd(document.getElementById('password'));


//     return userValido && pwdValido;
// }

// function validarUser(input){

// }