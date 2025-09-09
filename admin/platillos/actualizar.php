<?php
session_start();
include("../../modelo/conexion.php");

$id = $_POST['idplatillo'] ?? null;
$nombre = $_POST['nombre'] ?? '';
$descripcion = $_POST['descripcion'] ?? '';
$precio = $_POST['precio'] ?? 0;

if (!$id) {
    header("Location: index.php");
    exit;
}

// Primero obtenemos el nombre actual de la imagen para borrar si se actualiza
$stmtSelect = $conexion->prepare("SELECT imagen FROM platillos WHERE idplatillo = ?");
$stmtSelect->bind_param("i", $id);
$stmtSelect->execute();
$resultSelect = $stmtSelect->get_result();
$platilloActual = $resultSelect->fetch_assoc();

$nombreImagen = $platilloActual['imagen'];

// Procesar nueva imagen si se subió
if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
    $archivoTmp = $_FILES['imagen']['tmp_name'];
    $nombreArchivo = basename($_FILES['imagen']['name']);
    $ext = strtolower(pathinfo($nombreArchivo, PATHINFO_EXTENSION));
    $extPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($ext, $extPermitidas)) {
        $nuevoNombre = uniqid('platillo_', true) . '.' . $ext;
        $rutaDestino = '../../img/' . $nuevoNombre;
        if (move_uploaded_file($archivoTmp, $rutaDestino)) {
            // Borrar imagen vieja si existe y es diferente
            if (!empty($nombreImagen) && file_exists('../../img/' . $nombreImagen)) {
                unlink('../../img/' . $nombreImagen);
            }
            $nombreImagen = $nuevoNombre;
        } else {
            die("Error al mover la imagen.");
        }
    } else {
        die("Tipo de imagen no permitido. Solo jpg, png, gif.");
    }
}

$stmt = $conexion->prepare("UPDATE platillos SET nombre = ?, descripcion = ?, precio = ?, imagen = ? WHERE idplatillo = ?");
$stmt->bind_param("ssdsi", $nombre, $descripcion, $precio, $nombreImagen, $id);

if ($stmt->execute()) {
    header("Location: index.php?msg=actualizado");
    exit;
} else {
    die("Error al actualizar platillo: " . $conexion->error);
}
?>
