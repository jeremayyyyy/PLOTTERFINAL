<?php
// Archivo de conexión centralizado
// Credenciales tomadas de "conexion 1.php" (archivo original del usuario)
// Este archivo expone:
// - $pdo        : PDO conectado a la DB por defecto
// - $mysqli     : mysqli conectado a la DB por defecto
// - function pdo_connect($dbname = null)
// - function mysqli_connect_db($dbname = null)

// Configuración central (host/usuario/clave). Cambiar aquí para producción.
// Intentamos cargar credenciales desde un archivo de configuración opcional
// `config/db_credentials.php` o desde variables de entorno. Si no existen,
// se usan valores por defecto (antiguos) para compatibilidad.
$DB_HOST = 'localhost';
$DB_USER = 'c2820868_plotter';
$DB_PASS = '53kapenaPI';
$DB_DEFAULT = 'c2820868_plotter';

// Ruta a archivo opcional con $DB_HOST, $DB_USER, $DB_PASS, $DB_DEFAULT
$creds_file = __DIR__ . '/config/db_credentials.php';
if (file_exists($creds_file)) {
    // El archivo debe definir las mismas variables
    @include $creds_file;
}

// Sobrescribir con variables de entorno si están definidas (útil en contenedores)
if (getenv('DB_HOST')) $DB_HOST = getenv('DB_HOST');
if (getenv('DB_USER')) $DB_USER = getenv('DB_USER');
if (getenv('DB_PASS')) $DB_PASS = getenv('DB_PASS');
if (getenv('DB_DEFAULT')) $DB_DEFAULT = getenv('DB_DEFAULT');

function pdo_connect($dbname = null) {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_DEFAULT;
    $db = $dbname ?: $DB_DEFAULT;
    $dsn = "mysql:host={$DB_HOST};dbname={$db};charset=utf8mb4";
    try {
        $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
        return $pdo;
    } catch (PDOException $e) {
        $msg = 'Error de conexión PDO a ' . $db . ': ' . $e->getMessage();
        // Registrar en log local para diagnóstico (no exponer en producción)
        @file_put_contents(__DIR__ . '/db_errors.log', date('Y-m-d H:i:s') . " - " . $msg . PHP_EOL, FILE_APPEND);
        error_log($msg);
        // Mensaje amigable al usuario
        die('Error de conexión a la base de datos. Revisa el archivo `db_errors.log` en el directorio del proyecto para más detalles.');
    }
}

function mysqli_connect_db($dbname = null) {
    global $DB_HOST, $DB_USER, $DB_PASS, $DB_DEFAULT;
    $db = $dbname ?: $DB_DEFAULT;
    try {
        // Desde PHP 8, mysqli puede lanzar mysqli_sql_exception en fallos de conexión
        $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $db);
    } catch (mysqli_sql_exception $e) {
        error_log('Error de conexión mysqli a ' . $db . ': ' . $e->getMessage());
        // Mensaje claro para diagnóstico (no exponer credenciales)
        die('Error de conexión a la base de datos: ' . $e->getMessage());
    }
    if ($conn->connect_error) {
        error_log('Error de conexión mysqli a ' . $db . ': ' . $conn->connect_error);
        die('Error de conexión a la base de datos.');
    }
    $conn->set_charset('utf8mb4');
    return $conn;
}

// Conexiones por defecto (a la BD por defecto)
$pdo = pdo_connect();
$mysqli = mysqli_connect_db();

?>