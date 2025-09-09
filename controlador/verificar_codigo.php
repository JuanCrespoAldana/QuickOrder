<?php
session_start();
if ($_POST['codigo'] == $_SESSION['codigo'] && $_POST['correo'] == $_SESSION['correo']) {
    header("Location: ../vista/nuevaContrasena.php?correo=" . $_POST['correo']);
} else {
    echo "<script>alert('Código incorrecto'); window.location='../vista/verificarCodigo.php';</script>";
}
?>
