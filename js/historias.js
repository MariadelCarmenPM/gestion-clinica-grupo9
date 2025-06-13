const apiBase = 'php';


async function buscarPaciente() {
  const q = document.getElementById('buscarPaciente').value.trim();
  if (!q) return alert('Ingresa un nombre o apellido');
  const res = await fetch(`${apiBase}/buscar_paciente.php?q=${encodeURIComponent(q)}`);
  const p = await res.json();
  if (!p) return alert('Paciente no encontrado');
  mostrarTarjeta(p);
  cargarHistoria(p.id_paciente);
}


function mostrarTarjeta(p) {
  const cont = document.getElementById('tarjetaPaciente');
  cont.style.display = 'grid';
  cont.innerHTML = `
    <div><span class="etiqueta">ID Paciente</span><div class="valor-celda">${p.id_paciente}</div></div>
    <div><span class="etiqueta">Nombre</span><div class="valor-celda">${p.nombres} ${p.apellidos}</div></div>
    <div><span class="etiqueta">DNI</span><div class="valor-celda">${p.dni}</div></div>
    <div><span class="etiqueta">Fecha Nac.</span><div class="valor-celda">${p.fecha_nacimiento}</div></div>
  `;
}


async function cargarHistoria(id) {
  const res = await fetch(`${apiBase}/obtener_historia.php?id_paciente=${id}`);
  const eventos = await res.json();
  const tl = document.getElementById('lineaTiempo');
  tl.innerHTML = '';
  eventos.forEach(ev => {
    const art = document.createElement('article');
    art.className = 'evento';
    art.innerHTML = `
  <h3>${ev.fecha_registro}</h3>
  <p><strong>Motivo:</strong> ${ev.motivo_consulta}</p>
  <p><strong>Diagnóstico:</strong> ${ev.diagnostico}</p>
  <p><strong>Tratamiento:</strong> ${ev.tratamiento}</p>
  <p><strong>Médico:</strong> ${ev.medico}</p>
`;
    tl.appendChild(art);
  });
}
document.addEventListener('DOMContentLoaded', () => {
  const fechaSpan = document.getElementById('fecha-actualizacion');
  const hoy = new Date();
  const opciones = { year: 'numeric', month: 'long', day: 'numeric' };
  fechaSpan.textContent = hoy.toLocaleDateString('es-PE', opciones);
});