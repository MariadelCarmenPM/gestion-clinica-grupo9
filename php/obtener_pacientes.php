<?php
include('conexion.php');

$result = $conexion->query("SELECT * FROM pacientes");
$datos = [];
while($fila = $result->fetch_assoc()) {
    $datos[] = $fila;
}
echo json_encode($datos);