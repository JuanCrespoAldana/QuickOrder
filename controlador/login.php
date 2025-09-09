<?php
session_start();
include("../modelo/conexion.php");

if (!empty($_POST)) {
    $usuario = mysqli_real_escape_string($conexion, $_POST['user']);
    $password = $_POST['pass'];

    // Consulta preparada para evitar SQL Injection
    $sql = "SELECT idusuarios, password, usuario, nombre, apellido, rol FROM usuarios WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();

        // Verifica la contraseña utilizando password_verify
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_usuario'] = $row['idusuarios'];
            $_SESSION['usuario'] = ['nombre' => $row['usuario']];
            $_SESSION['nombre'] = $row['nombre'];
            $_SESSION['apellido'] = $row['apellido'];
            $_SESSION['rol'] = $row['rol'];

            // Redirección según el rol
            if ($row['rol'] === 'admin') {
                header("Location: ../vista/vistaAdmin.php");
            } elseif ($row['rol'] === 'cocinero') {
                header("Location: ../vista/vistaCocinero.php");
            } else {
                header("Location: ../vista/indexUsuario.php");
            }
        } else {
            header("Location: ../vista/inicioSesion.php?error=1");
            exit();
        }
    } else {
        header("Location: ../vista/inicioSesion.php?error=1");
        exit();
    }
}
?>
