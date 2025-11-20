<?php
// exportar_excel.php - ahora usa las credenciales de conexion.php
header("Content-Type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=registros_seleccionados.xls");
header("Pragma: no-cache");
header("Expires: 0");

require_once __DIR__ . '/../conexion.php';

$conn = mysqli_connect_db();

// Leer IDs enviados desde exportacion.php
$input = json_decode(file_get_contents('php://input'), true);
$ids = $input['ids'] ?? [];

if (empty($ids)) {
    echo "No se seleccionaron registros para exportar.";
    exit;
}

// Convertir lista de IDs a formato seguro
$idList = implode(',', array_map('intval', $ids));
$sql = "SELECT * FROM registro_stock WHERE id IN ($idList)";
$result = $conn->query($sql);

// Generar tabla HTML compatible con Excel
echo "<table border='1'>";
echo "<tr>
<th>ID</th>
<th>Fecha</th>
<th>Artículo</th>
<th>Bolsas DEL</th>
<th>Bolsas Corte</th>
<th>Cuello-Morley</th>
<th>Estampería Salida</th>
<th>Estampería Entrada</th>
<th>Taller</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>{$row['id']}</td>
        <td>{$row['fecha']}</td>
        <td>{$row['articulo']}</td>
        <td>{$row['bolsas_del']}</td>
        <td>{$row['bolsas_corte']}</td>
        <td>{$row['cuello_morley']}</td>
        <td>{$row['estamperia_salida']}</td>
        <td>{$row['estamperia_entrada']}</td>
        <td>{$row['taller']}</td>
    </tr>";
}
echo "</table>";
$conn->close();
?>