<?php
require '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $pass1 = $_POST['pass1'];
    $pass2 = $_POST['pass2'];

    if ($pass1 === $pass2) {
        $passHash = password_hash($pass1, PASSWORD_DEFAULT);
        $sql = "UPDATE usuarios SET password = ? WHERE correo = ?";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("ss", $passHash, $correo);
        if ($stmt->execute()) {
            echo "<script>alert('Contraseña actualizada'); window.location='../vista/inicioSesion.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar'); history.back();</script>";
        }
    } else {
        echo "<script>alert('Las contraseñas no coinciden'); history.back();</script>";
    }
}
?>
