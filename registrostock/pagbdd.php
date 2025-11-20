<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Base de Datos - PLOTTER</title>
<style>
    /* === Estilo original (header + tarjeta + tabla + modal) === */
    /* === pagbdd.php (tema actualizado, estructura original mantenida) === */
*{margin:0;padding:0;box-sizing:border-box}
body{
  font-family:'Arial',sans-serif;
  background: url("../images/background.png") no-repeat center center fixed;
  background-size: cover;
  min-height:100vh;
  padding:30px;
  color:#333;
}

/* contenedor y header (misma distribución y ancho original) */
.container{max-width:1250px;margin:0 auto}
.header{
  background: rgba(255,255,255,0.90);      /* translúcido para dejar ver imagen */
  border-radius:20px;
  padding:24px 28px;
  display:flex;
  align-items:center;
  justify-content:space-between;
  box-shadow:0 15px 35px rgba(0,0,0,0.12);
  gap:16px;
  backdrop-filter: blur(6px);
}
.header-left{display:flex;align-items:center;gap:16px}
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
/* botones */
.back-btn{
  background:linear-gradient(135deg,#1d4a8e,#2596be);
  border:none;color:#fff;border-radius:14px;
  padding:10px 14px; font-size:18px; cursor:pointer; transition:.2s;
}
.back-btn:hover{transform:translateY(-2px);box-shadow:0 8px 18px rgba(0,0,0,0.15)}

.add-btn{
  background:linear-gradient(135deg,#1d4a8e,#2596be);
  border:none;color:#fff;border-radius:14px;
  padding:12px 18px;font-size:1rem;font-weight:700;cursor:pointer;transition:.2s;
}
.add-btn:hover{transform:translateY(-2px);box-shadow:0 10px 22px rgba(0,0,0,0.15)}

/* panel de tabla: mantengo la caja pero con el nuevo look */
.table-container{
  margin-top:28px;
  background: rgba(255,255,255,0.92);
  border-radius:20px;
  overflow:hidden;
  box-shadow:0 18px 38px rgba(0,0,0,0.15);
  border: 1px solid rgba(0,0,0,0.05);
}
.table-header{
  background: linear-gradient(135deg,#1d4a8e,#2596be);
  color:#fff; font-weight:700; padding:18px 26px; font-size:1.2rem;
}
.table-wrapper{overflow-x:auto}

/* tabla (misma disposición: ancho 100% dentro del contenedor) */
table{width:100%; border-collapse:collapse; font-size:.95rem}
th,td{padding:14px 12px; border-bottom:1px solid #ececec; white-space:nowrap; text-align:left}
th{
  background:rgba(29,74,142,0.06);
  color:#00264d; font-weight:700; position:sticky; top:0; z-index:2;
}
tr:hover{background:rgba(29,74,142,0.03)}

.actions{display:flex;gap:8px}
.edit-btn,.delete-btn{
  border:none;border-radius:8px; padding:8px 12px; cursor:pointer; font-weight:600;
  color:#fff; transition:.15s;
}
.edit-btn{background:#1d4a8e}
.delete-btn{background:#ff3131}
.edit-btn:hover,.delete-btn:hover{opacity:.9; transform:translateY(-1px)}

.btn-primary,.btn-secondary{
  border:none;border-radius:10px; padding:10px 16px; cursor:pointer; font-weight:600;
}
.btn-primary{background:linear-gradient(135deg,#1d4a8e,#2596be); color:#fff}
.btn-secondary{background:#e5e7eb; color:#333}

/* paginación y chips */
.toolbar{margin:20px 0; display:flex; gap:10px}
#pagination{margin-top:18px; display:flex; justify-content:center; gap:8px; flex-wrap:wrap}
#pagination .page-chip{
  padding:6px 10px; background:#1d4a8e; color:#fff; border-radius:8px; font-weight:700;
}

/* modal (estructura original) */
.modal{display:none;position:fixed;z-index:1000;left:0;top:0;width:100%;height:100%;
    background-color:rgba(0,0,0,0.45)}
.modal-content{
    background:rgba(255,255,255,0.95); margin:2% auto; padding:26px; border-radius:20px;
    width:92%; max-width:900px; max-height:90vh; overflow-y:auto;
    box-shadow:0 20px 40px rgba(0,0,0,0.25);
}
.modal-header{display:flex;justify-content:space-between;align-items:center;
    padding-bottom:14px;border-bottom:2px solid #eee;margin-bottom:18px}
.modal-title{font-size:1.4rem;font-weight:700;color:#00264d}
.close{font-size:28px;color:#999;cursor:pointer}
.form-group{margin-bottom:14px; display:flex; flex-direction:column; gap:6px}
.form-row{display:grid; grid-template-columns:1fr 1fr; gap:14px}
.form-group label{font-weight:600; color:#00264d}
.form-group input{
    padding:10px 12px; border:1px solid #dcdcdc; border-radius:10px; font-size:1rem;
}
.form-actions{display:flex; gap:10px; justify-content:flex-end; margin-top:10px}
@media (max-width:768px){ .form-row{grid-template-columns:1fr} }

</style>
</head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
<body>
<div class="container">
    <div class="header">
        <div class="header-left">
            <!-- Botón volver: apunta a principalp/landing.php -->
            <button class="back-btn" onclick="window.location.href='../principalp/landing.php'">←</button>
            <div class="header-title">Base de Datos</div>
        </div>
        <button class="add-btn" onclick="openModal()">+ Cargar Datos/Registro</button>
    </div>

    <!-- Buscador (no altera estilos existentes) -->
    <div class="toolbar">
        <input type="text" id="searchInput" placeholder="Buscar por identificador de artículo..." 
               style="flex:1;padding:10px;border-radius:10px;border:1px solid #dcdcdc;">
        <button class="btn-primary" onclick="buscar()">Buscar</button>
        <button class="btn-secondary" onclick="resetBusqueda()">Limpiar</button>
    </div>

    <div class="table-container">
        <div class="table-header">Registro de Stock Textil</div>
        <div class="table-wrapper">
            <table id="dataTable">
                <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Artículo</th>
                        <th>Bolsas (ESTAMPERIA)</th>
                        <th>Bolsas Corte</th>
                        <th>Cuello-Morley</th>
                        <th>Estampería Salida</th>
                        <th>Estampería Entrada</th>
                        <th>Taller</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <!-- Paginación -->
    <div id="pagination"></div>
</div>

<!-- Modal (mismo formato original) -->
<div id="recordModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-title" id="modalTitle">Agregar Nuevo Registro</div>
            <span class="close" onclick="closeModal()">&times;</span>
        </div>

        <form id="recordForm">
        <input type="hidden" id="recordId" name="id">
            <div class="form-group">
                <label for="fecha">Fecha</label>
                <input type="date" id="fecha" name="fecha" onkeydown="return false;" required>
                    <script>
                    // Establece la fecha mínima a hoy, desde el navegador
                    const inputFecha = document.getElementById('fecha');
                    const hoy = new Date().toISOString().split('T')[0];
                    inputFecha.min = hoy;
                    </script>
            </div>

            <div class="form-group">
                <label for="articulo">Artículo</label>
                <input type="text" id="articulo" name="articulo" placeholder="Identificador / descripción (ej: v25 1000v ; o/c 999)" required>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="bolsas_del">Bolsas (ESTAMPERIA)</label>
                    <input type="text" id="bolsas_del" name="bolsas_del" placeholder="Cantidad">
                </div>
                <div class="form-group">
                    <label for="bolsas_corte">Bolsas Corte</label>
                    <input type="text" id="bolsas_corte" name="bolsas_corte" placeholder="Cantidad">
                </div>
            </div>

            <div class="form-group">
                <label for="cuello_morley">Cuello-Morley</label>
                <input type="text" id="cuello_morley" name="cuello_morley" placeholder="Descripción">
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="estamperia_salida">Estampería Salida</label>
                    <input type="text" id="estamperia_salida" name="estamperia_salida" placeholder="ej: 12/12/2025">
                </div>
                <div class="form-group">
                    <label for="estamperia_entrada">Estampería Entrada</label>
                    <input type="text" id="estamperia_entrada" name="estamperia_entrada" placeholder="ej: 13/12/2025">
                </div>
            </div>

            <div class="form-group">
                <label for="taller">Taller</label>
                <input type="text" id="taller" name="taller" placeholder="Nombre / fecha despacho">
            </div>
            <form id="recordForm"
              <div class="form-actions">
                 <button type="button" class="btn-secondary" onclick="closeModal()">Cancelar</button>
                <button type="submit" class="btn-primary">Guardar</button>
               </div>
         </form>
    </div>
</div>

<script>
/* === Parámetros y estado === */
const API_URL = './database_handler.php'; // tu endpoint existente
const PER_PAGE = 10;                    // 10 por página (requisito)
let allRecords = [];                    // todos los registros del backend
let filtered = [];                      // registros filtrados por buscador
let currentPage = 1;
let totalPages = 1;
let searchTerm = '';                    // término de búsqueda (articulo o id)

/* === Carga inicial === */
document.addEventListener('DOMContentLoaded', () => {
    cargarRegistros();
});

/* === Cargar datos desde backend (sin tocar tu lógica de CRUD) === */
async function cargarRegistros(page = 1) {
    try {
        const res = await fetch(API_URL, { method: 'GET' });
        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Error al cargar datos');
        allRecords = Array.isArray(json.data) ? json.data : [];
        // aplicar búsqueda + paginación cada vez que recargamos
        aplicarBusquedaYPaginacion(page);
    } catch (e) {
        console.error(e);
        alert('No se pudieron cargar los datos.');
    }
}

/* === Búsqueda por identificador de artículo (y opcionalmente por id numérico) === */
function buscar() {
    searchTerm = (document.getElementById('searchInput').value || '').trim();
    currentPage = 1;
    aplicarBusquedaYPaginacion(currentPage);
}
function resetBusqueda() {
    document.getElementById('searchInput').value = '';
    searchTerm = '';
    currentPage = 1;
    aplicarBusquedaYPaginacion(currentPage);
}

/* === Filtrado + Paginación (cliente) === */
function aplicarBusquedaYPaginacion(page) {
    const term = searchTerm.toLowerCase();
    if (term) {
        filtered = allRecords.filter(r => {
            const art = (r.articulo ?? '').toString().toLowerCase();
            const byArticulo = art.includes(term);
            const byId = /^\d+$/.test(term) ? String(r.id ?? '').toString() === term : false;
            return byArticulo || byId;
        });
    } else {
        filtered = [...allRecords];
    }

    totalPages = Math.max(1, Math.ceil(filtered.length / PER_PAGE));
    currentPage = Math.min(Math.max(1, page), totalPages);

    const start = (currentPage - 1) * PER_PAGE;
    const pageData = filtered.slice(start, start + PER_PAGE);

    renderTabla(pageData);
    renderPaginacion();
}

/* === Render tabla (NO cambia estilos ni estructura) === */
function renderTabla(rows) {
    const tbody = document.querySelector('#dataTable tbody');
    tbody.innerHTML = '';

    if (!rows.length) {
        tbody.innerHTML = `<tr><td colspan="9" style="text-align:center;padding:20px;">Sin resultados</td></tr>`;
        return;
    }

    rows.forEach(r => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td>${r.fecha ?? ''}</td>
            <td>${r.articulo ?? ''}</td>
            <td>${r.bolsas_del ?? ''}</td>
            <td>${r.bolsas_corte ?? ''}</td>
            <td>${r.cuello_morley ?? ''}</td>
            <td>${r.estamperia_salida ?? ''}</td>
            <td>${r.estamperia_entrada ?? ''}</td>
            <td>${r.taller ?? ''}</td>
            <td>
                <div class="actions">
                    <button class="edit-btn" onclick="editRecord(${r.id})">Editar</button>
                    <button class="delete-btn" onclick="deleteRecord(${r.id})">Eliminar</button>
                </div>
            </td>`;
        tbody.appendChild(tr);
    });
}

/* === Paginación: Anterior / Siguiente / -5 / +5 + contador === */
function renderPaginacion() {
    const p = document.getElementById('pagination');
    p.innerHTML = '';

    if (currentPage > 5) {
        const b = document.createElement('button');
        b.className = 'btn-secondary';
        b.textContent = '« -5';
        b.onclick = () => aplicarBusquedaYPaginacion(currentPage - 5);
        p.appendChild(b);
    }

    if (currentPage > 1) {
        const b = document.createElement('button');
        b.className = 'btn-secondary';
        b.textContent = 'Anterior';
        b.onclick = () => aplicarBusquedaYPaginacion(currentPage - 1);
        p.appendChild(b);
    }

    const chip = document.createElement('span');
    chip.className = 'page-chip';
    chip.textContent = `${currentPage} / ${totalPages}`;
    p.appendChild(chip);

    if (currentPage < totalPages) {
        const b = document.createElement('button');
        b.className = 'btn-secondary';
        b.textContent = 'Siguiente';
        b.onclick = () => aplicarBusquedaYPaginacion(currentPage + 1);
        p.appendChild(b);
    }

    if (currentPage + 5 <= totalPages) {
        const b = document.createElement('button');
        b.className = 'btn-secondary';
        b.textContent = '+5 »';
        b.onclick = () => aplicarBusquedaYPaginacion(currentPage + 5);
        p.appendChild(b);
    }
}

/* === Modal: se mantienen nombres/flujo originales === */
function openModal() {
    const fechaInput = document.getElementById('fecha');
    document.getElementById('recordForm').reset();
    document.getElementById('modalTitle').textContent = 'Agregar Nuevo Registro';
    document.getElementById('recordModal').style.display = 'block';

    // Habilita la restricción solo al crear
    const hoy = new Date().toISOString().split('T')[0];
    fechaInput.min = hoy;
    fechaInput.onkeydown = () => false; // bloquea escritura manual
}

function closeModal() {
    const modal = document.getElementById('recordModal');
    modal.style.display = 'none';

    // Limpia el formulario al cerrar (por seguridad visual)
    document.getElementById('recordForm').reset();
}

/* === Guardar (no cambio tu lógica de backend: POST JSON a database_handler.php) === */
document.getElementById('recordForm').addEventListener('submit', async (e) => {
    e.preventDefault();
    const data = Object.fromEntries(new FormData(e.target).entries());

    // 👇 Si hay id => edición, si no => alta
    const isEdit = data.id && data.id.trim() !== "";

    try {
        const res = await fetch(API_URL + (isEdit ? `?id=${data.id}` : ""), {
            method: isEdit ? 'PUT' : 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(data)
        });

        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Error al guardar');
        
        closeModal();
        cargarRegistros(currentPage);
    } catch (err) {
        alert(err.message);
    }
});

/* === Acciones Editar/Eliminar (se mantienen firmas originales) === */
async function deleteRecord(id) {
    if (!confirm('¿Eliminar registro?')) return;
    try {
        const res = await fetch(`${API_URL}?id=${id}`, { method:'DELETE' });
        const json = await res.json();
        if (!json.success) throw new Error(json.message || 'Error al eliminar');
        cargarRegistros(currentPage);
    } catch (e) {
        alert(e.message);
    }
}
function editRecord(id){
    const r = allRecords.find(x => Number(x.id) === Number(id));
    if (r){
        openModal();
        document.getElementById('modalTitle').textContent = 'Editar Registro';
        
        // 👇 Guardamos el id en el input oculto
        document.getElementById('recordId').value = r.id;

        // Permitir fechas pasadas al editar
        const fechaInput = document.getElementById('fecha');
        fechaInput.removeAttribute('min');
        fechaInput.onkeydown = null; // permite escribir o seleccionar libremente

        // Precargar valores en el modal
        ['fecha','articulo','bolsas_del','bolsas_corte','cuello_morley','estamperia_salida','estamperia_entrada','taller']
        .forEach(k=>{
            const el=document.getElementById(k);
            if(el) el.value = r[k] ?? '';
        });
    }
}
// Cierra el modal si el usuario hace clic fuera del contenido
window.addEventListener('click', (e) => {
    const modal = document.getElementById('recordModal');
    if (e.target === modal) {
        closeModal();
    }
});
</script>
</body>
</html>