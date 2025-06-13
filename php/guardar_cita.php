<?php
require 'conexion.php';

$id_paciente = $_POST['id_paciente'];
$id_medico = $_POST['id_medico'];
$fecha = $_POST['fecha_cita'];
$hora = $_POST['hora_cita'];
$estado = $_POST['estado'];

$sql = "INSERT INTO citas (id_paciente, id_medico, fecha_cita, hora_cita, estado) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("iisss", $id_paciente, $id_medico, $fecha, $hora, $estado);

if ($stmt->execute()) {
  echo "OK";
} else {
  echo "Error al guardar: " . $stmt->error;
}
$stmt->close();
?>
