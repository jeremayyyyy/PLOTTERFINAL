<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}
if (!isset($_SESSION['session_start_time'])) {
    $_SESSION['session_start_time'] = time();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PLOTTER Textil</title>
    <style>
    /* === landing.php (tema actualizado; distribución original mantenida) === */
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Arial', sans-serif;
  background: url("../images/background.png") center/cover no-repeat;
  background-attachment: fixed;
  min-height: 100vh;
  display: flex;
  flex-direction: column;
  color: #333;
  position: relative;
}

/* overlay para matizar la imagen pero con la nueva paleta azul */
body::before {
  content: '';
  position: absolute; top: 0; left: 0; right: 0; bottom: 0;
  background: linear-gradient(135deg, rgba(29,74,142,0.35), rgba(37,150,190,0.25));
  z-index: 1;
}

/* contenedor principal (misma distribución: max-width y centrado) */
.container { max-width: 1200px; margin: 0 auto; padding: 20px; flex: 1; display:flex;
            flex-direction:column; justify-content:center; align-items:center; position:relative; z-index:2; }

.header {
  text-align: center; margin-bottom: 40px;
  background: rgba(255,255,255,0.92); padding: 30px;
  border-radius: 20px; box-shadow: 0 15px 35px rgba(0,0,0,0.2);
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255,255,255,0.3);
}
/* Título principal */
.header-title {
    font-family: 'Orbitron', sans-serif;
    font-size: 2.8rem;
    font-weight: 700;
    color: #00264d;
    letter-spacing: 1px;
    text-transform: uppercase;
    margin: 0;
    line-height: 1;
}
.logo-container { display:flex; align-items:center; justify-content:center; gap:15px; margin-bottom:15px; }

