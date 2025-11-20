<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Control de Piezas - Tizada</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">

  <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
        color: #000;
        background: url("../images/background.png") no-repeat center center fixed;
        background-size: cover;
        min-height: 100vh;
        padding: 30px;
    }

    /* Contenedor principal */
    .container {
    margin: 0;
    }

    /* === HEADER === */
    .header {
        background: rgba(255, 255, 255, 0.85); /* ← más transparente */
        border-radius: 20px;
        padding: 24px 28px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        gap: 16px;
        backdrop-filter: blur(8px); /* ← mejora el efecto sobre el fondo */
    }

    .header-left {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .header-title {
          font-family: 'Orbitron', sans-serif;
          font-size: 2.2rem;
          font-weight: 700;
          color: #00264d;
          letter-spacing: 1px;
          text-transform: uppercase;
          margin: 0;
          line-height: 1;
      }

    /* === BOTÓN VOLVER === */
    .back-btn {
        background: linear-gradient(135deg, #1d4a8e, #2596be);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 10px 14px;
        font-size: 18px;
        cursor: pointer;
        transition: 0.2s;
    }
    .back-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.25);
    }

    /* === FORMULARIO === */
    form {
        margin: 20px 0;
        background: rgba(255, 255, 255, 0.85); /* ← antes era 0.95 */
        padding: 20px;
        border-radius: 14px;
        box-shadow: 0 8px 18px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(6px);
    }

    label {
        margin-right: 10px;
        font-weight: 600;
        color: #00264d;
    }

    select,
    input[type="number"],
    input[type="text"] {
        margin-right: 20px;
        padding: 6px 10px;
        border-radius: 8px;
        border: 1px solid #1d4a8e;
        color: #00264d;
        background: rgba(255, 255, 255, 0.9);
    }

    button {
        padding: 8px 14px;
        border-radius: 10px;
        border: none;
        cursor: pointer;
        font-weight: 700;
        transition: 0.2s;
    }

    /* === BOTÓN GENERAR === */
    #generar {
        background: linear-gradient(135deg, #1d4a8e, #2596be);
        color: #fff;
    }
    #generar:hover { opacity: 0.9; }

    /* === BOTÓN GUARDAR === */
    #guardar {
        background: linear-gradient(135deg, #00264d, #1d4a8e);
        color: #fff;
        margin-top: 15px;
    }
    #guardar:hover { opacity: 0.9; }

    /* === TABLAS === */
    table {
    width: 95%;               /* o 100% si quieres ocupar todo */
    max-width: none;
    margin: 20px auto;        /* centrado */
    background: rgba(255,255,255,0.95); /* si quieres mantener un poco de fondo para contraste */
    border-radius: 12px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }


    th, td {
        border: 1px solid rgba(0, 0, 0, 0.15);
        padding: 10px;
        text-align: center;
    }

    th {
        background-color: rgba(29, 74, 142, 0.1);
        color: #00264d;
        font-weight: 700;
    }

    /* === CELDAS === */
    .cell-btn {
        background-color: rgba(255, 255, 255, 0.95);
        border: 1px solid #1d4a8e;
        padding: 10px;
        width: 60px;
        height: 60px;
        cursor: pointer;
        border-radius: 8px;
        font-family: monospace;
        font-size: 18px;
        color: #00264d;
    }
    .cell-btn.complete {
        background-color: #1d4a8e;
        color: #fff;
    }

    /* === BOTÓN ELIMINAR === */
    .remove-btn {
        margin-top: 5px;
        font-size: 12px;
        background: #ff3131;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 6px;
        padding: 4px 8px;
    }
    .remove-btn:hover { opacity: 0.85; }

    /* === CHECKBOX HALF === */
    .half-box {
        margin-top: 4px;
        font-size: 13px;
        color: #1d4a8e;
    }

    /* === FORM CONTAINER === */
    .form-container {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        gap: 10px;
        background-color: rgba(255, 255, 255, 0.85);
        padding: 15px;
        border-radius: 8px;
        backdrop-filter: blur(6px);
    }
  </style>
