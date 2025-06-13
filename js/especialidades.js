document.getElementById("btn-agregar").addEventListener("click", async () => {
  const nombre = document.getElementById("nombre").value.trim();
  if (nombre === "") {
      alert("Por favor ingresa un nombre de especialidad.");
      return;
  }

  try {
      const response = await fetch("php/agregar_especialidad.php", {
          method: "POST",
          headers: {
              "Content-Type": "application/x-www-form-urlencoded"
          },
          body: "nombre=" + encodeURIComponent(nombre)
      });

      const data = await response.json();
      if (data.success) {
          alert("Especialidad agregada correctamente");
          document.getElementById("nombre").value = "";
          cargarEspecialidades(); // Vuelve a cargar la lista
      } else {
          alert("Error al agregar: " + data.error);
      }
  } catch (error) {
      console.error("Error de red:", error);
  }
});

async function cargarEspecialidades() {
  try {
      const response = await fetch("php/obtener_especialidades.php");
      const especialidades = await response.json();

      const lista = document.getElementById("lista-especialidades");
      lista.innerHTML = "";

      especialidades.forEach(e => {
          const btn = document.createElement("button");
          btn.className = "specialty-btn";
          btn.textContent = e.nombre;
          btn.onclick = () => {
            window.location.href = "php/medicos.php?id_especialidad=" + e.id_especialidad;
          };
          lista.appendChild(btn);
      });
  } catch (error) {
      console.error("Error al cargar especialidades:", error);
  }
}

document.addEventListener("DOMContentLoaded", cargarEspecialidades);
