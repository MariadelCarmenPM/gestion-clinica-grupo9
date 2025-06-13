<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "gestion_clinica";

$conn = new mysqli($host, $user, $pass, $db);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  http_response_code(500);
  echo json_encode(["error" => "Error de conexión"]);
  exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $id_medico = $_POST["medico"];
  $dia = $_POST["dia"];
  $hora_inicio = $_POST["hora_inicio"];
  $hora_fin = $_POST["hora_fin"];

  $stmt = $conn->prepare("INSERT INTO disponibilidad_medica (id_medico, dia_semana, hora_inicio, hora_fin) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("isss", $id_medico, $dia, $hora_inicio, $hora_fin);
  $stmt->execute();
  $stmt->close();
  echo json_encode(["status" => "ok"]);
  exit;
}

if (isset($_GET["medicos"])) {
  $result = $conn->query("SELECT id_medico, nombres, apellidos FROM medicos");
  $medicos = [];
  while ($row = $result->fetch_assoc()) {
    $medicos[] = $row;
  }
  echo json_encode($medicos);
  exit;
}

if (isset($_GET["listar"])) {
  $sql = "SELECT d.id_disponibilidad, CONCAT(m.nombres, ' ', m.apellidos) AS medico, d.dia_semana, d.hora_inicio, d.hora_fin
          FROM disponibilidad_medica d
          JOIN medicos m ON d.id_medico = m.id_medico
          ORDER BY FIELD(d.dia_semana,'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado'), d.hora_inicio";
  $result = $conn->query($sql);
  $disponibilidad = [];
  while ($row = $result->fetch_assoc()) {
    $disponibilidad[] = $row;
  }
  echo json_encode($disponibilidad);
  exit;
}

