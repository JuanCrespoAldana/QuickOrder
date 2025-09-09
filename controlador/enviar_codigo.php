<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
require '../modelo/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $correo = $_POST['correo'];
    $sql = "SELECT * FROM usuarios WHERE correo = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $codigo = rand(100000, 999999);
        session_start();
        $_SESSION['codigo'] = $codigo;
        $_SESSION['correo'] = $correo;

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'juancrespoaldana@gmail.com'; // Reemplaza con tu Gmail
            $mail->Password = 'occa bdvi xmhz zbtv'; // App Password
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('tucorreo@gmail.com', 'QuickOrder');
            $mail->addAddress($correo);
            $mail->isHTML(true);
            $mail->Subject = 'Código de recuperación';
            $mail->Body = "Tu código de verificación es: <b>$codigo</b>";

            $mail->send();
            header("Location: ../vista/verificarCodigo.php");
        } catch (Exception $e) {
            echo "Error al enviar: {$mail->ErrorInfo}";
        }
    } else {
        echo "<script>alert('Correo no registrado'); window.location='../vista/olvideContrasena.php';</script>";
    }
}
