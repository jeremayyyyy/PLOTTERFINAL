<?php
// Reutilizar `conexion.php` centralizada
require_once __DIR__ . '/../conexion.php';

$conn = mysqli_connect_db('plotter_textil');
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}
?>
