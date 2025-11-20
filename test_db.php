<?php
// Script de diagnóstico para probar conexiones PDO y mysqli usando las credenciales de `conexion.php`
require_once __DIR__ . '/conexion.php';
header('Content-Type: text/plain; charset=utf-8');

echo "Prueba de conexión a la base de datos\n";

// Mostrar las variables (sin la contraseña completa)
echo "Host: $DB_HOST\n";
echo "Usuario: $DB_USER\n";
echo "Base por defecto: $DB_DEFAULT\n\n";

// Probar PDO directamente (sin usar pdo_connect para obtener el error detallado)
try {
    $dsn = "mysql:host={$DB_HOST};dbname={$DB_DEFAULT};charset=utf8mb4";
    $pdo = new PDO($dsn, $DB_USER, $DB_PASS, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "PDO: Conectado correctamente a {$DB_DEFAULT}\n";
} catch (PDOException $e) {
    echo "PDO: ERROR -> " . $e->getMessage() . "\n";
}

// Probar mysqli directamente
try {
    $mysqli = @new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_DEFAULT);
    if ($mysqli->connect_errno) {
        echo "MySQLi: ERROR -> (" . $mysqli->connect_errno . ") " . $mysqli->connect_error . "\n";
    } else {
        echo "MySQLi: Conectado correctamente a {$DB_DEFAULT}\n";
        $mysqli->close();
    }
} catch (Throwable $t) {
    echo "MySQLi: EXCEPCIÓN -> " . $t->getMessage() . "\n";
}

// Indicar si existe la tabla piezas
try {
    if (isset($pdo)) {
        $stmt = $pdo->query("SHOW TABLES LIKE 'piezas'");
        $exists = $stmt && $stmt->rowCount() > 0 ? 'sí' : 'no';
        echo "¿Existe la tabla 'piezas' en {$DB_DEFAULT}? -> {$exists}\n";
    }
} catch (Exception $e) {
    echo "Error comprobando tablas: " . $e->getMessage() . "\n";
}

echo "\nRevisa también el archivo 'db_errors.log' en el directorio del proyecto si existe.\n";

?>