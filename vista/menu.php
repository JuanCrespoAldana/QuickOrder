<?php
session_start();

if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

// Agregar al carrito
if (isset($_POST['producto_id'])) {
    $producto_id = $_POST['producto_id'];
    $nombre_producto = $_POST['nombre_producto'];
    $precio_producto = $_POST['precio_producto'];

    // Agregar el producto al carrito
    $_SESSION['carrito'][] = [
        'id' => $producto_id,
        'nombre' => $nombre_producto,
        'precio' => $precio_producto
    ];
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - QuickOrder</title>
    <link rel="stylesheet" href="css/index.css" />
</head>

<body>
    <header>
        <h1>Menú de Platillos</h1>
        <nav>
            <a href="index.php">Volver a inicio</a>
        </nav>
    </header>

    <main>
        <div class="product-card">
            <h3>Pollo En Especies</h3>
            <p>$80.000</p>
            <form action="menu.php" method="POST">
                <input type="hidden" name="producto_id" value="1">
                <input type="hidden" name="nombre_producto" value="Pollo En Especies">
                <input type="hidden" name="precio_producto" value="80000">
                <button type="submit">Añadir al carrito</button>
            </form>
        </div>
        <div class="product-card">
            <h3>Salmon Inglés</h3>
            <p>$92.000</p>
            <form action="menu.php" method="POST">
                <input type="hidden" name="producto_id" value="2">
                <input type="hidden" name="nombre_producto" value="Salmon Inglés">
                <input type="hidden" name="precio_producto" value="92000">
                <button type="submit">Añadir al carrito</button>
            </form>
        </div>
        <div class="product-card">
            <h3>Macarrones Italianos</h3>
            <p>$75.000</p>
            <form action="menu.php" method="POST">
                <input type="hidden" name="producto_id" value="3">
                <input type="hidden" name="nombre_producto" value="Macarrones Italianos">
                <input type="hidden" name="precio_producto" value="75000">
                <button type="submit">Añadir al carrito</button>
            </form>
        </div>
    </main>

</body>

</html>