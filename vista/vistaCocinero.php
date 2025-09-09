<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vista Cocina - QuickOrder</title>
    <link rel="stylesheet" href="../css/cocinero.css">
</head>

<body>
    <div class="container">
        <section class="orders-section">
            <h2>Pedidos Nuevos</h2>
            <div id="ordersList"></div>
        </section>

        <section class="kitchen-section">
            <h2>En Cocina</h2>
            <div class="status-columns">
                <div class="status-column">
                    <h3>Cocinando</h3>
                    <div id="cocinando" class="status-cards"></div>
                </div>
                <div class="status-column">
                    <h3>Emplatando</h3>
                    <div id="emplatando" class="status-cards"></div>
                </div>
                <div class="status-column">
                    <h3>Listo</h3>
                    <div id="listo" class="status-cards"></div>
                </div>
            </div>
        </section>

    </div>

    <script src="../javascript/cocinero.js"></script>
</body>

</html>