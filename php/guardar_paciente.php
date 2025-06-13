<?php
include('conexion.php');

$dni = $_POST['dni'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$stmt = $conexion->prepare("INSERT INTO pacientes (dni, nombres, apellidos, fecha_nacimiento, sexo, direccion, telefono, correo) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssssss", $dni, $nombres, $apellidos, $fecha, $sexo, $direccion, $telefono, $correo);
$stmt->execute();
echo "OK";