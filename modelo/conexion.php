<?php
$conexion = new mysqli("localhost", "root", "", "db_quickorder", 3307);
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
?>