.logo-icon {
  width:50px; height:50px;
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  border-radius:12px; display:flex; align-items:center; justify-content:center;
  color:white; font-size:24px; box-shadow:0 5px 15px rgba(0,0,0,0.15);
}
.logo { font-size:3rem; font-weight:bold; color:#00264d; text-shadow:2px 2px 4px rgba(0,0,0,0.08); }
.subtitle { font-size:0.9rem; color:#666; }

/* botones principales: mantengo la grilla y tamaños */
.main-buttons {
  display:grid; grid-template-columns: repeat(auto-fit,minmax(280px,1fr)); gap:30px;
  margin-bottom:40px; width:100%; max-width:700px;
}
.main-button {
  background: rgba(255,255,255,0.94);
  border: none; border-radius:20px; padding:35px 25px; cursor:pointer;
  transition: all 0.3s ease; color: #00264d;
  box-shadow: 0 15px 35px rgba(0,0,0,0.15); backdrop-filter: blur(8px);
  border: 1px solid rgba(255,255,255,0.3); display:flex; flex-direction:column;
  align-items:center; justify-content:center; gap:10px;
}
.main-button:hover { transform: translateY(-8px); box-shadow: 0 25px 50px rgba(0,0,0,0.2); background: rgba(255,255,255,1); }
.main-button-icon { width: 200px;px; height: 200px;px; border-radius:18px; overflow:hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.12); }
.main-button-icon img{ width:100%; height:100%; object-fit:cover; }

/* bottom nav (misma posición y comportamiento original) */
.bottom-nav {
  background: rgba(255,255,255,0.95); padding:15px 0; border-radius:20px 20px 0 0;
  position: fixed; bottom: 0; left: 0; right: 0; box-shadow: 0 -10px 30px rgba(0,0,0,0.15);
  backdrop-filter: blur(10px); border-top: 1px solid rgba(255,255,255,0.3); z-index:3;
}
.nav-container { max-width:1200px; margin:0 auto; display:flex; justify-content:space-around; align-items:center; }
.nav-button { background:none; border:none; cursor:pointer; padding:10px; border-radius:10px; transition:all .3s; color:#666; display:flex; flex-direction:column; align-items:center; gap:5px; }
.nav-button:hover { background: rgba(29,74,142,0.06); color:#1d4a8e; }
.nav-button.active { color:#1d4a8e; }

/* === Estilos popup (panel de notificaciones) === */
.notification-popup {
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: rgba(255, 255, 255, 0.92);
  backdrop-filter: blur(15px);
  border-radius: 20px;
  padding: 30px;
  box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
  z-index: 1000;
  max-width: 500px;
  width: 90%;
  max-height: 80vh;
  overflow-y: auto;
  display: none;
  border: 1px solid rgba(255, 255, 255, 0.3);
  color: #333;
}

/* Fondo semitransparente detrás del popup */
.popup-overlay {
  position: fixed;
  top: 0; left: 0; right: 0; bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  z-index: 999;
  display: none;
}

/* Encabezado del popup */
.popup-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
  padding-bottom: 15px;
  border-bottom: 1px solid #e5e5e5;
}

.popup-title {
  font-size: 1.3rem;
  font-weight: 700;
  color: #1f2937;
}

/* Botón de cierre (X) */
.close-btn {
  background: none;
  border: none;
  font-size: 24px;
  cursor: pointer;
  color: #666;
  transition: 0.2s;
}
.close-btn:hover {
  color: #333;
  transform: scale(1.1);
}

/* Cada notificación individual */
.notification-item {
  padding: 14px 18px;
  border-left: 4px solid #8e9eef;
  background: rgba(142, 158, 239, 0.08);
  margin-bottom: 14px;
  border-radius: 0 10px 10px 0;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.notification-date {
  font-size: 0.8rem;
  color: #666;
  margin-bottom: 5px;
}

.notification-message {
  color: #333;
  font-size: 0.95rem;
  line-height: 1.4;
}

/* Información del usuario arriba a la derecha */
.user-info {
  position: absolute;
  top: 20px;
  right: 20px;
  background: rgba(255, 255, 255, 0.9);
  padding: 10px 15px;
  border-radius: 10px;
  font-size: 0.9rem;
  color: #666;
  backdrop-filter: blur(10px);
  border: 1px solid rgba(255, 255, 255, 0.3);
}

/* Efecto de notificación pulsante */
#notificationIcon.pulse {
  color: #ff4444 !important;
  animation: pulse 1s infinite;
}
@keyframes pulse {
  0% { transform: scale(1); }
  50% { transform: scale(1.2); }
  100% { transform: scale(1); }
}

/* === Estilo para la paginación dentro del popup === */
.pagination {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 10px;
  margin-top: 15px;
}

.pagination button {
  background: rgba(255, 255, 255, 0.95);
  border: 1px solid rgba(142, 158, 239, 0.4);
  padding: 8px 14px;
  border-radius: 10px;
  font-size: 0.9rem;
  cursor: pointer;
  color: #333;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.15);
  transition: all 0.3s ease;
}

.pagination button:hover {
  background: rgba(142, 158, 239, 0.1);
  color: #8e9eef;
  transform: translateY(-2px);
}

.pagination button:disabled {
  opacity: 0.5;
  cursor: not-allowed;
  transform: none;
}

.pagination .page-info {
  font-size: 0.85rem;
  color: #666;
  font-weight: 500;
}

    </style>
</head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
<body>
    <div class="user-info">
        Bienvenido, <?php echo $_SESSION['usuario']; ?>
    </div>

    <div class="container">
        <div class="header">
            <div class="logo-container">
                <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
                <div class="logo-icon"><img src="../images/logopng.png" width="50" height="50"></div>
                <div class="header-title">PLOTTER</div>
            </div>
            <div class="subtitle">Textil</div>
            <div class="welcome-text">Bienvenido a nuestro sistema.</div>
            <div class="description">Comenzá a explorar todo lo que tenemos para vos.</div>
        </div>
        <div class="main-buttons">
            <a href="../registrostock/pagbdd.php" class="main-button">
                <div class="main-button-icon"><img src="../images/bdd.jpeg" alt="Base de Datos"></div>
            </a>
            <a href="../control_piezas/listado_articulos.php" class="main-button">
                <div class="main-button-icon"><img src="../images/listado.jpeg" alt="Lista de Tizadas"></div>
            </a>
            <a href="../control_piezas/control.php" class="main-button">
                <div class="main-button-icon"><img src="../images/controlt.jpeg" alt="Control de Tizadas"></div>
            </a>
            <a href="../registrostock/exportacion.php" class="main-button">
        <div class="main-button-icon"><img src="../images/share.jpeg" alt="Compartir"></div>
    </a>
        </div>
    </div>

    <div class="bottom-nav">
    <div class="nav-container">
        <button id="notificationIcon" class="nav-button">
            <div class="nav-icon">🔔</div>
            <div class="nav-label">Notificaciones</div>
        </button>
        <button class="nav-button" onclick="window.location.href='perfil.php'">
            <div class="nav-icon">👤</div>
            <div class="nav-label">Perfil</div>
        </button>
        <button class="nav-button" onclick="logout()">
            <div class="nav-icon">🚪</div>
            <div class="nav-label">Salir</div>
        </button>
    </div>
</div>

    <!-- Popup de notificaciones -->
    <div class="popup-overlay" onclick="closeNotifications()"></div>
    <div class="notification-popup">
        <div class="popup-header">
            <div class="popup-title">Notificaciones</div>
            <button class="close-btn" onclick="closeNotifications()">&times;</button>
        </div>
        <div id="notifications-container"></div>
    </div>

    <script>
let currentPage = 1;
let totalPages = 1;

async function loadNotifications(page = 1) {
    try {
        const res = await fetch(`../registrostock/notificaciones_handler.php?page=${page}&limit=6`);
        const json = await res.json();
        const container = document.getElementById('notifications-container');
        container.innerHTML = '';

        if (json.success && json.data.length) {
            json.data.forEach(n => {
                const item = document.createElement('div');
                item.className = 'notification-item';
                item.innerHTML = `
                    <div class="notification-date">${n.fecha}</div>
                    <div class="notification-message">${n.mensaje}</div>
                `;
                container.appendChild(item);
            });

            // Actualizar paginación
            currentPage = json.page;
            totalPages = json.totalPages;
            renderPagination();
        } else {
            container.innerHTML = '<div class="notification-item"><div class="notification-message">Sin notificaciones</div></div>';
        }
    } catch(e) {
        console.error("Error cargando notificaciones", e);
        document.getElementById('notifications-container').innerHTML =
            '<div class="notification-item"><div class="notification-message">Error cargando notificaciones</div></div>';
    }
}

function renderPagination() {
    let container = document.getElementById("notifications-container");

    // Crear contenedor de paginación
    const pagination = document.createElement("div");
    pagination.className = "pagination";

    // Botón Anterior
    const prevBtn = document.createElement("button");
    prevBtn.textContent = "⬅ Anterior";
    prevBtn.disabled = currentPage === 1;
    prevBtn.onclick = () => loadNotifications(currentPage - 1);
    pagination.appendChild(prevBtn);

    // Info de página
    const pageInfo = document.createElement("span");
    pageInfo.className = "page-info";
    pageInfo.textContent = `Página ${currentPage} de ${totalPages}`;
    pagination.appendChild(pageInfo);

    // Botón Siguiente
    const nextBtn = document.createElement("button");
    nextBtn.textContent = "Siguiente ➡";
    nextBtn.disabled = currentPage === totalPages;
    nextBtn.onclick = () => loadNotifications(currentPage + 1);
    pagination.appendChild(nextBtn);

    // Insertar al final del contenedor
    container.appendChild(pagination);
}



function closeNotifications() {
    document.querySelector('.popup-overlay').style.display = 'none';
    document.querySelector('.notification-popup').style.display = 'none';
}

async function checkNotifications() {
    try {
        const res = await fetch('../registrostock/notificaciones_handler.php');
        const data = await res.json();
        if (data.success) {
            const unread = data.data.filter(n => n.vistas == 0).length;
            const icon = document.getElementById("notificationIcon");
            if (unread > 0) icon.classList.add("pulse"); else icon.classList.remove("pulse");
        }
    } catch(e) {
        console.error("Error verificando notificaciones", e);
    }
}

document.addEventListener("DOMContentLoaded", () => {
    const notificationIcon = document.getElementById("notificationIcon");

    notificationIcon.addEventListener("click", async () => {
        try {
            await loadNotifications();
            await fetch('../registrostock/marcar_notificaciones.php');
        } catch(e) {
            console.error("Error al abrir notificaciones", e);
        }
        notificationIcon.classList.remove("pulse");
        document.querySelector('.popup-overlay').style.display = 'block';
        document.querySelector('.notification-popup').style.display = 'block';
    });

    setInterval(checkNotifications, 15000);
    checkNotifications();
});

function logout() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        window.location.href = '../logout.php';
    }
}
</script>
</body>
</html>