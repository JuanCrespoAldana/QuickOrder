<?php
include("../../modelo/conexion.php");
$pass = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO usuarios (nombre, apellido, tipo_documento, documento, correo, usuario, password)
        VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("sssssss", $_POST['nombre'], $_POST['apellido'], $_POST['tipo_documento'],
    $_POST['documento'], $_POST['correo'], $_POST['usuario'], $pass);
$stmt->execute();
header("Location: index.php");
