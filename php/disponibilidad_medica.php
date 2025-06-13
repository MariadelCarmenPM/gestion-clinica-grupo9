<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>📅 Disponibilidad Médica</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background: #e9f0f7;
    }
    h2 {
      color: #007ACC;
    }
    form {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px;
      margin-bottom: 20px;
      background: #fff;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    label {
      font-weight: bold;
    }
    select, input[type="time"], button {
      padding: 10px;
      border-radius: 8px;
      border: 1px solid #ccc;
      width: 100%;
    }
    button {
      grid-column: span 2;
      background: #007ACC;
      color: #fff;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      background: #fff;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }
    th {
      background: #007ACC;
      color: #fff;
    }
    a {
      text-decoration: none;
      color: #007ACC;
      font-weight: bold;
    }
  </style>
</head>
<body>

  <div style="margin-bottom: 20px;">
    <a href="../principal.html" title="Volver al inicio">🏠 Inicio</a>
  </div>

  <h2>📅 Disponibilidad Médica</h2>

  <form id="form-disponibilidad">
    <div>
      <label for="disp-medico">👨‍⚕️ Médico</label>
      <select id="disp-medico" name="medico" required>
        <option value="" disabled selected>Seleccione médico</option>
      </select>
    </div>
    <div>
      <label for="disp-dia">📆 Día</label>
      <select id="disp-dia" name="dia" required>
        <option value="Lunes">Lunes</option>
        <option value="Martes">Martes</option>
        <option value="Miércoles">Miércoles</option>
        <option value="Jueves">Jueves</option>
        <option value="Viernes">Viernes</option>
        <option value="Sábado">Sábado</option>
      </select>
    </div>
    <div>
      <label for="disp-hora-inicio">🕒 Hora inicio</label>
      <input type="time" id="disp-hora-inicio" name="hora_inicio" min="07:00" max="21:00" required>
    </div>
    <div>
      <label for="disp-hora-fin">🕔 Hora fin</label>
      <input type="time" id="disp-hora-fin" name="hora_fin" min="07:00" max="21:00" required>
    </div>
    <button type="submit">💾 Guardar Disponibilidad</button>
  </form>

  <table>
    <thead>
      <tr>
        <th>Médico</th>
        <th>Día</th>
        <th>Hora Inicio</th>
        <th>Hora Fin</th>
      </tr>
    </thead>
    <tbody id="tabla-disponibilidad"></tbody>
  </table>

  <script>
    const form = document.getElementById("form-disponibilidad");
    const tabla = document.getElementById("tabla-disponibilidad");
    const selectMedico = document.getElementById("disp-medico");

    function cargarMedicos() {
      fetch("disponibilidad_api.php?medicos")
        .then(res => res.json())
        .then(data => {
          selectMedico.innerHTML = '<option value="" disabled selected>Seleccione médico</option>';
          data.forEach(medico => {
            const opt = document.createElement("option");
            opt.value = medico.id_medico;
            opt.textContent = medico.nombres + " " + medico.apellidos;
            selectMedico.appendChild(opt);
          });
        });
    }

    function cargarDisponibilidad() {
      fetch("disponibilidad_api.php?listar")
        .then(res => res.json())
        .then(data => {
          tabla.innerHTML = "";
          data.forEach(d => {
            const fila = `<tr>
              <td>${d.medico}</td>
              <td>${d.dia_semana}</td>
              <td>${d.hora_inicio}</td>
              <td>${d.hora_fin}</td>
            </tr>`;
            tabla.insertAdjacentHTML("beforeend", fila);
          });
        });
    }

    form.addEventListener("submit", e => {
      e.preventDefault();
      const datos = new FormData(form);
      fetch("disponibilidad_api.php", {
        method: "POST",
        body: datos
      })
      .then(res => res.json())
      .then(() => {
        form.reset();
        cargarDisponibilidad();
      });
    });

    cargarMedicos();
    cargarDisponibilidad();
  </script>
</body>
</html>
