<?php
session_start();
include("../../modelo/conexion.php");

$sql = "SELECT * FROM platillos ORDER BY idplatillo DESC";
$resultado = $conexion->query($sql);

if (!$resultado) {
    die("Error en la consulta SQL: " . $conexion->error);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Platillos</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>

        <h1>Lista de Platillos</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Imagen</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idplatillo']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['descripcion']) ?></td>
                        <td>$<?= number_format($row['precio'], 2) ?></td>
                        <td>
                            <?php if (!empty($row['imagen'])): ?>
                                <img src="../../img/<?= htmlspecialchars($row['imagen']) ?>" style="max-width: 80px;">
                            <?php else: ?>
                                Sin imagen
                            <?php endif; ?>
                        </td>

                        <td class="acciones">
                            <a href="editar.php?id=<?= $row['idplatillo'] ?>" class="edit" title="Editar">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <a href="eliminar.php?id=<?= $row['idplatillo'] ?>" class="delete" title="Eliminar" onclick="return confirm('¿Seguro que deseas eliminar este platillo?');">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['msg'])): ?>
            <div id="mensaje" class="mensaje-exito">
                <?php
                if ($_GET['msg'] == 'eliminado') {
                    echo "Platillo eliminado correctamente.";
                } elseif ($_GET['msg'] == 'insertado') {
                    echo "Platillo creado correctamente.";
                } elseif ($_GET['msg'] == 'actualizado') {
                    echo "Platillo actualizado correctamente.";
                }
                ?>
            </div>
        <?php endif; ?>

        <script>
            window.onload = function() {
                const mensaje = document.getElementById('mensaje');
                if (mensaje) {
                    setTimeout(() => {
                        mensaje.style.transition = "opacity 1s ease";
                        mensaje.style.opacity = 0;
                        setTimeout(() => mensaje.remove(), 1000);
                    }, 2000);
                }
            };
        </script>

        <div class="botones-abajo">
            <a href="../../vista/vistaAdmin.php" class="back-link">
                <i class="fa fa-arrow-left" aria-hidden="true"></i> Atrás
            </a>

            <a href="crear.php" class="btn btn-platillos">
                <i class="fa fa-plus" aria-hidden="true"></i> Nuevo Platillo
            </a>
        </div>
    </main>
</body>

</html>