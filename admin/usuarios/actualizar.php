<?php
include("../../modelo/conexion.php");
$sql = "UPDATE usuarios SET nombre=?, apellido=?, correo=?, usuario=? WHERE idusuarios=?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("ssssi", $_POST['nombre'], $_POST['apellido'], $_POST['correo'], $_POST['usuario'], $_POST['id']);
$stmt->execute();
header("Location: index.php");
