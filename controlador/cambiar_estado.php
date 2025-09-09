<?php
header('Content-Type: application/json');
include("../modelo/conexion.php");

if (!isset($_POST['idpedido'])) {
    echo json_encode(['success' => false, 'msg' => 'No se recibió idpedido']);
    exit;
}

$idpedido = intval($_POST['idpedido']);

// Obtener estado actual
$query = $conexion->prepare("SELECT estado FROM pedidos WHERE idpedido = ?");
$query->bind_param("i", $idpedido);
$query->execute();
$result = $query->get_result();

if ($result->num_rows === 0) {
    echo json_encode(['success' => false, 'msg' => 'Pedido no encontrado']);
    exit;
}

$row = $result->fetch_assoc();
$estado_actual = $row['estado'];

$estados = ['nuevo', 'cocinando', 'emplatando', 'listo', 'entregado'];

$pos = array_search($estado_actual, $estados);
if ($pos === false || $pos === count($estados) - 1) {
    // Estado no encontrado o ya está en el último estado
    echo json_encode(['success' => false, 'msg' => 'No se puede avanzar el estado']);
    exit;
}

$nuevo_estado = $estados[$pos + 1];

// Actualizar el estado
$update = $conexion->prepare("UPDATE pedidos SET estado = ? WHERE idpedido = ?");
$update->bind_param("si", $nuevo_estado, $idpedido);
$update->execute();

if ($update->affected_rows > 0) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'msg' => 'No se pudo actualizar']);
}
