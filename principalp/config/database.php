<?php
// Use the centralized conexion.php helpers
require_once __DIR__ . '/../../conexion.php';

// Esta sección expone la variable $conn (compatibilidad con código existente)
// Usa la base de datos por defecto definida en `conexion.php` / `config/db_credentials.php`.
$conn = pdo_connect();