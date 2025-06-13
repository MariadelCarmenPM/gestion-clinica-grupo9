<?php
require_once "conexion.php";
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Médicos - Gestión Clínica</title>
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background-color: #f4f9fc;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1100px;
      margin: 30px auto;
      padding: 20px;
      background-color: white;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(0,0,0,0.1);
    }

    h1, h2 {
      color: #0066cc;
      margin-bottom: 20px;
    }

    .acciones {
      display: flex;
      justify-content: space-between;
      margin-bottom: 20px;
    }

    .btn {
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      background-color: #0078d7;
      color: white;
      cursor: pointer;
      font-weight: bold;
    }

    .btn.cancelar {
      background-color: #ccc;
      color: black;
    }

    .btn:hover {
      opacity: 0.9;
    }

    #formularioMedico {
      margin-bottom: 30px;
      border-top: 2px solid #eee;
      padding-top: 20px;
      display: none;
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 15px;
    }

    .campo label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
      color: #333;
    }

    .campo input,
    .campo select {
      width: 100%;
      padding: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }

    .form-botones {
      margin-top: 20px;
      display: flex;
      gap: 10px;
    }

    .tabla {
      width: 100%;
      border-collapse: collapse;
    }

    .tabla th, .tabla td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: center;
    }

    .tabla th {
      background-color: #0078d7;
      color: white;
    }
  </style>
</head>
<body>

  <div class="container">
    <h1>Módulo de Médicos</h1>

    <div class="acciones">
      <button class="btn cancelar" onclick="window.location.href='../especialidades.html'">← Volver a Especialidades</button>
      <button id="btnNuevo" class="btn">+ Nuevo Médico</button>
    </div>

    <form id="formularioMedico">
      <h2>Registro de Médico</h2>

      <div class="form-grid">
        <div class="campo">
          <label for="id_usuario">ID Usuario:</label>
          <input type="number" id="id_usuario" name="id_usuario" required>
        </div>

        <div class="campo">
          <label for="nombres">Nombres:</label>
          <input type="text" id="nombres" name="nombres" required>
        </div>

        <div class="campo">
          <label for="apellidos">Apellidos:</label>
          <input type="text" id="apellidos" name="apellidos" required>
        </div>

        <div class="campo">
          <label for="cmp">CMP:</label>
          <input type="text" id="cmp" name="cmp" required>
        </div>

        <div class="campo">
          <label for="id_especialidad">Especialidad:</label>
          <select id="id_especialidad" name="id_especialidad" required></select>
        </div>

        <div class="campo">
          <label for="telefono">Teléfono:</label>
          <input type="text" id="telefono" name="telefono">
        </div>

        <div class="campo">
          <label for="direccion">Dirección:</label>
          <input type="text" id="direccion" name="direccion">
        </div>

        <div class="campo">
          <label for="correo">Correo:</label>
          <input type="email" id="correo" name="correo">
        </div>
      </div>

      <div class="form-botones">
        <button type="submit" class="btn">Guardar</button>
        <button type="button" class="btn cancelar" id="btnCancelar">Cancelar</button>
      </div>
    </form>

    <table class="tabla">
      <thead>
        <tr>
          <th>ID</th>
          <th>Nombre</th>
          <th>Especialidad</th>
          <th>Teléfono</th>
          <th>Correo</th>
        </tr>
      </thead>
      <tbody id="tablaMedicos"></tbody>
    </table>
  </div>

  <script src="../js/medicos.js"></script>
</body>
</html>
