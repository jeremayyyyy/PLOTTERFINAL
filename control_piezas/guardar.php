<?php
require_once "db.php";

header("Content-Type: application/json");

// Obtener datos en formato JSON
$data = json_decode(file_get_contents("php://input"), true);

if (!$data || !is_array($data)) {
    echo json_encode(["success" => false, "message" => "Datos inválidos"]);
    exit;
}

try {
    // Preparar consulta con ON DUPLICATE KEY UPDATE
    $stmt = $conn->prepare("
        INSERT INTO piezas (
            articulo, prenda, parte, talle, valor, curva, tipo_curva, fila, columna
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ON DUPLICATE KEY UPDATE 
            valor = VALUES(valor),
            fecha = CURRENT_TIMESTAMP
    ");

    foreach ($data as $row) {
        $fila    = $row['fila'] ?? 0;
        $columna = $row['columna'] ?? 0;

        $stmt->bind_param(
            "ssssdssii",
            $row['articulo'],
            $row['prenda'],
            $row['parte'],
            $row['talle'],
            $row['valor'],
            $row['curva'],
            $row['tipo_curva'],
            $fila,
            $columna
        );

        $stmt->execute();
    }

    echo json_encode(["success" => true]);

} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
