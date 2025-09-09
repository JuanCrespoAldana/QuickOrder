<?php
session_start();

require '../modelo/conexion.php';

if (!isset($_SESSION['carrito'])) {
    echo json_encode(['success' => false, 'message' => 'Carrito no existe']);
    exit;
}

$index = $_POST['index'] ?? null;
$cantidad = $_POST['cantidad'] ?? 1;

if ($index === null || !isset($_SESSION['carrito'][$index])) {
    echo json_encode(['success' => false, 'message' => 'Ítem no válido']);
    exit;
}

// Validar que la cantidad sea un número positivo
$cantidad = max(1, (int)$cantidad);

// Actualizar la cantidad
$_SESSION['carrito'][$index]['cantidad'] = $cantidad;

echo json_encode(['success' => true]);
?>