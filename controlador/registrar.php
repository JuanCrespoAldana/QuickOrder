<?php
session_start();
include("../modelo/conexion.php");

if (!empty($_POST)) {
    $nombre = $_POST["nombre"] ?? "";
    $apellido = $_POST["apellido"] ?? "";
    $tipo_documento = $_POST["tipo_documento"] ?? "";
    $documento = $_POST["documento"] ?? "";
    $correo = $_POST["correo"] ?? "";
    $usuario = $_POST["user"] ?? "";
    $password = $_POST["pass"] ?? "";

    if (empty($nombre) || empty($apellido) || empty($tipo_documento) || empty($documento) || empty($correo) || empty($usuario) || empty($password)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: ../vista/registro.php");
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, correo, usuario, password) VALUES (?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conexion->prepare($sql)) {
        $stmt->bind_param("sssssss", $nombre, $apellido, $tipo_documento, $documento, $correo, $usuario, $hashedPassword);

        if ($stmt->execute()) {
            $_SESSION['mensaje'] = "Registro exitoso. Ya puedes iniciar sesión.";
            header("Location: ../vista/inicioSesion.php");
            exit;
        } else {
            $_SESSION['error'] = "Error al registrar usuario. Intenta nuevamente.";
            header("Location: ../vista/registro.php");
            exit;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Error en la preparación de la consulta.";
        header("Location: ../vista/registro.php");
        exit;
    }
}
?>