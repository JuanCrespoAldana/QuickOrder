<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Crear Platillo</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container">
        <h1>Crear Nuevo Platillo</h1>
        <form class="formulario" action="insertar.php" method="POST" enctype="multipart/form-data">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required />
            </div>

            <div class="campo">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" required />
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0" required />
            </div>

            <div class="campo">
                <label for="imagen">Imagen (jpg, png, gif)</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" />
            </div>

            <div class="botones-abajo">
                <a href="../platillos/index.php" class="back-link">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                </a>

                <button type="submit" class="btn btn-platillos">
                    <i class="fa fa-save"></i> Guardar
                </button>
            </div>
        </form>
    </main>
</body>

</html>