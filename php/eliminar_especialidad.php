<?php
include("conexion.php");

$id = $_POST['id'] ?? '';

if ($id) {
  $stmt = $conexion->prepare("DELETE FROM especialidades WHERE id_especialidad = ?");
  $stmt->bind_param("i", $id);
  $stmt->execute();
  echo "OK";
  $stmt->close();
} else {
  echo "ID inválido";
}
?>
