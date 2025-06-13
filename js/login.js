document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('loginForm');
  
    form.addEventListener('submit', async (e) => {
      e.preventDefault();
  
      const username = document.getElementById('username').value.trim();
      const password = document.getElementById('password').value.trim();
  
      if (!username || !password) {
        alert("Completa todos los campos.");
        return;
      }
  
      try {
        const response = await fetch('php/verificar_login.php', {
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ username, password })
        });
  
        const result = await response.json();
  
        if (result.success) {
          window.location.href = 'principal.html';
        } else {
          alert(result.message);
        }
  
      } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Error al intentar iniciar sesión.");
      }
    });
  });
  