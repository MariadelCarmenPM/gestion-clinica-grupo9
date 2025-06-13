<?php
include('conexion.php');

$id = $_POST['id_paciente'];
$dni = $_POST['dni'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$fecha = $_POST['fecha_nacimiento'];
$sexo = $_POST['sexo'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];

$stmt = $conexion->prepare("UPDATE pacientes SET dni=?, nombres=?, apellidos=?, fecha_nacimiento=?, sexo=?, direccion=?, telefono=?, correo=? WHERE id_paciente=?");
$stmt->bind_param("ssssssssi", $dni, $nombres, $apellidos, $fecha, $sexo, $direccion, $telefono, $correo, $id);
$stmt->execute();
echo "OK";