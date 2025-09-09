document.querySelector('input[name="documento"]').addEventListener('input', function() {
    this.value = this.value.replace(/[^0-9]/g, '');
});

document.getElementById('registroForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const nombre = this.nombre.value.trim();
    const apellido = this.apellido.value.trim();
    const correo = this.correo.value.trim();
    const usuario = this.user.value.trim();
    const documento = this.documento.value.trim();
    const pass = document.getElementById('pass').value;
    const passr = document.getElementById('passr').value;
    const terms = this.querySelector('input[name="terms"]');
    const errorMsg = document.getElementById('error-msg');
    let errores = [];

    if (!nombre) errores.push("El nombre es obligatorio.");
    else if (nombre.length > 80) errores.push("El nombre no puede tener más de 80 caracteres.");

    if (!apellido) errores.push("El apellido es obligatorio.");
    else if (apellido.length > 80) errores.push("El apellido no puede tener más de 80 caracteres.");

    if (!correo) errores.push("El correo es obligatorio.");
    if (!usuario) errores.push("El usuario es obligatorio.");
    if (!documento) errores.push("El número de documento es obligatorio.");

    if (!pass) errores.push("La contraseña es obligatoria.");
    if (!passr) errores.push("Repetir la contraseña es obligatorio.");
    if (!terms.checked) errores.push("Debes aceptar los Términos de Uso.");

    // Validar email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (correo && !emailRegex.test(correo)) errores.push("Correo electrónico no válido.");

    // Validar nombre y apellido solo letras y espacios
    const nombreRegex = /^[a-zA-ZÁÉÍÓÚáéíóúñÑ\s]+$/;
    if (nombre && !nombreRegex.test(nombre)) errores.push("El nombre solo puede contener letras y espacios.");
    if (apellido && !nombreRegex.test(apellido)) errores.push("El apellido solo puede contener letras y espacios.");

    // Validar usuario
    const usuarioRegex = /^[a-zA-Z0-9_]+$/;
    if (usuario && !usuarioRegex.test(usuario)) errores.push("El usuario solo puede contener letras, números y guiones bajos.");
    if (usuario.length < 4 || usuario.length > 20) errores.push("El usuario debe tener entre 4 y 20 caracteres.");

    // Validar documento solo números y longitud entre 5 y 15
    if (documento && !/^[0-9]+$/.test(documento)) errores.push("El número de documento solo puede contener números.");
    if (documento.length < 5 || documento.length > 15) errores.push("El número de documento debe tener entre 5 y 15 dígitos.");

    // Validar contraseña
    if (pass.length < 8) errores.push("La contraseña debe tener al menos 8 caracteres.");
    if (!/[a-z]/.test(pass)) errores.push("La contraseña debe contener minúsculas.");
    if (!/[A-Z]/.test(pass)) errores.push("La contraseña debe contener mayúsculas.");
    if (pass !== passr) errores.push("Las contraseñas no coinciden.");

    if (errores.length > 0) {
        errorMsg.innerHTML = errores.join("<br>");
        errorMsg.style.display = 'block';
    } else {
        errorMsg.style.display = 'none';
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.disabled = true;
        submitBtn.innerText = "Enviando...";
        this.submit();
    }
});

// Cambiar tipo y ícono de contraseña
function togglePassword(id) {
    const field = document.getElementById(id);
    const icon = document.getElementById('toggleIcon-' + id);

    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
