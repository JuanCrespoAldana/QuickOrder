<?php
session_start();
include("../../modelo/conexion.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

$stmt = $conexion->prepare("SELECT * FROM platillos WHERE idplatillo = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: index.php");
    exit;
}

$platillo = $resultado->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Editar Platillo</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container">
        <h1>Editar Platillo</h1>
        <form class="formulario" action="actualizar.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idplatillo" value="<?= htmlspecialchars($platillo['idplatillo']) ?>" />

            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($platillo['nombre']) ?>" required />
            </div>

            <div class="campo">
                <label for="descripcion">Descripción</label>
                <input type="text" id="descripcion" name="descripcion" value="<?= htmlspecialchars($platillo['descripcion']) ?>" required />
            </div>

            <div class="campo">
                <label for="precio">Precio</label>
                <input type="number" id="precio" name="precio" step="0.01" min="0" value="<?= htmlspecialchars($platillo['precio']) ?>" required />
            </div>

            <div class="campo">
                <label>Imagen Actual</label>
                <?php if (!empty($platillo['imagen'])): ?>
                    <img src="../../img/<?= htmlspecialchars($platillo['imagen']) ?>" alt="<?= htmlspecialchars($platillo['nombre']) ?>" style="max-width:150px; border-radius:8px;" />
                <?php else: ?>
                    <p>Sin imagen</p>
                <?php endif; ?>
            </div>

            <div class="campo">
                <label for="imagen">Cambiar Imagen (opcional)</label>
                <input type="file" id="imagen" name="imagen" accept="image/*" />
            </div>

            <div class="botones-abajo">
                <a href="../platillos/index.php" class="back-link">
                    <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
                </a>
                <button type="submit" class="btn btn-platillos">
                    <i class="fa fa-save"></i> Actualizar
                </button>
            </div>
        </form>
    </main>
</body>

</html>