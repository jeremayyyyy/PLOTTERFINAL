<?php
session_start();

// Registrar la actividad de logout en la base de datos
if (isset($_SESSION['usuario'])) {
    try {
        require_once __DIR__ . '/conexion.php';

        // Obtener el ID del usuario
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $_SESSION['usuario']);
        $stmt->execute();
        $user = $stmt->fetch();

        if ($user) {
            // Registrar el logout en logs de actividad
            $stmt = $pdo->prepare("INSERT INTO logs_actividad (usuario_id, accion, descripcion, ip_address) VALUES (:usuario_id, 'logout', 'Usuario cerró sesión', :ip)");
            $stmt->bindParam(':usuario_id', $user['id']);
            $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
            $stmt->execute();

            // Actualizar último acceso
            $stmt = $pdo->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :usuario_id");
            $stmt->bindParam(':usuario_id', $user['id']);
            $stmt->execute();
        }
        
    } catch(PDOException $e) {
        // Si hay error en la base de datos, continuar con el logout
        error_log("Error al registrar logout: " . $e->getMessage());
    }
}

// Destruir todas las variables de sesión
$_SESSION = array();

// Si se desea destruir la sesión completamente, también hay que borrar la cookie de sesión
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finalmente, destruir la sesión
session_destroy();

// Redirigir al login
header("Location: login.php");
exit();
?>