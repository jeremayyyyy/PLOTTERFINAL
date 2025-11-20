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
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Arial', sans-serif;
            background: url('images/background.png') center/cover no-repeat;
            background-attachment: fixed;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            color: #333;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute; top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(102,126,234,0.7), rgba(118,75,162,0.7));
            z-index: 1;
        }
        .container {
            max-width: 1200px; margin: 0 auto; padding: 20px;
            flex: 1; display: flex; flex-direction: column; justify-content: center; align-items: center;
            position: relative; z-index: 2;
        }
        .header {
            text-align: center; margin-bottom: 40px;
            background: rgba(255,255,255,0.95); padding: 30px; border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .logo-container { display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 15px; }
        .logo-icon {
            width: 50px; height: 50px; background: linear-gradient(135deg,#8e9eef,#9c88e6);
            border-radius: 12px; display: flex; align-items: center; justify-content: center;
            color: white; font-size: 24px; box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .logo { font-size: 3rem; font-weight: bold; color: #333; text-shadow: 2px 2px 4px rgba(0,0,0,0.1); }
        .subtitle { font-size: 0.9rem; color: #666; margin-bottom: 20px; }
        .welcome-text { font-size: 1.1rem; color: #444; margin-bottom: 10px; }
        .description { font-size: 0.95rem; color: #666; }
        .main-buttons {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px; margin-bottom: 40px; width: 100%; max-width: 700px;
        }
        .main-button {
            background: rgba(255,255,255,0.95); border: none; border-radius: 20px;
            padding: 35px 25px; cursor: pointer; transition: all 0.3s ease;
            text-decoration: none; color: #333;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2); backdrop-filter: blur(15px);
            border: 1px solid rgba(255,255,255,0.3);
            display: flex; flex-direction: column; align-items: center; gap: 20px;
        }
        .main-button:hover {
            transform: translateY(-8px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.3);
            background: rgba(255,255,255,1);
        }
        .main-button-icon {
            width: 80px; height: 80px; background: linear-gradient(135deg,#8e9eef,#9c88e6);
            border-radius: 20px; display: flex; align-items: center; justify-content: center;
            overflow: hidden; box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        .main-button-icon img { width: 100%; height: 100%; object-fit: cover; }
        .main-button-title { font-size: 1.2rem; font-weight: bold; color: #333; text-align: center; line-height: 1.3; }
        .bottom-nav {
            background: rgba(255,255,255,0.95); padding: 15px 0; border-radius: 20px 20px 0 0;
            position: fixed; bottom: 0; left: 0; right: 0;
            box-shadow: 0 -10px 30px rgba(0,0,0,0.2); backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255,255,255,0.3); z-index: 3;
        }
        .nav-container { max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-around; align-items: center; }
        .nav-button {
            background: none; border: none; cursor: pointer; padding: 10px; border-radius: 10px;
            transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; gap: 5px; color: #666;
        }
        .nav-button:hover { background: rgba(142,158,239,0.1); color: #8e9eef; }
        .nav-button.active { color: #8e9eef; }
        .nav-icon { width: 24px; height: 24px; font-size: 20px; }
        .nav-label { font-size: 0.75rem; font-weight: 500; }

        /* Popup de notificaciones */
        .notification-popup {
            position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);
            background: rgba(255,255,255,0.95); backdrop-filter: blur(15px);
            border-radius: 20px; padding: 30px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
            z-index: 1000; max-width: 500px; width: 90%; max-height: 80vh;
            overflow-y: auto; display: none;
            border: 1px solid rgba(255,255,255,0.3);
        }
        .popup-overlay {
            position: fixed; top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(0,0,0,0.5); z-index: 999; display: none;
        }
        .popup-header {
            display: flex; justify-content: space-between; align-items: center;
            margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee;
        }
        .popup-title { font-size: 1.3rem; font-weight: bold; color: #333; }
        .close-btn { background: none; border: none; font-size: 24px; cursor: pointer; color: #666; }
        .notification-item {
            padding: 15px; border-left: 4px solid #8e9eef;
            background: rgba(142,158,239,0.05);
            margin-bottom: 15px; border-radius: 0 10px 10px 0;
        }
        .notification-date { font-size: 0.8rem; color: #666; margin-bottom: 5px; }
        .notification-message { color: #333; font-size: 0.95rem; }
        .user-info {
            position: absolute; top: 20px; right: 20px;
            background: rgba(255,255,255,0.9); padding: 10px 15px; border-radius: 10px;
            font-size: 0.9rem; color: #666; backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        @media (max-width: 768px) {
            .container { padding: 15px; }
            .header { padding: 20px; margin-bottom: 30px; }
            .logo { font-size: 2.5rem; }
            .main-buttons { gap: 20px; grid-template-columns: 1fr; }
            .main-button { padding: 25px 15px; }
            .bottom-nav { padding: 12px 0; }
            .nav-container { padding: 0 15px; }
            .user-info { position: static; margin-bottom: 20px; text-align: center; }
        }
        #notificationIcon.pulse {
            color: #ff4444 !important; /* cambia color cuando hay no leídas */
            animation: pulse 1s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
    </style>
</head>
<body>
    <div class="user-info">
        Bienvenido, <?php echo $_SESSION['usuario']; ?>
    </div>

    <div class="container">
        <div class="header">
            <div class="logo-container">
                <div class="logo-icon">🔷</div>
                <div class="logo">PLOTTER</div>
            </div>
            <div class="subtitle">Textil</div>
            <div class="welcome-text">Bienvenido a nuestro sistema.</div>
            <div class="description">Comenzá a explorar todo lo que tenemos para vos.</div>
        </div>
        <div class="main-buttons">
            <a href="/registrostock/pagbdd.php" class="main-button">
                <div class="main-button-icon">
                    <img src="/images/bdd.jpeg" alt="Base de Datos">
                </div>
                <div class="main-button-title">BASE<br>DE DATOS</div>
            </a>
            <a href="/control_piezas/listado_articulos.php" class="main-button">
                <div class="main-button-icon">
                    <img src="/images/listado.jpeg" alt="Lista de Tizadas">
                </div>
                <div class="main-button-title">LISTA<br>DE TIZADAS</div>
            </a>
            <a href="/control_piezas/control.php" class="main-button">
                <div class="main-button-icon">
                    <img src="/images/controlt.jpeg" alt="Control de Tizadas">
                </div>
                <div class="main-button-title">CONTROL<br>DE TIZADAS</div>
            </a>
        </div>
    </div>

    <div class="bottom-nav">
        <div class="nav-container">
            <button id="notificationIcon" class="nav-button" onclick="openNotifications()">
                <div class="nav-icon">🔔</div>
                <div class="nav-label">Notificaciones</div>
            </button>
            <button class="nav-button">
                <div class="nav-icon">📤</div>
                <div class="nav-label">Compartir</div>
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
async function loadNotifications() {
    try {
        const res = await fetch('notificaciones_handler.php');
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
        } else {
            container.innerHTML = '<div class="notification-item"><div class="notification-message">Sin notificaciones</div></div>';
        }
    } catch (e) {
        console.error("Error al cargar notificaciones", e);
    }
}

// Cerrar popup
function closeNotifications() {
    document.querySelector('.popup-overlay').style.display = 'none';
    document.querySelector('.notification-popup').style.display = 'none';
}

let lastUnreadCount = 0;

// Función para revisar notificaciones nuevas
async function checkNotifications(auto = true) {
    try {
        let res = await fetch("notificaciones_handler.php");
        let data = await res.json();

        if (data.success) {
            const unread = data.data.filter(n => n.vistas === 0).length;

            // Campana con animación si hay no leídas
            if (unread > 0) {
                document.getElementById("notificationIcon").classList.add("pulse");
            } else {
                document.getElementById("notificationIcon").classList.remove("pulse");
            }

            // Si el popup está abierto, refrescar lista
            if (!auto && data.data.length > 0) {
                let html = "";
                data.data.forEach(n => {
                    html += `
                        <div class="notification-item">
                            <div class="notification-date">${n.fecha}</div>
                            <div class="notification-message">${n.mensaje}</div>
                        </div>
                    `;
                });
                document.getElementById("notifications-container").innerHTML = html;
            }
        }
    } catch (e) {
        console.error("Error al verificar notificaciones", e);
    }
}

// Click en campana
document.getElementById("notificationIcon").addEventListener("click", async () => {
    await loadNotifications();
    await fetch("marcar_notificaciones.php");
    document.getElementById("notificationIcon").classList.remove("pulse");
    document.querySelector('.popup-overlay').style.display = 'block';
    document.querySelector('.notification-popup').style.display = 'block';
});

// Revisar cada 15 segundos automáticamente
setInterval(() => checkNotifications(true), 15000);

// Llamar al inicio
checkNotifications(true);

// Logout
function logout() {
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        window.location.href = '/logout.php';
    }
}
</script>
</body>
</html>
<?php
include 'database_handler.php';

// Consultar notificaciones y cantidad de no vistas
$notificaciones = obtenerNotificaciones($conn);
$noVistas = contarNoVistas($conn);

// Si el usuario abre el panel, marcar todas como vistas
if (isset($_GET['ver_notificaciones'])) {
    marcarComoVistas($conn);
    header("Location: landing.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Landing</title>
    <style>
        /* === Estilos básicos para el panel === */
        .notificacion-btn {
            position: relative;
            cursor: pointer;
            background: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
        }
        .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: red;
            color: white;
            border-radius: 50%;
            padding: 3px 7px;
            font-size: 12px;
        }
        .panel-notificaciones {
            display: none;
            position: absolute;
            top: 50px;
            right: 20px;
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
            border: 1px solid #ccc;
            background: #fff;
            box-shadow: 0px 4px 6px rgba(0,0,0,0.2);
            z-index: 999;
        }
        .notificacion {
            border-bottom: 1px solid #eee;
            padding: 10px;
            font-size: 14px;
        }
        .notificacion small {
            display: block;
            color: #888;
        }
    </style>
</head>
<body>

<!-- Botón de notificaciones -->
<button class="notificacion-btn" onclick="togglePanel()">
    Notificaciones
    <?php if ($noVistas > 0): ?>
        <span class="badge"><?= $noVistas ?></span>
    <?php endif; ?>
</button>

<!-- Panel desplegable -->
<div id="panelNotificaciones" class="panel-notificaciones">
    <?php if (count($notificaciones) > 0): ?>
        <?php foreach ($notificaciones as $n): ?>
            <div class="notificacion">
                <?= htmlspecialchars($n['mensaje']) ?>
                <small><?= $n['fecha'] ?></small>
            </div>
        <?php endforeach; ?>
        <a href="landing.php?ver_notificaciones=1">Marcar todas como vistas</a>
    <?php else: ?>
        <p style="padding:10px;">No hay notificaciones</p>
    <?php endif; ?>
</div>

<script>
function togglePanel() {
    let panel = document.getElementById('panelNotificaciones');
    panel.style.display = (panel.style.display === 'block') ? 'none' : 'block';
}
</script>

</body>
</html>

