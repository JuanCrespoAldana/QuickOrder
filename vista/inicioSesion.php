<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../css/iniciodesesion.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="login-container">
        <i class="fa-solid fa-meteor fa-6x"></i>
        <h2>Bienvenido</h2>

        <form action="../controlador/login.php" method="POST">
            <div class="input-group">
                <i class="fa-solid fa-user icon-left"></i>
                <input type="text" name="user" placeholder="Usuario" required />
            </div>

            <div class="input-group">
                <i class="fa-solid fa-lock icon-left"></i>
                <input type="password" id="pass" name="pass" placeholder="Contraseña" required />
                <i id="toggleIcon-pass" class="fa-solid fa-eye icon-right" onclick="togglePassword('pass')"></i>
            </div>

            <div class="links">
                <a href="../vista/olvideContrasena.php">Olvidé mi contraseña</a>
                <a href="../vista/registro.php">Registrarse</a>
            </div>

            <div id="error-msg" style="display:none; color: red; font-size: 13px; margin-bottom: 10px;"></div>
            <div id="contador-errores" style="display:none; color: #c7a17a; font-size: 13px; margin-bottom: 10px;"></div>

            <input name="btningresar" class="btn" type="submit" value="Iniciar Sesión" />

            <div class="back-container">
                <a href="../index.php" class="back-link">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                </a>
            </div>

        </form>
    </div>

    <script src="../javascript/validacionInicioSesion.js"></script>
</body>

</html>