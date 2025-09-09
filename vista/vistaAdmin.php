<?php
session_start();

// Verifica si el usuario está logueado y es administrador
if (!isset($_SESSION['id_usuario']) || $_SESSION['rol'] !== 'admin') {
    header("Location: ../index.php");
    exit();
}

// Obtiene el nombre y apellido desde la sesión
$nombre = $_SESSION['nombre'];
$apellido = $_SESSION['apellido'];
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Administrador</title>
    <link rel="stylesheet" href="../css/admin.css" />
    <script src="https://kit.fontawesome.com/17cefd659f.js" crossorigin="anonymous"></script>
</head>

<body>
    <main class="container">
        <h1>Bienvenido, <?= htmlspecialchars($nombre . ' ' . $apellido) ?></h1>
        <p class="subtitle">Selecciona una opción para administrar:</p>

        <div class="botones">
            <a href="../admin/usuarios/index.php" class="btn btn-usuarios">
                <i class="fa-solid fa-user"></i> Gestionar Usuarios
            </a>
            <a href="../admin/platillos/index.php" class="btn btn-platillos">
                <i class="fa-solid fa-utensils"></i> Gestionar Platillos
            </a>
        </div>

        <div class="salir-container">
            <a href="../index.php" class="btn btn-salir">
                <i class="fa-solid fa-right-from-bracket"></i> Salir
            </a>
        </div>
    </main>
</body>

</html>