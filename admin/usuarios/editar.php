<?php
session_start();
include("../../modelo/conexion.php");

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Procesar actualización
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $tipo_documento = $_POST['tipo_documento'];
    $documento = $_POST['documento'];
    $correo = $_POST['correo'];
    $usuario = $_POST['usuario'];
    $rol = $_POST['rol']; // nuevo campo

    $sql = "UPDATE usuarios SET nombre=?, apellido=?, tipo_documento=?, documento=?, correo=?, usuario=?, rol=? WHERE idusuarios=?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("sssssssi", $nombre, $apellido, $tipo_documento, $documento, $correo, $usuario, $rol, $id);
    $stmt->execute();

    header("Location: index.php");
    exit();
}

// Obtener datos del usuario
$sql = "SELECT * FROM usuarios WHERE idusuarios=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuarioData = $result->fetch_assoc();

if (!$usuarioData) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="../../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <h1>Editar Usuario</h1>
        <form method="POST" action="" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($usuarioData['nombre']) ?>" required />
            </div>
            <div class="campo">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" value="<?= htmlspecialchars($usuarioData['apellido']) ?>" required />
            </div>
            <div class="campo">
                <label for="tipo_documento">Tipo de Documento</label>
                <select id="tipo_documento" name="tipo_documento" required>
                    <option value="CC" <?= $usuarioData['tipo_documento'] == 'CC' ? 'selected' : '' ?>>Cédula de Ciudadanía</option>
                    <option value="TI" <?= $usuarioData['tipo_documento'] == 'TI' ? 'selected' : '' ?>>Tarjeta de Identidad</option>
                    <option value="CE" <?= $usuarioData['tipo_documento'] == 'CE' ? 'selected' : '' ?>>Cédula de Extranjería</option>
                </select>
            </div>
            <div class="campo">
                <label for="documento">Documento</label>
                <input type="text" id="documento" name="documento" value="<?= htmlspecialchars($usuarioData['documento']) ?>" required />
            </div>
            <div class="campo">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" value="<?= htmlspecialchars($usuarioData['correo']) ?>" required />
            </div>
            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" value="<?= htmlspecialchars($usuarioData['usuario']) ?>" required />
            </div>
            <div class="campo">
                <label for="rol">Rol</label>
                <select id="rol" name="rol" required>
                    <option value="admin" <?= $usuarioData['rol'] == 'admin' ? 'selected' : '' ?>>Administrador</option>
                    <option value="cocinero" <?= $usuarioData['rol'] == 'cocinero' ? 'selected' : '' ?>>Cocinero</option>
                    <option value="cliente" <?= $usuarioData['rol'] == 'cliente' ? 'selected' : '' ?>>Cliente</option>
                </select>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-usuarios"><i class="fas fa-save"></i> Guardar Cambios</button>
            </div>
            <div class="botones-abajo">
                <a href="../usuarios/index.php" class="back-link">
                    <i class="fa fa-arrow-left"></i> Atrás
                </a>
            </div>
        </form>
    </main>
</body>

</html>