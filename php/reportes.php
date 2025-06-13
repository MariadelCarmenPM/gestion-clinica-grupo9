<?php
$conexion = new mysqli("localhost", "root", "", "gestion_clinica");
$conexion->set_charset("utf8");

if ($conexion->connect_error) {
  die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $titulo = $_POST["titulo"];
  $contenido = $_POST["contenido"];
  $fecha = date("Y-m-d H:i:s");
  $generado_por = 1; 

  $stmt = $conexion->prepare("INSERT INTO reportes (titulo, contenido, fecha_generado, generado_por) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("sssi", $titulo, $contenido, $fecha, $generado_por);
  $stmt->execute();
  $stmt->close();
  echo json_encode(["status" => "ok"]);
  exit;
}

if (isset($_GET["listar"])) {
  $sql = "SELECT r.titulo, r.contenido, r.fecha_generado, u.nombre_usuario AS usuario
          FROM reportes r
          JOIN usuarios u ON r.generado_por = u.id_usuario
          ORDER BY r.fecha_generado DESC";
  $result = $conexion->query($sql);
  $data = [];
  while ($row = $result->fetch_assoc()) {
    $data[] = $row;
  }
  echo json_encode($data);
  exit;
}
?>
