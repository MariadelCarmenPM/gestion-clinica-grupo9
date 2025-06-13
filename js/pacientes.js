const apiBase = 'php';


function toggleAddForm() {
  document.getElementById('addForm').classList.toggle('show');
}


function openNewPatient() {
  const form = document.getElementById('patientForm');
  form.reset();
  document.getElementById('id_paciente').value = '';
  toggleAddForm();
}



async function cargarPacientes() {
  try {
    const res = await fetch(`${apiBase}/obtener_pacientes.php`);
    const data = await res.json();
    const tbody = document.getElementById('patients-list');
    tbody.innerHTML = '';
    data.forEach(p => {
      const tr = document.createElement('tr');
      tr.innerHTML = `
        <td>${p.id_paciente}</td>
        <td>${p.dni}</td>
        <td>${p.nombres} ${p.apellidos}</td>
        <td>${p.fecha_nacimiento}</td>
        <td>${p.sexo}</td>
        <td>${p.direccion || '---'}</td>
        <td>${p.telefono || '---'}</td>
        <td>${p.correo || '---'}</td>
        <td><button class="btn" onclick="deletePaciente(${p.id_paciente})">Eliminar</button></td>
      `;
      tr.addEventListener('click', () => editarPaciente(p));
      tbody.appendChild(tr);
    });
  } catch (err) {
    console.error('Error al cargar pacientes:', err);
  }
}


document.addEventListener('DOMContentLoaded', () => {
  const form = document.getElementById('patientForm');
  form.addEventListener('submit', async e => {
    e.preventDefault();
    const datos = new FormData(form);
    const url = datos.get('id_paciente')
      ? 'actualizar_paciente.php'
      : 'guardar_paciente.php';
    try {
      const res = await fetch(`${apiBase}/${url}`, {
        method: 'POST',
        body: new URLSearchParams(datos)
      });
      const text = await res.text();
      if (text.trim() !== 'OK') {
        alert('Error al guardar paciente: ' + text);
        return;
      }
      form.reset();
      toggleAddForm();
      cargarPacientes();
    } catch (err) {
      console.error('Error al guardar paciente:', err);
      alert('Error de red al guardar paciente');
    }
  });

 
  cargarPacientes();
});


function editarPaciente(p) {
  toggleAddForm();
  document.getElementById('id_paciente').value = p.id_paciente;
  document.getElementById('dni').value = p.dni;
  document.getElementById('nombres').value = p.nombres;
  document.getElementById('apellidos').value = p.apellidos;
  document.getElementById('fecha_nacimiento').value = p.fecha_nacimiento;
  document.getElementById('sexo').value = p.sexo;
  document.getElementById('direccion').value = p.direccion;
  document.getElementById('telefono').value = p.telefono;
  document.getElementById('correo').value = p.correo;
}


async function deletePaciente(id) {
  if (!confirm('¿Estás seguro de eliminar este paciente?')) return;
  try {
    await fetch(`${apiBase}/eliminar_paciente.php`, {
      method: 'POST',
      headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
      body: `id=${id}`
    });
    cargarPacientes();
  } catch (err) {
    console.error('Error al eliminar paciente:', err);
  }
}