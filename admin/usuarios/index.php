<?php
session_start();
// Aquí debería ir la validación del login y permisos según tu sistema

include("../../modelo/conexion.php");

// Consulta para obtener todos los usuarios
$sql = "SELECT * FROM usuarios ORDER BY idusuarios DESC";
$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <h1>Lista de Usuarios</h1>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Tipo Documento</th>
                    <th>Documento</th>
                    <th>Correo Electronico</th>
                    <th>Usuario</th>
                    <th>Rol</th>
                    <th>Fecha Registro</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $resultado->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['idusuarios']) ?></td>
                        <td><?= htmlspecialchars($row['nombre']) ?></td>
                        <td><?= htmlspecialchars($row['apellido']) ?></td>
                        <td><?= htmlspecialchars($row['tipo_documento']) ?></td>
                        <td><?= htmlspecialchars($row['documento']) ?></td>
                        <td><?= htmlspecialchars($row['correo']) ?></td>
                        <td><?= htmlspecialchars($row['usuario']) ?></td>
                        <td><?= htmlspecialchars($row['rol']) ?></td>
                        <td><?= htmlspecialchars($row['fecha_registro']) ?></td>
                        <td class="acciones">
                            <a href="editar.php?id=<?= $row['idusuarios'] ?>" class="edit" title="Editar usuario">
                                <i class="fa-solid fa-pen"></i>
                            </a>
                            <a href="javascript:void(0);" onclick="confirmarEliminacion(<?= $row['idusuarios'] ?>)" class="delete" title="Eliminar usuario">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <?php if (isset($_GET['msg']) && $_GET['msg'] == 'eliminado'): ?>
            <div id="mensaje" class="mensaje-exito">
                Usuario eliminado correctamente.
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
                    }, 5000);
                }
            };
        </script>

        <div class="botones-abajo">
            <a href="../../vista/vistaAdmin.php" class="back-link">
                <i class="fa fa-arrow-left"></i> Atrás
            </a>
            <a href="crear.php" class="btn btn-nuevo">
                <i class="fa-solid fa-user-plus"></i> Nuevo Usuario
            </a>
        </div>
    </main>
</body>

<script>
    function confirmarEliminacion(id) {
        if (confirm("¿Estás seguro de que deseas eliminar este usuario? Esta acción no se puede deshacer.")) {
            window.location.href = 'eliminar.php?id=' + id;
        }
    }
</script>


</html>