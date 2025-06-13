<?php
require_once "conexion.php";

$nombres = $_POST['nombres'] ?? '';
$apellidos = $_POST['apellidos'] ?? '';
$cmp = $_POST['cmp'] ?? '';
$id_especialidad = $_POST['id_especialidad'] ?? '';
$telefono = $_POST['telefono'] ?? '';
$correo = $_POST['correo'] ?? '';

$stmt = $conexion->prepare("INSERT INTO medicos (nombres, apellidos, cmp, id_especialidad, telefono, correo) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sssiss", $nombres, $apellidos, $cmp, $id_especialidad, $telefono, $correo);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}
