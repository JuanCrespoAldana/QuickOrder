<?php

header('Content-Type: application/json');
include("../modelo/conexion.php");

$query = "SELECT p.idpedido, p.estado, p.mesero, p.hora, d.idplatillo, d.cantidad, pl.nombre AS platillo
          FROM pedidos p
          JOIN detalle_pedido d ON p.idpedido = d.idpedido
          JOIN platillos pl ON d.idplatillo = pl.idplatillo
          ORDER BY p.hora ASC";

$result = $conexion->query($query);

$pedidos = [];

// Agrupar datos por pedido y estado
while ($row = $result->fetch_assoc()) {
    $id = $row['idpedido'];
    if (!isset($pedidos[$id])) {
        $pedidos[$id] = [
            'idpedido' => $id,
            'estado' => $row['estado'],
            'mesero' => $row['mesero'],
            'hora' => $row['hora'],
            'detalles' => []
        ];
    }
    $pedidos[$id]['detalles'][] = [
        'platillo' => $row['platillo'],
        'cantidad' => $row['cantidad']
    ];
}

echo json_encode(array_values($pedidos));