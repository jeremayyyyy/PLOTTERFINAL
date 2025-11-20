<?php
// Este archivo ahora reutiliza la conexión centralizada en `conexion.php`.
require_once __DIR__ . '/../conexion.php';

// Usar la base de datos por defecto definida en `conexion.php`/`config/db_credentials.php`
// Si se necesita un nombre específico, definir DB_NAME en variables de entorno o en
// `config/db_credentials.php`. Por compatibilidad, si no existe $DB_DEFAULT se usa
// 'plotter_textil' como respaldo.
$db_default = $DB_DEFAULT ?? 'plotter_textil';
if (getenv('DB_NAME')) {
    $db_default = getenv('DB_NAME');
}
define('DB_NAME', $db_default);

function getDBConnection() {
    return pdo_connect(DB_NAME);
}

// Función para registrar actividad del usuario
function logUserActivity($usuario_id, $accion, $descripcion = '') {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO logs_actividad (usuario_id, accion, descripcion, ip_address) VALUES (:usuario_id, :accion, :descripcion, :ip)");
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':accion', $accion);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':ip', $_SERVER['REMOTE_ADDR']);
        $stmt->execute();
    } catch (PDOException $e) {
        error_log("Error al registrar actividad: " . $e->getMessage());
    }
}

// Función para obtener información del usuario
function getUserInfo($usuario) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener información del usuario: " . $e->getMessage());
        return false;
    }
}

// Función para validar usuario y contraseña
function validateUser($usuario, $password) {
    try {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM usuarios WHERE usuario = :usuario AND password = :password AND activo = 1");
        $stmt->bindParam(':usuario', $usuario);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Actualizar último acceso
            $update_stmt = $conn->prepare("UPDATE usuarios SET ultimo_acceso = NOW() WHERE id = :id");
            $update_stmt->bindParam(':id', $user['id']);
            $update_stmt->execute();

            // Registrar login
            logUserActivity($user['id'], 'login', 'Usuario inició sesión');

            return $user;
        }
        return false;
    } catch (PDOException $e) {
        error_log("Error al validar usuario: " . $e->getMessage());
        return false;
    }
}
?>