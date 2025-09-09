<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Contraseña</title>
    <link rel="stylesheet" href="../css/contrasena.css">
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="form-container">
        <h2>Establecer nueva contraseña</h2>
        <form action="../controlador/actualizar_password.php" method="POST">
            <input type="hidden" name="correo" value="<?php echo $_GET['correo']; ?>">

            <div class="password-wrapper">
                <input type="password" name="pass1" id="pass1" placeholder="Nueva contraseña" required>
                <i class="fas fa-eye toggle-password" toggle="#pass1"></i>
            </div>

            <div class="password-wrapper">
                <input type="password" name="pass2" id="pass2" placeholder="Confirmar contraseña" required>
                <i class="fas fa-eye toggle-password" toggle="#pass2"></i>
            </div>

            <input type="submit" value="Actualizar">
        </form>
    </div>

    <script>
        const toggles = document.querySelectorAll('.toggle-password');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const input = document.querySelector(this.getAttribute('toggle'));
                const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
                input.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        });
    </script>
</body>
</html>
