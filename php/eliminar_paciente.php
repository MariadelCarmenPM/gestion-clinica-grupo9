<?php
include('conexion.php');

$id = $_POST['id'];
$stmt = $conexion->prepare("DELETE FROM pacientes WHERE id_paciente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
echo "OK";