</head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
<body>
<div class="container">
  <div class="header">
    <div class="header-left">
          <button class="back-btn" onclick="window.location.href='../principalp/landing.php'">⬅ Volver</button><h1 class="header-title">Control de piezas por curva de talles</h1>
        </div>
    </div>
  </div>
<div class="form-container">
  <form method="POST" id="setup-form">
    <label>Artículo:</label>
    <input type="text" id="articulo" name="articulo" required>

    <label>Prenda:</label>
    <input type="text" id="prenda" name="prenda" required>

    <label>Curva de talles:</label>
    <select name="curve" id="curve" required>
      <option value="">--Seleccionar--</option>
      <option value="4-6-8-10-12-14">4-6-8-10-12-14</option>
      <option value="2-4-6-8-10-12-14">2-4-6-8-10-12-14</option>
      <option value="2-4-6-8-10-12-14-16">2-4-6-8-10-12-14-16</option>
      <option value="XS-S-M-L-XL-XXL-XXXL">XS-S-M-L-XL-XXL-XXXL</option>
      <option value="XS-S-M-L-XL">XS-S-M-L-XL</option>
      <option value="S-M-L-XL-XXL">S-M-L-XL-XXL</option>
      <option value="1-2-3-4-5">1-2-3-4-5</option>
      <option value="1-2-3-4">1-2-3-4</option>
    </select>

    <label>Cantidad de partes:</label>
    <input type="number" name="filas" id="filas" min="1" required>

    <label>Tipo de curva:</label>
    <select name="tipo_curva" id="tipo_curva" required>
      <option value="">--Seleccionar--</option>
      <option value="2-3">T. Punta x2 / T. Medio x3</option>
      <option value="1-2">T. Punta x1 / T. Medio x2</option>
      <option value="1-1.5">T. Punta x1 / T. Medio x1.5</option>
      <option value="2-2">T. Punta x2 / T. Medio x2</option>
    </select>

    <button type="button" id="generar">Generar tabla</button>
  </form>

  <div id="tabla-container"></div>
  <button id="guardar" style="display:none;">Guardar Tabla</button>
  <div id="save-status" style="margin-left:20px;color:#00264d;font-weight:700;"></div>
</div>

<script>
const partesPrenda = [
  "Delantero", "Espalda", "Manga", "Bolsillo", "Fondo de Bolsillo", 
  "Tapa de Bolsillo", "Vista", "Cuello", "Puño", "Cintura", "Capucha", 
  "Canésu", "Bragueta", "Bolsillo A", "Bolsillo B", "Bolsillo C",
  "Delantero C/ Rec. (A)", "Delantero C/ Rec. (B)", "Delantero C/ Rec. (C)"
];

const curvaMultiplicadores = {
  "2-3": { punta: 2, medio: 3 },
  "1-2": { punta: 1, medio: 2 },
  "1-1.5": { punta: 1, medio: 1.5 },
  "2-2": { punta: 2, medio: 2 }
};

const tallesMedios = {
  "4-6-8-10-12-14": ["6", "8", "10"],
  "2-4-6-8-10-12-14": ["4", "6", "8"],
  "2-4-6-8-10-12-14-16": ["6", "8", "10"],
  "XS-S-M-L-XL-XXL-XXXL": ["S", "M", "L"],
  "1-2-3-4-5": ["2", "3", "4"],
  "1-2-3-4": ["2", "3"],
  "XS-S-M-L-XL": ["S", "M", "L"],
  "S-M-L-XL-XXL": ["M", "L", "XL"]
};

