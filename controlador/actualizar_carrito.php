<?php
session_start();
if (isset($_POST['cantidades'])) {
    foreach ($_POST['cantidades'] as $id => $cantidad) {
        if (isset($_SESSION['carrito'][$id])) {
            $_SESSION['carrito'][$id]['cantidad'] = max(1, intval($cantidad));
        }
    }
}
header('Location: ../vista/carrito.php');
exit;
