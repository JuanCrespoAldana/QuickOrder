<?php
session_start();
include("../../modelo/conexion.php");

$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? 0;

// Manejo de imagen
$nombreImagen = null;
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $archivoTmp = $_FILES['imagen']['tmp_name'];
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $extPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $extPermitidas)) {
        $nuevoNombre = uniqid('platillo_', true) . '.' . $ext;
        $rutaDestino = '../../img/' . $nuevoNombre;
        if (move_uploaded_file($archivoTmp, $rutaDestino)) {
            $nombreImagen = $nuevoNombre;
        } else {
            die("Error al mover la imagen.");
        }
    } else {
        die("Tipo de imagen no permitido. Solo jpg, png, gif.");
    }
}

// Insertar en la base
$stmt = $conexion->prepare("INSERT INTO platillos (nombre, descripcion, precio, imagen) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssds", $nombre, $descripcion, $precio, $nombreImagen);

if ($stmt->execute()) {
    header("Location: index.php?msg=insertado");
    exit;
} else {
    die("Error al insertar platillo: " . $conexion->error);
}
?>
