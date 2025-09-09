<?php
if ($resultado && $resultado->num_rows > 0):
    while ($platillo = $resultado->fetch_assoc()): ?>
        <div class="card-product">
            <div class="container-img">
                <?php if (!empty($platillo['imagen'])): ?>
                    <img class="img-platillo" src="../img/<?= htmlspecialchars($platillo['imagen']) ?>" alt="<?= htmlspecialchars($platillo['nombre']) ?>" />
                <?php else: ?>
                    <img class="img-platillo" src="../img/default.jpg" alt="Imagen no disponible" />
                <?php endif; ?>
            </div>
            <div class="content-card-product">
                <h3><?= htmlspecialchars($platillo['nombre']) ?></h3>
                <a href="../controlador/agregar_carrito.php?id=<?= $platillo['idplatillo'] ?>" class="add-cart">
                    <i class="fa-solid fa-basket-shopping"></i>
                </a>
                <p class="price">$<?= number_format($platillo['precio'], 0, ',', '.') ?></p>
            </div>
        </div>
    <?php endwhile;
else: ?>
    <p>No hay platillos disponibles en este momento.</p>
<?php endif; ?>