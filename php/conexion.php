<?php
$conexion = new mysqli("localhost", "root", "", "gestion_clinica", 3306);
if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>