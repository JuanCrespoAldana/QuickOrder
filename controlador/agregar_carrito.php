<?php
session_start();
if (!isset($_SESSION['carrito'])) {
    $_SESSION['carrito'] = [];
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if (isset($_SESSION['carrito'][$id])) {
        $_SESSION['carrito'][$id]['cantidad']++;
    } else {
        // Conectamos para obtener el platillo
        include '../modelo/conexion.php';
        $query = "SELECT * FROM platillos WHERE idplatillo = $id";
        $result = $conexion->query($query);
        if ($platillo = $result->fetch_assoc()) {
            $_SESSION['carrito'][$id] = [
                'id' => $platillo['idplatillo'],
                'nombre' => $platillo['nombre'],
                'precio' => $platillo['precio'],
                'imagen' => $platillo['imagen'],
                'cantidad' => 1
            ];
        }
    }
}

header('Location: ../vista/indexUsuario.php');
exit;
