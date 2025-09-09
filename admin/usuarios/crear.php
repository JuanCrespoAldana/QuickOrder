<?php
session_start();
include("../../modelo/conexion.php");

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $tipo_documento = htmlspecialchars($_POST['tipo_documento']);
    $documento = htmlspecialchars($_POST['documento']);
    $correo = htmlspecialchars($_POST['correo']);
    $usuario = htmlspecialchars($_POST['usuario']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $rol = 'cliente';

    $checkSql = "SELECT documento FROM usuarios WHERE documento = ?";
    $checkStmt = $conexion->prepare($checkSql);

    if (!$checkStmt) {
        die("Error al preparar la consulta: " . $conexion->error);
    }

    $checkStmt->bind_param("s", $documento);
    $checkStmt->execute();
    $checkStmt->store_result();

    if ($checkStmt->num_rows > 0) {
        $error = "Ya existe un usuario.";
    } else {
        $sql = "INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, correo, usuario, password, rol, fecha_registro) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $conexion->prepare($sql);

        if (!$stmt) {
            die("Error al preparar el insert: " . $conexion->error);
        }

        $stmt->bind_param("ssssssss", $nombre, $apellido, $tipo_documento, $documento, $correo, $usuario, $password, $rol);
        $stmt->execute();

        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="../../css/admin.css">
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main>
        <?php if (!empty($error)): ?>
            <div class="error" style="color: red; margin-bottom: 15px; font-weight: bold;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <h1><i class="fas fa-user-plus"></i> Crear Nuevo Usuario</h1>
        <form method="POST" class="formulario">
            <div class="campo">
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
            </div>

            <div class="campo">
                <label for="apellido">Apellido</label>
                <input type="text" id="apellido" name="apellido" required>
            </div>

            <div class="campo">
                <label for="tipo_documento">Tipo de Documento</label>
                <select id="tipo_documento" name="tipo_documento" required>
                    <option value="">Seleccione</option>
                    <option value="CC">Cédula de Ciudadanía</option>
                    <option value="TI">Tarjeta de Identidad</option>
                    <option value="CE">Cédula de Extranjería</option>
                </select>
            </div>

            <div class="campo">
                <label for="documento">Número de Documento</label>
                <input type="text" id="documento" name="documento" required>
            </div>

            <div class="campo">
                <label for="correo">Correo Electrónico</label>
                <input type="email" id="correo" name="correo" required>
            </div>

            <div class="campo">
                <label for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" required>
            </div>

            <div class="campo">
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="botones">
                <button type="submit" class="btn btn-usuarios"><i class="fas fa-save"></i> Crear Usuario</button>
                <button type="reset" class="btn btn-salir"><i class="fas fa-eraser"></i> Limpiar</button>
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