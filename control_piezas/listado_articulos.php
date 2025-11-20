<?php
require_once "db.php"; // conexión

// ==================== Configuración ==================== //
$curvaMultiplicadores = [
  "2-3"   => ["punta" => 2, "medio" => 3],
  "1-2"   => ["punta" => 1, "medio" => 2],
  "1-1.5" => ["punta" => 1, "medio" => 1.5],
  "2-2"   => ["punta" => 2, "medio" => 2],
];

$tallesMedios = [
  "4-6-8-10-12-14"          => ["6", "8", "10"],
  "2-4-6-8-10-12-14"        => ["4", "6", "8"],
  "2-4-6-8-10-12-14-16"     => ["6", "8", "10"],
  "10-12-14-16-2-4-6-8"     => ["6", "8", "10", "12"], 
  "10-12-14-4-6-8"          => ["6", "8", "10"], 
  "10-12-14-16-2-4-6-8"     => ["8", "10", "12"], 
  "XS-S-M-L-XL-XXL-XXXL"    => ["S", "M", "L"],
  "1-2-3-4-5"               => ["2", "3", "4"],
  "1-2-3-4"                 => ["2", "3"],
  "XS-S-M-L-XL"             => ["S", "M", "L"],
  "S-M-L-XL-XXL"            => ["M", "L", "XL"]
];

// ==================== Consulta general ==================== //
$sql = "
  SELECT 
    articulo,
    curva,
    tipo_curva,
    GROUP_CONCAT(DISTINCT talle ORDER BY talle SEPARATOR '-') AS curva_talles
  FROM piezas
  GROUP BY articulo, curva, tipo_curva
  ORDER BY articulo
";

// Ejecutar la consulta dentro de try/catch para capturar excepciones mysqli_sql_exception
try {
  $resultado = $conn->query($sql);
  $articulos = $resultado ? $resultado->fetch_all(MYSQLI_ASSOC) : [];
} catch (mysqli_sql_exception $e) {
  $queryError = 'Error en consulta: ' . $e->getMessage();
  $articulos = [];
}

