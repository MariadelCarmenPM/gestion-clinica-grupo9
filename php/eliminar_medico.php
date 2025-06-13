<?php
require 'conexion.php';
$id = $_POST['id_medico'];
$conexion->query("DELETE FROM medicos WHERE id_medico = '$id'");
echo json_encode(["success" => true]);
?>
