<?php
include("../../modelo/conexion.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE idusuarios = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    // Redirigir a index con mensaje
    header("Location: index.php?msg=eliminado");
    exit();
} else {
    header("Location: index.php");
    exit();
}
?>