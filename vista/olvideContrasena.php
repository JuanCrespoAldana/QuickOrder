<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Olvidé mi Contraseña</title>
    <link rel="stylesheet" href="../css/contrasena.css">
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="form-container">
        <h2>Recuperar Contraseña</h2>

        <form action="../controlador/enviar_codigo.php" method="POST">

            <input type="email" name="correo" placeholder="Correo registrado" required>

            <input type="submit" value="Enviar código">


            <div class="back-container">
                <a href="../vista/inicioSesion.php" class="back-link">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                </a>
            </div>

        </form>
    </div>
</body>

</html>