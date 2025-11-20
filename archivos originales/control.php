<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Control de Piezas - Tizada</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>

<h2>Control de piezas por curva de talles</h2>

<form method="POST" id="setup-form">
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

  <label>Tipo de curva (cantidades):</label>
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

<script src="script.js"></script>

<style>
body {
  font-family: Arial, sans-serif;
  margin: 20px;
  background-color: #f4f4f4;
}
h2 {
  color: #333;
}
form {
  margin-bottom: 20px;
}
label {
  margin-right: 10px;
}
select, input[type="number"] {
  margin-right: 20px;
  padding: 5px;
}
button {
  padding: 8px 12px;
}
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: white;
}
th, td {
  border: 1px solid #ccc;
  padding: 10px;
  text-align: center;
}
.cell-btn {
  background-color: #fff;
  border: 1px solid #999;
  padding: 10px;
  width: 50px;
  height: 50px;
  cursor: pointer;
}
.cell-btn.complete {
  background-color: #4caf50;
  color: white;
}
.remove-btn {
  margin-top: 5px;
  font-size: 12px;
  background: #f44336;
  color: white;
  border: none;
  cursor: pointer;
}
</style>

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
  const medios = tallesMedios[curve] || []; // Obtener los talles del medio según la curva
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
    partesPrenda.forEach(p => {
      select += `<option value="${p}">${p}</option>`;
    });
    select += `</select>`;

    tr.innerHTML = `<td>${select}</td>`;

    talles.forEach((t) => {
      const esMedio = medios.includes(t); // Verificar si el talle está en los talles del medio
      const cantidadNecesaria = esMedio ? multiplicador.medio : multiplicador.punta;

      tr.innerHTML += `<td><button type="button" class="cell-btn" data-objetivo="${cantidadNecesaria}">0</button><br><button type="button" class="remove-btn">-</button></td>`;
    });

    tbody.appendChild(tr);
  }

  tabla.appendChild(tbody);
  document.getElementById('tabla-container').innerHTML = '';
  document.getElementById('tabla-container').appendChild(tabla);
});

document.addEventListener('click', function(e) {
  if (e.target.classList.contains('cell-btn')) {
    if (e.target.classList.contains('complete')) {
      // Si ya está completo, no permitir más clics para sumar
      return;
    }

    let count = parseInt(e.target.dataset.count || "0"); // Obtener el conteo actual
    const objetivo = parseInt(e.target.dataset.objetivo); // Obtener el objetivo
    count += 1; // Incrementar el conteo
    e.target.dataset.count = count; // Actualizar el conteo en el atributo

    // Actualizar el contenido del botón con el formato de puntos
    e.target.textContent = generarPuntajeTruco(count);

    // Si se alcanza el objetivo, marcar como completo
    if (count >= objetivo) {
      e.target.classList.add('complete');
    }
  }

  if (e.target.classList.contains('remove-btn')) {
    const cellBtn = e.target.previousElementSibling;

    if (!cellBtn) return; // Asegurarse de que el botón existe

    let count = parseInt(cellBtn.dataset.count || "0");
    count -= 1; // Decrementar el conteo sin restricciones
    if (count < 0) count = 0; // Evitar valores negativos
    cellBtn.dataset.count = count; // Actualizar el conteo en el atributo

    // Actualizar el contenido del botón con el formato de puntos
    cellBtn.textContent = generarPuntajeTruco(count);

    // Si el conteo es menor al objetivo, quitar el estado "Completo"
    if (count < parseInt(cellBtn.dataset.objetivo)) {
      cellBtn.classList.remove('complete');
    }
  }
});

// Función para generar el puntaje en formato de truco
function generarPuntajeTruco(count) {
  const puntos = ["", "•", "••", "•••", "••••", "•••••"]; // Representación de puntos
  return puntos[count] || ""; // Devolver el formato correspondiente
}
</script>

</body>
</html>