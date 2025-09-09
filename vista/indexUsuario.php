<?php
session_start();

include '../modelo/conexion.php';

if (isset($_SESSION['usuario']['nombre'])) {
} else {
    echo "No se ha encontrado usuario.";
}

// Si el carrito no está inicializado, lo inicializamos como un array vacío
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}
$carrito_count = count($_SESSION['carrito']);

// Consulta platillos disponibles
$sql = "SELECT * FROM platillos WHERE disponible = 1 ORDER BY idplatillo DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickOrder</title>
    <link rel="stylesheet" href="../css/index.css" />
    <link rel="stylesheet" href="../css/indexOscuro.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
</head>

<body>
    <header>
        <div class="container-hero">
            <div class="container hero">

                <label class="switch">
                    <input type="checkbox" id="toggle-dark-mode" />
                    <span class="slider">
                        <i class="fas fa-sun icon-sun"></i>
                        <i class="fas fa-moon icon-moon"></i>
                    </span>
                </label>

                <div class="customer-support">
                    <i class="fa-solid fa-headset"></i>
                    <div class="content-customer-support">
                        <span class="text">Soporte al cliente</span>
                        <span class="number">+57 318-487-2762</span>
                    </div>
                    <div id="contador-inactividad" style="position:fixed; bottom:10px; right:10px; background:#f8d7da; padding:10px; border-radius:5px; font-family:sans-serif;">
                        Inactividad: 0s
                    </div>
                </div>

                <div class="container-logo">
                    <i class="fa-duotone fa-solid fa-meteor"></i>
                    <h1 class="logo">QuickOrder</h1>
                </div>

                <div class="container-user">
                    <span class="text">Hola, <?php echo htmlspecialchars($_SESSION['usuario']['nombre']); ?></span>
                    <a href="carrito.php">
                        <i class="fa-solid fa-basket-shopping"></i>
                    </a>
                    <div class="content-shopping-cart">
                        <span class="text">Carrito</span>
                        <span class="number"><?php echo $carrito_count; ?></span>
                    </div>
                    <a href="../controlador/logout.php" style="margin-left: 15px; color: red;">Cerrar sesión</a>
                </div>
            </div>
        </div>

        <div class="container-navbar">
            <nav class="navbar container">
                <i class="fa-solid fa-bars"></i>

                <ul class="menu">
                    <li><a href="#platillos">Inicio</a></li>
                    <li><a href="#platillos">Entradas</a></li>
                    <li><a href="#platillos">Carnes</a></li>
                    <li><a href="#platillos">Hamburguesas</a></li>
                    <li><a href="#platillos">Bebidas</a></li>
                    <li><a href="#platillos">Licores</a></li>
                </ul>
                <div class="search-wrapper">
                    <i class="fa-solid fa-magnifying-glass" id="search-icon" title="Buscar"></i>
                    <input type="text" id="search-box" placeholder="Buscar platillos..." style="display: none;" />
                </div>
            </nav>
        </div>
    </header>

    <div class="banner">
        <div class="slider">
            <div class="slide slide1 active"></div>
            <div class="slide slide2"></div>
            <div class="slide slide3"></div>
        </div>

        <button class="prev">&#10094;</button>
        <button class="next">&#10095;</button>

        <div class="content-banner">
            <p>¡Platillos que enamoran!</p>
            <h2>LOS MEJORES EN COMIDA</h2>
            <a href="#platillos">Pedir ahora</a>
        </div>
    </div>

    <main class="main-content">

        <div style="height: 50px;"></div>

        <section class="container top-products" id="platillos">
            <h1 class="heading-1">Platillos Destacados</h1>

            <?php include '../controlador/mostrar_platillos.php'; ?>

        </section>

    </main>

    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 QuickOrder. Todos los derechos reservados.</p>
            <ul class="footer-links">
                <li><a href="#" onclick="alert('En QuickOrder, tu privacidad es una prioridad. Esta política describe cómo recopilamos, usamos y protegemos tu información personal cuando interactúas con nuestra plataforma. Nos comprometemos a mantener la seguridad de tus datos y a usarlos exclusivamente para mejorar tu experiencia en el restaurante, como el procesamiento de tus pedidos y la personalización del servicio.');">Política de privacidad</a></li>
                <li><a href="#" onclick="alert('Al usar el sistema QuickOrder, aceptas nuestros términos y condiciones. El uso de la plataforma está sujeto a las siguientes normas: todo pedido realizado a través del menú virtual es sujeto a confirmación y pago previo. Los servicios de entrega o atención al cliente pueden ser gestionados directamente a través del sistema, sin intervención de meseros. Nos reservamos el derecho de modificar los términos y condiciones en cualquier momento, y cualquier cambio será informado oportunamente.');">Términos de servicio</a></li>
                <li><a href="mailto:soporte@quickorder.com">Contáctanos</a></li>
            </ul>
        </div>
    </footer>

    <script src="../javascript/index.js"></script>
</body>

</html>