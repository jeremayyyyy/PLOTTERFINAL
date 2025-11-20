<?php
header('Content-Type: application/json');

// Usar la conexión centralizada (pdo_connect)
require_once __DIR__ . '/../conexion.php';

try {
    // Usar la base de datos por defecto definida en `conexion.php`/`config/db_credentials.php`
    $conn = pdo_connect();

    // Parámetros GET para paginación
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 6; // ← ahora 6 por defecto
    $offset = ($page - 1) * $limit;

    // Contar total
    $countStmt = $conn->query("SELECT COUNT(*) as total FROM notificaciones");
    $total = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
    $totalPages = ceil($total / $limit);

    $stmt = $conn->prepare("SELECT id, DATE_FORMAT(fecha, '%d/%m/%Y %H:%i') as fecha, mensaje, vistas 
                             FROM notificaciones 
                             ORDER BY fecha DESC
                             LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $notificaciones = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        "success" => true,
        "data" => $notificaciones,
        "page" => $page,
        "totalPages" => $totalPages
    ]);
} catch (Exception $e) {
    // Registrar en log para diagnóstico y devolver mensaje amigable
    @file_put_contents(__DIR__ . '/../db_errors.log', date('Y-m-d H:i:s') . " - notificaciones_handler: " . $e->getMessage() . PHP_EOL, FILE_APPEND);
    echo json_encode([
        "success" => false,
        "error" => 'Error cargando notificaciones'
    ]);
}