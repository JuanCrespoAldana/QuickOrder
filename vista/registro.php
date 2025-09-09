<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario</title>
    <link rel="stylesheet" href="../css/registro.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <div class="register-container">

        <i class="fa-solid fa-meteor logo"></i>

        <h2>Regístrate</h2>

        <div id="error-msg"></div>

        <?php
        if (isset($_SESSION['error'])) {
            echo '<div id="error-msg" style="display:block;">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']);
        }
        ?>

        <form id="registroForm" action="../controlador/registrar.php" method="POST">

            <div class="form-group input-icon-group">
                <i class="fa-solid fa-user icon"></i>
                <input type="text" name="nombre" placeholder="Nombre" required maxlength="80">
            </div>

            <div class="form-group input-icon-group">
                <i class="fa-solid fa-user icon"></i>
                <input type="text" name="apellido" placeholder="Apellido" required maxlength="80">
            </div>

            <div class="input-icon-group">
                <select name="tipo_documento" required>
                    <option value="">Seleccione tipo de documento</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
                <i class="fas fa-id-card icon"></i>
            </div>

            <div class="form-group input-icon-group">
                <i class="fa-solid fa-id-badge icon"></i>
                <input type="text" name="documento" placeholder="Número de documento" required maxlength="15" />
            </div>

            <div class="form-group input-icon-group">
                <i class="fa-solid fa-envelope icon"></i>
                <input type="email" name="correo" placeholder="Correo Electrónico" required>
            </div>

            <div class="form-group input-icon-group">
                <i class="fa-solid fa-user-tag icon"></i>
                <input type="text" name="user" placeholder="Usuario" required>
            </div>

            <div class="input-icon-group password-container">
                <input type="password" id="pass" name="pass" placeholder="Contraseña" required>
                <i class="fas fa-lock icon"></i>
                <i class="fas fa-eye toggle-pass" id="toggleIcon-pass" onclick="togglePassword('pass')"></i>
            </div>

            <div class="input-icon-group password-container">
                <input type="password" id="passr" name="passr" placeholder="Repetir contraseña" required>
                <i class="fas fa-lock icon"></i>
                <i class="fas fa-eye toggle-pass" id="toggleIcon-passr" onclick="togglePassword('passr')"></i>
            </div>

            <label class="terms-label">
                <input type="checkbox" id="terms" name="terms" required> Acepto los <a href="#" onclick="alert('Al usar el sistema QuickOrder, aceptas nuestros términos y condiciones. El uso de la plataforma está sujeto a las siguientes normas: todo pedido realizado a través del menú virtual es sujeto a confirmación y pago previo. Los servicios de entrega o atención al cliente pueden ser gestionados directamente a través del sistema, sin intervención de meseros. Nos reservamos el derecho de modificar los términos y condiciones en cualquier momento, y cualquier cambio será informado oportunamente.');">Términos de Uso</a>
            </label>

            <button type="submit" name="registrar" class="register-button">Registrase</button>


            <div class="back-container">
                <a href="../vista/inicioSesion.php" class="back-link">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                </a>
            </div>

        </form>
    </div>

    <script src="../javascript/validacionRegistro.js"></script>

</body>

</html>