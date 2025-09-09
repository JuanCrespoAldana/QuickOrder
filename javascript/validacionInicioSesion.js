document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('form');
    const btnIngresar = form.querySelector('input[name="btningresar"]');
    const userInput = form.querySelector('input[name="user"]');
    const passInput = form.querySelector('input[name="pass"]');
    const errorMsg = document.getElementById('error-msg');
    const contador = document.getElementById('contador-errores');

    let intentos = parseInt(localStorage.getItem('intentosFallidos')) || 0;
    let bloqueoActivo = false;

    if (intentos >= 3) {
        iniciarBloqueo();
    } else {
        actualizarContador();
    }

    form.addEventListener('submit', function (e) {
        if (bloqueoActivo) {
            e.preventDefault();
            return;
        }

        let errores = [];
        const usuario = userInput.value.trim();
        const pass = passInput.value.trim();

        if (usuario === '') errores.push('El usuario es obligatorio.');
        if (pass === '') errores.push('La contraseña es obligatoria.');

        if (errores.length > 0) {
            e.preventDefault();
            mostrarError(errores.join('<br>'));
            return;
        }
    });

    function mostrarError(msg) {
        errorMsg.innerHTML = msg;
        errorMsg.style.display = 'block';
    }

    function actualizarContador() {
        if (intentos > 0 && intentos < 3) {
            contador.textContent = `Intentos fallidos: ${intentos} de 3`;
            contador.style.display = 'block';
        } else {
            contador.textContent = '';
            contador.style.display = 'none';
        }
    }

    function iniciarBloqueo() {
        bloqueoActivo = true;
        btnIngresar.disabled = true;
        let tiempo = 30;
        btnIngresar.value = `Espera ${tiempo}s`;
        contador.textContent = 'Has alcanzado el límite de intentos. Intenta nuevamente en 30 segundos.';

        const intervalo = setInterval(() => {
            tiempo--;
            btnIngresar.value = `Espera ${tiempo}s`;
            if (tiempo <= 0) {
                clearInterval(intervalo);
                btnIngresar.disabled = false;
                btnIngresar.value = 'INICIAR SESIÓN';
                bloqueoActivo = false;
                intentos = 0;
                localStorage.setItem('intentosFallidos', '0');
                errorMsg.style.display = 'none';
                contador.textContent = '';
            }
        }, 1000);
    }

    window.loginError = function () {
        intentos++;
        localStorage.setItem('intentosFallidos', intentos.toString());
        mostrarError('Usuario o contraseña incorrectos.');
        actualizarContador();
        if (intentos >= 3) {
            iniciarBloqueo();
        }
    };

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('error') === '1') {
        loginError();
        history.replaceState(null, '', window.location.pathname);
    }
});

function togglePassword(fieldName) {
    const field = document.querySelector(`input[name="${fieldName}"]`);
    const icon = document.getElementById('toggleIcon-' + fieldName);

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
