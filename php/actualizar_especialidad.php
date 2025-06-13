<?php
include("conexion.php");

$id = $_POST['id'] ?? '';
$nombre = $_POST['nombre'] ?? '';

if ($id && $nombre) {
  $stmt = $conexion->prepare("UPDATE especialidades SET nombre = ? WHERE id_especialidad = ?");
  $stmt->bind_param("si", $nombre, $id);
  $stmt->execute();
  echo "OK";
  $stmt->close();
} else {
  echo "Error en datos";
}
?>
