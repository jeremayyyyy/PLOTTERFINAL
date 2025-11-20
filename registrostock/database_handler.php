<?php date_default_timezone_set('America/Argentina/Buenos_Aires'); ?>
<?php


// database_handler.php - Manejador de operaciones de base de datos para PLOTTER
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

// Usar la conexión centralizada en conexion.php (ruta corregida)
$conexion_path = __DIR__ . '/../conexion.php';
if (!file_exists($conexion_path)) {
    echo json_encode(['success' => false, 'message' => 'Archivo de conexión no encontrado', 'path' => $conexion_path]);
    exit;
}
require_once $conexion_path;

// $this->connection será un PDO conectado a la BD `plotter_db`

class RegistroStockHandler {
    private $db;
    private $connection;

    public function __construct() {
        // Usar la base por defecto definida en `conexion.php`/`config/db_credentials.php`
        $this->connection = pdo_connect();
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

            if (empty($input['fecha']) || empty($input['articulo'])) {
                $this->sendResponse(false, 'Los campos fecha y artículo son obligatorios');
            }

            // 🔧 Normalizar formato de fecha y evitar fechas pasadas
            $fecha_input = $input['fecha'];
            $fecha = date('Y-m-d', strtotime($fecha_input));

            // Si la fecha es pasada, usar la fecha actual
            if ($fecha < date('Y-m-d')) {
                $fecha = date('Y-m-d');
            }

            $sql = "INSERT INTO registro_stock 
                    (fecha, articulo, bolsas_del, bolsas_corte, cuello_morley, 
                     estamperia_salida, estamperia_entrada, taller) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $fecha, // ✅ usamos la fecha normalizada
                $input['articulo'],
                $input['bolsas_del'] ?? null,
                $input['bolsas_corte'] ?? null,
                $input['cuello_morley'] ?? null,
                $input['estamperia_salida'] ?? null,
                $input['estamperia_entrada'] ?? null,
                $input['taller'] ?? null
            ]);

            $nuevoId = $this->connection->lastInsertId();

            // 🔔 Insertar notificación con fecha exacta
            $notif = $this->connection->prepare("INSERT INTO notificaciones (mensaje, fecha, vistas) VALUES (?, NOW(), 0)");
            $msg = "Se ha cargado un nuevo artículo ({$input['articulo']}) en la base de datos.";
            $notif->execute([$msg]);

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

            // 🔧 Normalizar formato de fecha (permitimos pasadas)
            $fecha_input = $input['fecha'] ?? date('Y-m-d');
            $fecha = date('Y-m-d', strtotime($fecha_input));

            $sql = "UPDATE registro_stock SET 
                    fecha = ?, articulo = ?, bolsas_del = ?, bolsas_corte = ?, 
                    cuello_morley = ?, estamperia_salida = ?, estamperia_entrada = ?, taller = ?,
                    fecha_modificacion = CURRENT_TIMESTAMP
                    WHERE id = ?";

            $stmt = $this->connection->prepare($sql);
            $stmt->execute([
                $fecha, // ✅ usamos la fecha normalizada
                $input['articulo'],
                $input['bolsas_del'] ?? null,
                $input['bolsas_corte'] ?? null,
                $input['cuello_morley'] ?? null,
                $input['estamperia_salida'] ?? null,
                $input['estamperia_entrada'] ?? null,
                $input['taller'] ?? null,
                $input['id']
            ]);

            if ($stmt->rowCount() > 0) {
                // 🔔 Insertar notificación con fecha exacta
                $notif = $this->connection->prepare("INSERT INTO notificaciones (mensaje, fecha, vistas) VALUES (?, NOW(), 0)");
                $msg = "Se ha actualizado el artículo ({$input['articulo']}).";
                $notif->execute([$msg]);

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

            // Obtener artículo antes de eliminar
            $articulo = null;
            $getArt = $this->connection->prepare("SELECT articulo FROM registro_stock WHERE id = ?");
            $getArt->execute([$id]);
            if ($row = $getArt->fetch()) {
                $articulo = $row['articulo'];
            }

            $sql = "DELETE FROM registro_stock WHERE id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$id]);

            if ($stmt->rowCount() > 0) {
                // 🔔 Insertar notificación con fecha exacta
                $notif = $this->connection->prepare("INSERT INTO notificaciones (mensaje, fecha, vistas) VALUES (?, NOW(), 0)");
                $msg = $articulo 
                    ? "Se ha eliminado el artículo ($articulo) de la base de datos."
                    : "Se ha eliminado un artículo de la base de datos.";
                $notif->execute([$msg]);

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
    http_response_code(200);
}
?>

<?php
// Sección adicional de notificaciones (ahora usa mysqli helper)
$mysqli = mysqli_connect_db();

// =====================
// NOTIFICACIONES
// =====================

// Obtener todas las notificaciones (las más recientes primero)
function obtenerNotificaciones($mysqli) {
    $sql = "SELECT id, mensaje, fecha, vistas FROM notificaciones ORDER BY fecha DESC";
    $result = $mysqli->query($sql);
    $notificaciones = [];
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $notificaciones[] = $row;
        }
    }
    return $notificaciones;
}

// Contar notificaciones no vistas
function contarNoVistas($mysqli) {
    $sql = "SELECT COUNT(*) AS total FROM notificaciones WHERE vistas = 0";
    $result = $mysqli->query($sql);
    $row = $result->fetch_assoc();
    return $row['total'];
}

// Marcar todas como vistas
function marcarComoVistas($mysqli) {
    $mysqli->query("UPDATE notificaciones SET vistas = 1 WHERE vistas = 0");
}
?>