// ==================== Función detalles ==================== //
function obtenerDetalles($conn, $articulo) {
    try {
        $stmt = $conn->prepare("
      SELECT parte, talle, SUM(valor) AS piezas
      FROM piezas
      WHERE articulo = ?
      GROUP BY parte, talle
      ORDER BY parte, talle
    ");
        if ($stmt === false) return [];
        $stmt->bind_param("s", $articulo);
        $stmt->execute();
        $res = $stmt->get_result();
        return $res ? $res->fetch_all(MYSQLI_ASSOC) : [];
    } catch (mysqli_sql_exception $e) {
        return [];
    }
}

// ==================== Funciones para calcular total ==================== //
function buscarMediosPorCurva($curva, $tallesMedios) {
    $talles = array_filter(array_map('trim', explode('-', $curva)), 'strlen');
    sort($talles, SORT_STRING);

    foreach ($tallesMedios as $clave => $medios) {
        $kTalles = array_filter(array_map('trim', explode('-', $clave)), 'strlen');
        sort($kTalles, SORT_STRING);
        if ($kTalles === $talles) {
            return $medios;
        }
    }
    return [];
}

function calcularTotalPiezas($detalles, $curva, $tipo_curva, $tallesMedios, $curvaMultiplicadores) {
    if (empty($curva) || empty($tipo_curva)) return 0;
    if (!isset($curvaMultiplicadores[$tipo_curva])) return 0;

    $talles = array_filter(array_map('trim', explode('-', $curva)), 'strlen');
    if (empty($talles)) return 0;

    $medios = buscarMediosPorCurva($curva, $tallesMedios);
    $mult = $curvaMultiplicadores[$tipo_curva];

    $cantMedios = 0;
    $cantPunta = 0;
    foreach ($talles as $t) {
        if (in_array($t, $medios, true)) $cantMedios++;
        else $cantPunta++;
    }

    $total = ($cantPunta * $mult['punta']) + ($cantMedios * $mult['medio']);
    return $total;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Listado de Artículos</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
  <style>
body {
  font-family: 'Open Sans', sans-serif;
  background: url("../images/background.png") no-repeat center center fixed;
  background-size: cover;
  min-height: 100vh;
  padding: 30px;
  color: #333;
}
.container {max-width: 1200px; margin: 0 auto;}
.header {
  background: rgba(255,255,255,0.92);
  border-radius: 20px;
  padding: 20px 28px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  box-shadow: 0 15px 35px rgba(0,0,0,0.12);
  margin-bottom: 30px;
  backdrop-filter: blur(6px);
}
.header-title {
  font-family: 'Orbitron', sans-serif;
  font-size: 2.2rem;
  font-weight: 700;
  color: #00264d;
  margin: 0;
}
.back-btn {
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  border: none; color: #fff;
  border-radius: 14px; padding: 10px 14px;
  font-size: 18px; cursor: pointer;
  transition: .2s;
}
.back-btn:hover {transform: translateY(-2px); box-shadow:0 8px 18px rgba(0,0,0,0.12);}
table {
  width: 100%;
  border-collapse: collapse;
  background: rgba(255,255,255,0.94);
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 10px 25px rgba(0,0,0,0.12);
  margin-bottom: 20px;
}
th, td {padding: 14px; border: 1px solid rgba(0,0,0,0.06); text-align: center;}
th {
  background: rgba(29,74,142,0.06);
  font-weight: 700;
  color: #00264d;
}
.btn-detalle {
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  color: white; border: none; border-radius: 8px;
  padding: 6px 12px; cursor: pointer;
  font-size: 14px; transition: .2s;
}
.btn-detalle:hover { opacity: 0.92; }
.sub-table th { background: rgba(255,255,255,0.92); font-weight: 600; color: #333; }
  </style>
</head>
<body>
<div class="container">
  <div class="header">
    <div style="display:flex; align-items:center; gap:15px;">
      <button class="back-btn" onclick="window.location.href='../principalp/landing.php'">⬅ Volver</button>
      <h1 class="header-title">Exportar Registros</h1>
    </div>
  </div>

  <table>
    <thead>
      <tr>
        <th>Artículo</th>
        <th>Curva de Talles</th>
        <th>Tipo de Curva</th>
        <th>Total Prendas x Tela</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($articulos as $row): ?>
        <?php 
          $detalles = obtenerDetalles($conn, $row['articulo']);
          $totalPiezas = calcularTotalPiezas($detalles, $row['curva_talles'], $row['tipo_curva'], $tallesMedios, $curvaMultiplicadores);
          $talles = explode("-", $row['curva_talles']);
        ?>
        <tr class="articulo-row" data-articulo="<?= htmlspecialchars($row['articulo']) ?>">
          <td><?= htmlspecialchars($row['articulo']) ?></td>
          <td><?= htmlspecialchars($row['curva_talles']) ?></td>
          <td><?= htmlspecialchars($row['tipo_curva']) ?></td>
          <td><?= number_format($totalPiezas, 0) ?></td>
          <td><button class="btn-detalle toggle-detalles">Ver Talles</button></td>
        </tr>
        <tr class="detalles-row" style="display:none;">
          <td colspan="5">
            <table class="sub-table">
              <thead>
                <tr>
                  <th>Parte</th>
                  <?php foreach ($talles as $t): ?>
                    <th><?= htmlspecialchars($t) ?></th>
                  <?php endforeach; ?>
                </tr>
              </thead>
              <tbody>
                <?php 
                $porParte = [];
                foreach ($detalles as $d) {
                  $porParte[$d['parte']][$d['talle']] = $d['piezas'];
                }
                foreach ($porParte as $parte => $tallesData): ?>
                  <tr>
                    <td><?= htmlspecialchars($parte) ?></td>
                    <?php foreach ($talles as $t): ?>
                      <td><?= isset($tallesData[$t]) ? $tallesData[$t] : 0 ?></td>
                    <?php endforeach; ?>
                  </tr>
                <?php endforeach; ?>
                <?php if (empty($porParte)): ?>
                  <tr><td colspan="<?= count($talles) + 1 ?>">No hay datos</td></tr>
                <?php endif; ?>
              </tbody>
            </table>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
document.querySelectorAll('.toggle-detalles').forEach(btn => {
  btn.addEventListener('click', () => {
    const tr = btn.closest('tr');
    const detallesRow = tr.nextElementSibling;
    if (detallesRow.style.display === "none") {
      detallesRow.style.display = "table-row";
      btn.textContent = "Ocultar Talles";
    } else {
      detallesRow.style.display = "none";
      btn.textContent = "Ver Talles";
    }
  });
});
</script>
</body>
</html>