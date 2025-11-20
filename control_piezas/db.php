<?php
// Usar las credenciales de `conexion.php` y conectar a la DB `control_piezas`
require_once __DIR__ . '/../conexion.php';

// Conectar a la base por defecto definida en `conexion.php` (c2820868_plotter)
try {
    // Si en el servidor la base se llama c2820868_plotter y la tabla se llama control_piezas,
    // conviene usar la DB por defecto para evitar errores de permisos al intentar
    // conectar a una base que el usuario no tiene.
    $conn = mysqli_connect_db();
} catch (Exception $e) {
    die('No se pudo conectar a la base de datos: ' . htmlspecialchars($e->getMessage()));
}

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>