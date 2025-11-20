<?php
session_start();

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: login.php");
    exit();
}

if (isset($_SESSION['session_start_time'])) {
    $elapsed_time = time() - $_SESSION['session_start_time'];
    $hours = floor($elapsed_time / 3600);
    $minutes = floor(($elapsed_time % 3600) / 60);
    $seconds = $elapsed_time % 60;
    $contador = sprintf("%02d:%02d:%02d", $hours, $minutes, $seconds);
} else {
    $_SESSION['session_start_time'] = time();
    $contador = "00:00:00";
}

require_once __DIR__ . "/config/database.php";
$sessionUser = $_SESSION['usuario'] ?? null;

$user = [
    'usuario' => $sessionUser,
    'nombre'  => 'No disponible',
    'email'   => 'No disponible',
    'rol'     => 'No asignado',
    'activo'  => 0
];

if ($sessionUser) {
    $stmt = $conn->prepare("SELECT usuario, nombre, email, rol, activo FROM usuarios WHERE usuario = :usuario LIMIT 1");
    $stmt->execute([':usuario' => $sessionUser]);
    if ($f = $stmt->fetch()) $user = $f;
}

$permisos = "Sin permisos";
switch (strtolower($user['rol'])) {
    case 'admin': $permisos = "Acceso total a todas las funciones"; break;
    case 'editor': $permisos = "Puede modificar y gestionar datos"; break;
    case 'viewer': $permisos = "Solo puede visualizar información"; break;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Información del Usuario</title>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
<style>
* { margin: 0; padding: 0; box-sizing: border-box; }

body {
  font-family: 'Open Sans', sans-serif;
  background: url("/images/background.png") center/cover no-repeat fixed;
  min-height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  position: relative;
}
body::before {
  content: '';
  position: absolute;
  inset: 0;
  background: linear-gradient(135deg, rgba(29,74,142,0.35), rgba(37,150,190,0.25));
  z-index: 1;
}
.container {
  position: relative;
  z-index: 2;
  max-width: 500px;
  width: 90%;
  background: rgba(255,255,255,0.94);
  border-radius: 25px;
  box-shadow: 0 20px 40px rgba(0,0,0,0.25);
  backdrop-filter: blur(10px);
  padding: 35px 40px;
}
.header {
  text-align: center;
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  color: white;
  font-family: 'Orbitron', sans-serif;
  font-size: 1.4rem;
  font-weight: 700;
  letter-spacing: 1px;
  padding: 14px;
  border-radius: 12px;
  margin-bottom: 30px;
}
.user-icon {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  background: rgba(29,74,142,0.08);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 40px;
  color: #1d4a8e;
  margin: 0 auto 25px auto;
  box-shadow: 0 6px 15px rgba(0,0,0,0.1);
}
.user-info-box {
  display: flex;
  flex-direction: column;
  gap: 16px;
  margin-bottom: 25px;
}
.field {
  background: rgba(255,255,255,0.9);
  border-radius: 14px;
  box-shadow: 0 4px 10px rgba(0,0,0,0.08);
  padding: 12px 18px 12px 14px;
  border: 1px solid rgba(0,0,0,0.05);
  text-align: left;
  position: relative;
  overflow: hidden;
}
.field::before {
  content: '';
  position: absolute;
  left: 0;
  top: 0;
  bottom: 0;
  width: 6px;
  background: linear-gradient(180deg,#1d4a8e,#2596be);
  border-radius: 6px 0 0 6px;
}
.field-label {
  font-size: 0.8rem;
  color: #1d4a8e;
  font-weight: 700;
  margin-bottom: 4px;
  text-transform: uppercase;
}
.field-value {
  font-size: 1rem;
  color: #333;
  font-weight: 500;
}
.button-row {
  display: flex;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 10px;
}
.btn {
  flex: 1;
  min-width: 120px;
  border-radius: 50px;
  padding: 10px 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all .3s ease;
  font-family: 'Orbitron', sans-serif;
  border: none;
}

/* Botón Volver */
.btn-blue {
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  color: white;
}
.btn-blue:hover {
  background: linear-gradient(135deg,#163d7a,#2080a8);
}

/* Botón Cerrar Sesión (Rojo) */
.btn-red {
  background: linear-gradient(135deg,#d62424,#ff4b4b);
  color: white;
}
.btn-red:hover {
  background: linear-gradient(135deg,#b01b1b,#e13c3c);
}

/* Botón Manual (Verde) */
.btn-green {
  background: linear-gradient(135deg,#1fa84f,#4be27d);
  color: white;
}
.btn-green:hover {
  background: linear-gradient(135deg,#168a40,#3bc768);
}

.session-time {
  text-align: center;
  margin-top: 15px;
  font-size: 1rem;
  font-weight: 600;
  color: #1d4a8e;
}
.session-time span {
  font-weight: bold;
}
</style>
</head>
<body>
  <div class="container">
    <div class="header">Información del Usuario</div>
    <div class="user-icon">👤</div>

    <div class="user-info-box">
      <div class="field">
        <div class="field-label">Usuario</div>
        <div class="field-value"><?= htmlspecialchars($user['usuario']) ?></div>
      </div>
      <div class="field">
        <div class="field-label">Nombre</div>
        <div class="field-value"><?= htmlspecialchars($user['nombre']) ?></div>
      </div>
      <div class="field">
        <div class="field-label">Email</div>
        <div class="field-value"><?= htmlspecialchars($user['email']) ?></div>
      </div>
      <div class="field">
        <div class="field-label">Rol</div>
        <div class="field-value"><?= htmlspecialchars($user['rol']) ?></div>
      </div>
      <div class="field">
        <div class="field-label">Permisos</div>
        <div class="field-value"><?= htmlspecialchars($permisos) ?></div>
      </div>
      <div class="field">
        <div class="field-label">Estado</div>
        <div class="field-value"><?= $user['activo'] ? 'Activo' : 'Inactivo' ?></div>
      </div>
      <div class="field">
        <div class="field-label">Tiempo de sesión activa</div>
        <div class="field-value"><span id="sessionTimer"><?= $contador ?></span></div>
      </div>
    </div>

    <div class="button-row">
      <button class="btn btn-blue" onclick="window.location.href='landing.php'">Volver</button>
      <button class="btn btn-red" onclick="window.location.href='/logout.php'">Cerrar Sesión</button>
      <button class="btn btn-green" onclick="window.open('https://youtu.be/Zz9dIZUcOSM')">🔑 Manual de uso</button>
    </div>

    <div class="session-time">
      🕒 <span id="sessionTimer2"><?= $contador ?></span>
    </div>
  </div>

<script>
let elapsedTime = <?= $elapsed_time ?? 0 ?>;
function updateSessionTimer() {
  elapsedTime++;
  const hours = String(Math.floor(elapsedTime / 3600)).padStart(2,'0');
  const minutes = String(Math.floor((elapsedTime % 3600) / 60)).padStart(2,'0');
  const seconds = String(elapsedTime % 60).padStart(2,'0');
  const formatted = `${hours}:${minutes}:${seconds}`;
  document.getElementById('sessionTimer').textContent = formatted;
  document.getElementById('sessionTimer2').textContent = formatted;
}
setInterval(updateSessionTimer, 1000);
</script>
</body>
</html>
