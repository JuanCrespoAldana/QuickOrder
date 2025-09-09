<?php
session_start();
include("../../modelo/conexion.php");

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Primero obtener el nombre de la imagen para eliminarla
$stmtSelect = $conexion->prepare("SELECT imagen FROM platillos WHERE idplatillo = ?");
$stmtSelect->bind_param("i", $id);
$stmtSelect->execute();
$resultSelect = $stmtSelect->get_result();
$platillo = $resultSelect->fetch_assoc();

if ($platillo && !empty($platillo['imagen'])) {
    $rutaImagen = '../../img/' . $platillo['imagen'];
    if (file_exists($rutaImagen)) {
        unlink($rutaImagen);
    }
}

$stmt = $conexion->prepare("DELETE FROM platillos WHERE idplatillo = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?msg=eliminado");
    exit;
} else {
    die("Error al eliminar platillo: " . $conexion->error);
}
?>
