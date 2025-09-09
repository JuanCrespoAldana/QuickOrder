<?php
session_start();
include("../modelo/conexion.php");

$carrito = $_SESSION['carrito'] ?? [];
$mesero = $_POST['mesero'] ?? $_SESSION['nombre'] ?? '';
$hora_actual = date("H:i:s");

// Validar datos esenciales
if (empty($carrito) || empty($mesero)) {
    die("Carrito vacío o nombre de cliente no válido.");
}

// Insertar el pedido en la tabla pedidos
$stmt = $conexion->prepare("INSERT INTO pedidos (mesa, personas, estado, hora, mesero) VALUES (0, 0, 'nuevo', ?, ?)");
$stmt->bind_param("ss", $hora_actual, $mesero);

if (!$stmt->execute()) {
    die("Error al guardar el pedido: " . $stmt->error);
}

$id_pedido = $stmt->insert_id;
$stmt->close();

// Insertar cada detalle del pedido
$stmt_detalle = $conexion->prepare("INSERT INTO detalle_pedido (idpedido, idplatillo, cantidad) VALUES (?, ?, ?)");

foreach ($carrito as $item) {
    $idplatillo = $item['id'];
    $cantidad = $item['cantidad'] ?? 1;

    $stmt_detalle->bind_param("iii", $id_pedido, $idplatillo, $cantidad);

    if (!$stmt_detalle->execute()) {
        die("Error al guardar el detalle del pedido: " . $stmt_detalle->error);
    }
}

$stmt_detalle->close();

// Vaciar el carrito de la sesión
$_SESSION['carrito'] = [];

// Redirigir a página de confirmación
header("Location: ../vista/confirmacion.php");
exit();
