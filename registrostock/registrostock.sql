-- Base de datos para el sistema PLOTTER - Registro de Stock Textil
-- Archivo: registrostock.sql

-- Crear la base de datos (opcional, puede que ya exista)
CREATE DATABASE IF NOT EXISTS plotter_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE plotter_db;

-- Crear tabla para registro de stock
CREATE TABLE IF NOT EXISTS registro_stock (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha VARCHAR(20) NOT NULL,
    articulo VARCHAR(255) NOT NULL,
    bolsas_del VARCHAR(50) DEFAULT NULL,
    bolsas_corte VARCHAR(50) DEFAULT NULL,
    cuello_morley VARCHAR(255) DEFAULT NULL,
    estamperia_salida VARCHAR(20) DEFAULT NULL,
    estamperia_entrada VARCHAR(20) DEFAULT NULL,
    taller VARCHAR(20) DEFAULT NULL,
    fecha_creacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    fecha_modificacion TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Crear índices para mejorar el rendimiento
CREATE INDEX idx_fecha ON registro_stock(fecha);
CREATE INDEX idx_articulo ON registro_stock(articulo);
CREATE INDEX idx_fecha_creacion ON registro_stock(fecha_creacion);

-- =====================
-- TABLA DE NOTIFICACIONES
-- =====================
DROP TABLE IF EXISTS notificaciones;

CREATE TABLE notificaciones (
    id INT AUTO_INCREMENT PRIMARY KEY,
    mensaje VARCHAR(255) NOT NULL,
    fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    vistas TINYINT(1) NOT NULL DEFAULT 0
);


-- Procedimientos almacenados para operaciones CRUD

-- Procedimiento para insertar un nuevo registro
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS InsertarRegistroStock(
    IN p_fecha VARCHAR(20),
    IN p_articulo VARCHAR(255),
    IN p_bolsas_del VARCHAR(50),
    IN p_bolsas_corte VARCHAR(50),
    IN p_cuello_morley VARCHAR(255),
    IN p_estamperia_salida VARCHAR(20),
    IN p_estamperia_entrada VARCHAR(20),
    IN p_taller VARCHAR(20)
)
BEGIN
    INSERT INTO registro_stock (
        fecha, articulo, bolsas_del, bolsas_corte, cuello_morley, 
        estamperia_salida, estamperia_entrada, taller
    ) VALUES (
        p_fecha, p_articulo, p_bolsas_del, p_bolsas_corte, p_cuello_morley,
        p_estamperia_salida, p_estamperia_entrada, p_taller
    );

    -- Insertar notificación automáticamente
    INSERT INTO notificaciones (mensaje) 
    VALUES (CONCAT('Se han cargado nuevos artículos en la base de datos. Artículo: ', p_articulo));

    SELECT LAST_INSERT_ID() as nuevo_id;
END //
DELIMITER ;

-- Procedimiento para actualizar un registro existente
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS ActualizarRegistroStock(
    IN p_id INT,
    IN p_fecha VARCHAR(20),
    IN p_articulo VARCHAR(255),
    IN p_bolsas_del VARCHAR(50),
    IN p_bolsas_corte VARCHAR(50),
    IN p_cuello_morley VARCHAR(255),
    IN p_estamperia_salida VARCHAR(20),
    IN p_estamperia_entrada VARCHAR(20),
    IN p_taller VARCHAR(20)
)
BEGIN
    UPDATE registro_stock SET
        fecha = p_fecha,
        articulo = p_articulo,
        bolsas_del = p_bolsas_del,
        bolsas_corte = p_bolsas_corte,
        cuello_morley = p_cuello_morley,
        estamperia_salida = p_estamperia_salida,
        estamperia_entrada = p_estamperia_entrada,
        taller = p_taller
    WHERE id = p_id;

    -- Insertar notificación automáticamente
    INSERT INTO notificaciones (mensaje) 
    VALUES (CONCAT('Se han realizado cambios en los datos de un artículo. ID: ', p_id));

    SELECT ROW_COUNT() as filas_afectadas;
END //
DELIMITER ;

-- Procedimiento para eliminar un registro
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS EliminarRegistroStock(
    IN p_id INT
)
BEGIN
    DELETE FROM registro_stock WHERE id = p_id;

    -- Insertar notificación automáticamente
    INSERT INTO notificaciones (mensaje) 
    VALUES (CONCAT('Se ha eliminado un artículo de la base de datos. ID: ', p_id));

    SELECT ROW_COUNT() as filas_eliminadas;
END //
DELIMITER ;

-- Procedimiento para obtener todos los registros
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS ObtenerTodosRegistros()
BEGIN
    SELECT 
        id, fecha, articulo, bolsas_del, bolsas_corte, cuello_morley,
        estamperia_salida, estamperia_entrada, taller, fecha_creacion, fecha_modificacion
    FROM registro_stock 
    ORDER BY fecha_creacion DESC;
END //
DELIMITER ;

-- Procedimiento para obtener un registro específico por ID
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS ObtenerRegistroPorId(
    IN p_id INT
)
BEGIN
    SELECT 
        id, fecha, articulo, bolsas_del, bolsas_corte, cuello_morley,
        estamperia_salida, estamperia_entrada, taller, fecha_creacion, fecha_modificacion
    FROM registro_stock 
    WHERE id = p_id;
END //
DELIMITER ;

-- Procedimiento para insertar notificación manual
DELIMITER //
CREATE PROCEDURE IF NOT EXISTS InsertarNotificacion(
    IN p_mensaje VARCHAR(255)
)
BEGIN
    INSERT INTO notificaciones (mensaje) VALUES (p_mensaje);
END //
DELIMITER ;

-- Vista para reportes con información resumida
CREATE VIEW IF NOT EXISTS vista_resumen_stock AS
SELECT 
    DATE(fecha_creacion) as fecha_registro,
    COUNT(*) as total_registros,
    COUNT(CASE WHEN estamperia_salida IS NOT NULL AND estamperia_salida != '' THEN 1 END) as enviados_estamperia,
    COUNT(CASE WHEN estamperia_entrada IS NOT NULL AND estamperia_entrada != '' THEN 1 END) as recibidos_estamperia,
    COUNT(CASE WHEN taller IS NOT NULL AND taller != '' THEN 1 END) as despachados_taller
FROM registro_stock 
GROUP BY DATE(fecha_creacion)
ORDER BY fecha_registro DESC;

-- Consulta para verificar que todo está correctamente creado
SELECT 'Base de datos y tablas creadas exitosamente' as status;

-- Mostrar estructura de la tabla
DESCRIBE registro_stock;
