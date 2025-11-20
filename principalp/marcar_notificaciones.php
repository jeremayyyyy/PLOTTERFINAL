<?php
header('Content-Type: application/json');

require_once __DIR__ . '/../conexion.php';
try {
    $conn = pdo_connect('plotter_db');
    $stmt = $conn->prepare("UPDATE notificaciones SET vistas = 1 WHERE vistas = 0");
    $stmt->execute();

    echo json_encode(["success" => true, "message" => "Notificaciones marcadas como vistas"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "error" => $e->getMessage()]);
}
