<?php
// database_handler.php - Manejador de operaciones de base de datos para PLOTTER
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Usar la conexión centralizada en conexion.php
require_once __DIR__ . '/../conexion.php';


class RegistroStockHandler {
    private $db;
    private $connection;
    
    public function __construct() {
        $this->connection = pdo_connect('plotter_db');
    }
    
    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];
        
        switch ($method) {
            case 'GET':
                $this->obtenerRegistros();
                break;
            case 'POST':
                $this->crearRegistro();
                break;
            case 'PUT':
                $this->actualizarRegistro();
                break;
            case 'DELETE':
                $this->eliminarRegistro();
                break;
            case 'OPTIONS':
                // Manejar preflight CORS
                http_response_code(200);
                break;
            default:
                $this->sendResponse(false, 'Método no permitido');
        }
    }
    
    private function obtenerRegistros() {
        try {
            $sql = "SELECT id, fecha, articulo, bolsas_del, bolsas_corte, cuello_morley, 
                           estamperia_salida, estamperia_entrada, taller, 
                           fecha_creacion, fecha_modificacion 
                    FROM registro_stock 
                    ORDER BY fecha_creacion DESC";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->execute();
            $registros = $stmt->fetchAll();
            
            $this->sendResponse(true, 'Registros obtenidos exitosamente', $registros);
        } catch (PDOException $e) {
            $this->sendResponse(false, 'Error al obtener registros: ' . $e->getMessage());
        }
    }
    
    private function crearRegistro() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            // Validar campos requeridos
            if (empty($input['fecha']) || empty($input['articulo'])) {
                $this->sendResponse(false, 'Los campos fecha y artículo son obligatorios');
            }
            
            $sql = "INSERT INTO registro_stock 
                    (fecha, articulo, bolsas_del, bolsas_corte, cuello_morley, 
                     estamperia_salida, estamperia_entrada, taller) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $input['fecha'],
                $input['articulo'],
                $input['bolsas_del'] ?? null,
                $input['bolsas_corte'] ?? null,
                $input['cuello_morley'] ?? null,
                $input['estamperia_salida'] ?? null,
                $input['estamperia_entrada'] ?? null,
                $input['taller'] ?? null
            ]);
            
            $nuevoId = $this->connection->lastInsertId();
            
            $this->sendResponse(true, 'Registro creado exitosamente', ['id' => $nuevoId]);
        } catch (PDOException $e) {
            $this->sendResponse(false, 'Error al crear registro: ' . $e->getMessage());
        }
    }
    
    private function actualizarRegistro() {
        try {
            $input = json_decode(file_get_contents('php://input'), true);
            
            if (empty($input['id'])) {
                $this->sendResponse(false, 'ID del registro es requerido');
            }
            
            $sql = "UPDATE registro_stock SET 
                    fecha = ?, articulo = ?, bolsas_del = ?, bolsas_corte = ?, 
                    cuello_morley = ?, estamperia_salida = ?, estamperia_entrada = ?, taller = ?
                    WHERE id = ?";
            
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $input['fecha'],
                $input['articulo'],
                $input['bolsas_del'] ?? null,
                $input['bolsas_corte'] ?? null,
                $input['cuello_morley'] ?? null,
                $input['estamperia_salida'] ?? null,
                $input['estamperia_entrada'] ?? null,
                $input['taller'] ?? null,
                $input['id']
            ]);
            
            $filasAfectadas = $stmt->rowCount();
            
            if ($filasAfectadas > 0) {
                $this->sendResponse(true, 'Registro actualizado exitosamente');
            } else {
                $this->sendResponse(false, 'No se encontró el registro o no hubo cambios');
            }
        } catch (PDOException $e) {
            $this->sendResponse(false, 'Error al actualizar registro: ' . $e->getMessage());
        }
    }
    
    private function eliminarRegistro() {
        try {
            $id = $_GET['id'] ?? null;
            
            if (empty($id)) {
                $this->sendResponse(false, 'ID del registro es requerido');
            }
            
            $sql = "DELETE FROM registro_stock WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);
            
            $filasAfectadas = $stmt->rowCount();
            
            if ($filasAfectadas > 0) {
                $this->sendResponse(true, 'Registro eliminado exitosamente');
            } else {
                $this->sendResponse(false, 'No se encontró el registro');
            }
        } catch (PDOException $e) {
            $this->sendResponse(false, 'Error al eliminar registro: ' . $e->getMessage());
        }
    }
    
    private function sendResponse($success, $message, $data = null) {
        echo json_encode([
            'success' => $success,
            'message' => $message,
            'data' => $data,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
        exit;
    }
}

// Ejecutar el manejador
if ($_SERVER['REQUEST_METHOD'] !== 'OPTIONS') {
    $handler = new RegistroStockHandler();
    $handler->handleRequest();
} else {
    // Responder a preflight OPTIONS
    http_response_code(200);
}
?>