document.addEventListener("DOMContentLoaded", () => {
  cargarEspecialidades();
  cargarMedicos();

  document.getElementById("btnNuevo").addEventListener("click", abrirFormularioNuevo);
  document.getElementById("formularioMedico").addEventListener("submit", guardarMedico);
  document.getElementById("btnCancelar").addEventListener("click", () => toggleFormulario(false));
});

async function cargarEspecialidades() {
  try {
    const res = await fetch("../php/obtener_especialidades.php");
    const especialidades = await res.json();
    const select = document.getElementById("id_especialidad");

    select.innerHTML = '<option value="">Seleccione...</option>';
    especialidades.forEach(e => {
      const option = document.createElement("option");
      option.value = e.id_especialidad;
      option.textContent = e.nombre;
      select.appendChild(option);
    });
  } catch (err) {
    console.error("Error al cargar especialidades:", err);
  }
}

async function cargarMedicos() {
  try {
    const res = await fetch("../php/obtener_medicos.php");
    const medicos = await res.json();
    const tabla = document.getElementById("tablaMedicos");
    tabla.innerHTML = "";

    medicos.forEach(m => {
      const fila = document.createElement("tr");
      fila.innerHTML = `
        <td>${m.id_medico}</td>
        <td>${m.nombres} ${m.apellidos}</td>
        <td>${m.nombre_especialidad}</td>
        <td>${m.telefono}</td>
        <td>${m.correo}</td>
      `;
      tabla.appendChild(fila);
    });
  } catch (err) {
    console.error("Error al cargar médicos:", err);
  }
}

function abrirFormularioNuevo() {
  document.getElementById("formularioMedico").reset();
  toggleFormulario(true);
}

function toggleFormulario(mostrar) {
  const formulario = document.getElementById("formularioMedico");
  formulario.style.display = mostrar ? "block" : "none";
}

async function guardarMedico(event) {
  event.preventDefault();

  const form = event.target;
  const datos = new FormData();

  datos.append("id_usuario", document.getElementById("id_usuario").value);
  datos.append("nombres", document.getElementById("nombres").value);
  datos.append("apellidos", document.getElementById("apellidos").value);
  datos.append("cmp", document.getElementById("cmp").value);
  datos.append("id_especialidad", document.getElementById("id_especialidad").value);
  datos.append("telefono", document.getElementById("telefono").value);
  datos.append("direccion", document.getElementById("direccion").value);
  datos.append("correo", document.getElementById("correo").value);

  try {
    const res = await fetch("../php/insertar_medico.php", {
      method: "POST",
      body: datos
    });

    const result = await res.json();

    if (result.success) {
      alert("✅ Médico guardado correctamente");
      toggleFormulario(false);
      cargarMedicos();
    } else {
      alert("❌ Error: " + result.error);
    }
  } catch (err) {
    console.error("Error al guardar médico:", err);
    alert("Error al guardar el médico.");
  }
}