document.getElementById('generar').addEventListener('click', () => {
  const curve = document.getElementById('curve').value;
  const filas = parseInt(document.getElementById('filas').value);
  const tipo_curva = document.getElementById('tipo_curva').value;

  if (!curve || !filas || !tipo_curva) {
    alert("Por favor completar todos los campos.");
    return;
  }

  const talles = curve.split('-');
  const medios = tallesMedios[curve] || [];
  const multiplicador = curvaMultiplicadores[tipo_curva];

  const tabla = document.createElement('table');
  const thead = document.createElement('thead');
  const headerRow = document.createElement('tr');

  headerRow.innerHTML = `<th>Parte</th>` + talles.map(t => `<th>${t}</th>`).join('');
  thead.appendChild(headerRow);
  tabla.appendChild(thead);

  const tbody = document.createElement('tbody');

  for (let i = 0; i < filas; i++) {
    const tr = document.createElement('tr');
    let select = `<select name="partes[]">`;
    partesPrenda.forEach(p => { select += `<option value="${p}">${p}</option>`; });
    select += `</select>`;
    tr.innerHTML = `<td>${select}</td>`;

    talles.forEach((t, idx) => {
      const esMedio = medios.includes(t);
      const objetivo = esMedio ? multiplicador.medio : multiplicador.punta;
      tr.innerHTML += `
        <td>
          <button type="button" class="cell-btn" data-count="0" data-objetivo="${objetivo}" data-fila="${i}" data-columna="${idx}"></button>
          <br>
          <button type="button" class="remove-btn">-</button>
          <div class="half-box"><label><input type="checkbox" class="half-check"> ½</label></div>
        </td>`;
    });

    tbody.appendChild(tr);
  }

  tabla.appendChild(tbody);
  document.getElementById('tabla-container').innerHTML = '';
  document.getElementById('tabla-container').appendChild(tabla);
  document.getElementById('guardar').style.display = 'block';
});

// Eventos sumar/restar con casillas
document.addEventListener('click', function(e) {
  if (e.target.classList.contains('cell-btn')) {
    const objetivo = parseFloat(e.target.dataset.objetivo);
    let count = parseFloat(e.target.dataset.count || "0");
    count += 1;
    e.target.dataset.count = count;
    e.target.textContent = renderBoxes(count);
    if (count >= objetivo) e.target.classList.add('complete');
  }

  if (e.target.classList.contains('remove-btn')) {
    const cellBtn = e.target.parentElement.querySelector('.cell-btn');
    let count = parseFloat(cellBtn.dataset.count || "0");
    count -= 1;
    if (count < 0) count = 0;
    cellBtn.dataset.count = count;
    cellBtn.textContent = renderBoxes(count);
    if (count < parseFloat(cellBtn.dataset.objetivo)) {
      cellBtn.classList.remove('complete');
    }
  }
});

// Helper gráfico por casillas
function renderBoxes(count){
  let boxes = "";
  for (let i=0;i<count;i++){ boxes += "■ "; }
  return boxes.trim();
}

// Guardar tabla
document.getElementById('guardar').addEventListener('click', () => {
  console.log('Guardar clicked');
  const articulo = document.getElementById('articulo').value;
  const prenda = document.getElementById('prenda').value;
  const curve = document.getElementById('curve').value;
  const tipo_curva = document.getElementById('tipo_curva').value;

  if (!articulo || !prenda){ alert("Completa articulo y prenda"); return; }

  const filas = [];
  document.querySelectorAll('tbody tr').forEach((tr, i) => {
    const parte = tr.querySelector('select').value;
    const celdas = tr.querySelectorAll('td');
    celdas.forEach((td, idx) => {
      const btn = td.querySelector('.cell-btn');
      if (btn){
        const talle = document.querySelector('thead th:nth-child('+(idx+1)+')').innerText;
        const valor = btn.dataset.count;
        const half = td.querySelector('.half-check')?.checked ? 0.5 : 0;
        filas.push({
          articulo,
          prenda,
          parte,
          talle,
          valor: parseFloat(valor)+half,
          curva: curve,
          tipo_curva: tipo_curva,
          fila: i,
          columna: idx
        });
      }
    });
  });

  fetch("guardar.php", {
    method:"POST",
    headers:{ "Content-Type":"application/json" },
    body:JSON.stringify(filas)
  })
  .then(r=>r.json())
  .then(j=>{
    console.log('Respuesta guardar.php:', j);
    const status = document.getElementById('save-status');
    if (j.success) {
      status.textContent = 'Tabla guardada correctamente';
      alert("Tabla guardada correctamente");
    } else {
      status.textContent = 'Error al guardar: ' + (j.message || 'desconocido');
      alert("Error: "+(j.message || 'Error desconocido'));
    }
  })
  .catch(err=>console.error(err));
});
</script>
</body>
</html>