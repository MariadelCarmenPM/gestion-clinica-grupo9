<?php
include 'conexion.php';
$q = $_GET['q'] ?? '';
$stmt = $conexion->prepare("SELECT * FROM pacientes WHERE nombres LIKE CONCAT(?, '%') OR apellidos LIKE CONCAT(?, '%') LIMIT 1");
$stmt->bind_param('ss', $q, $q);
$stmt->execute();
$res = $stmt->get_result()->fetch_assoc();
echo json_encode($res ?: null);