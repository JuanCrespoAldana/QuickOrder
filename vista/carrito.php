<?php
session_start();
$carrito = $_SESSION['carrito'] ?? [];
$subtotal = 0;

// Calcular subtotal inicial
foreach ($carrito as $item) {
    $subtotal += $item['precio'] * ($item['cantidad'] ?? 1);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito - QuickOrder</title>
    <link rel="stylesheet" href="../css/carrito.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <div class="carrito-wrapper">
        <div class="carrito-container">
            <h2>Tu Carrito</h2>

            <?php if (empty($carrito)) : ?>
                <div class="carrito-vacio">
                    <p>No hay productos en tu carrito.</p>
                </div>
                <div class="back-container">
                    <a href="../vista/indexUsuario.php" class="back-link">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                    </a>
                </div>
            <?php else : ?>
                <div class="carrito-items">
                    <?php foreach ($carrito as $index => $item): ?>
                        <div class="carrito-item" data-index="<?= $index ?>">
                            <div class="item-info">
                                <h3><?= htmlspecialchars($item['nombre']) ?></h3>
                                <p>Precio unitario: $<?= number_format($item['precio'], 2, '.', ',') ?></p>
                                <p>Cantidad:
                                    <input type="number" min="1" value="<?= $item['cantidad'] ?? 1 ?>" class="cantidad" />
                                </p>
                            </div>
                            <div class="item-total">
                                <p>Total: $<?= number_format($item['precio'] * ($item['cantidad'] ?? 1), 2, '.', ',') ?></p>
                                <form method="POST" action="../controlador/eliminar_carrito.php" style="display:inline;">
                                    <input type="hidden" name="index" value="<?= $index ?>">
                                    <button type="submit" class="btn-eliminar">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form action="../controlador/guardar_pedido.php" method="POST">
                    <input type="hidden" name="mesero" value="<?= htmlspecialchars($_SESSION['nombre']) ?>">
                    <button type="submit" class="btn-pagar">Pagar</button>
                </form>
                <div class="back-container">
                    <a href="../vista/indexUsuario.php" class="back-link">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script src="../javascript/carrito.js"></script>
</body>

</html>