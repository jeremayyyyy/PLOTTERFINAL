<?php
session_start();
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header("Location: ../principalp/login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Exportar Registros - PLOTTER</title>
<style>
    /* === REINICIO GENERAL === */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Open Sans', 'Arial', sans-serif;
    background: url('../images/background.png') no-repeat center center fixed;
    background-size: cover;
    min-height: 100vh;
    padding: 30px;
    color: #000000;
}

/* === CONTENEDOR PRINCIPAL === */
.container {
    max-width: 1250px;
    margin: 0 auto;
}

/* === ENCABEZADO / TITULO === */
.header {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    padding: 24px 28px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(29, 74, 142, 0.2);
}

/* Contenedor interno para mantener el orden horizontal */
.header-left {
    display: flex;
    align-items: center;
    gap: 20px;
}

/* Botón de volver */
.back-btn {
    background: linear-gradient(135deg, #1d4a8e, #2596be);
    border: none;
    color: #ffffff;
    border-radius: 12px;
    padding: 10px 18px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.25s ease;
    font-weight: 600;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.2);
    background: linear-gradient(135deg, #2596be, #1d4a8e);
}

/* Título principal */
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
.header button {
    background: linear-gradient(135deg, #1d4a8e, #2596be);
    border: none;
    color: #ffffff;
    border-radius: 14px;
    padding: 10px 16px;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.25s ease;
    font-weight: 600;
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
}

.header button:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 22px rgba(0, 0, 0, 0.2);
    background: linear-gradient(135deg, #2596be, #1d4a8e);
}

.header h1,
.header h2 {
    font-size: 2rem;
    font-weight: 700;
    color: #00264d;
    letter-spacing: 0.5px;
}

/* === TABLA === */
.table-container {
    margin-top: 30px;
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(12px);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(37, 150, 190, 0.2);
}

table {
    width: 100%;
    border-collapse: collapse;
    font-size: 0.95rem;
}

th, td {
    padding: 14px 12px;
    border-bottom: 1px solid rgba(0, 0, 0, 0.08);
    text-align: center;
}

th {
    background: linear-gradient(135deg, #00264d, #1d4a8e);
    color: #ffffff;
    font-weight: 700;
    letter-spacing: 0.3px;
}

tr:hover {
    background: rgba(37, 150, 190, 0.08);
    transition: 0.2s ease;
}

/* === CHECKBOX === */
input[type="checkbox"] {
    transform: scale(1.25);
    cursor: pointer;
    accent-color: #2596be;
}

/* === BOTÓN EXPORTAR === */
button.export-btn,
input[type="submit"].export-btn {
    background: linear-gradient(135deg, #2596be, #1d4a8e);
    border: none;
    color: #ffffff;
    border-radius: 14px;
    padding: 14px 26px;
    font-size: 1.1rem;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.25s ease;
    margin-top: 28px;
    display: block;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.15);
}

.export-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 26px rgba(0, 0, 0, 0.2);
    background: linear-gradient(135deg, #1d4a8e, #00264d);
}

/* === BOTÓN ALERTA / ELIMINAR === */
.btn-danger {
    background: linear-gradient(135deg, #ff3131, #c41212);
    border: none;
    color: #fff;
    border-radius: 12px;
    padding: 10px 18px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.25s ease;
}

.btn-danger:hover {
    transform: translateY(-1px);
    background: linear-gradient(135deg, #c41212, #ff3131);
    box-shadow: 0 6px 18px rgba(255, 49, 49, 0.3);
}

/* === MODAL (si existe) === */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.45);
    backdrop-filter: blur(3px);
}

.modal-content {
    background: rgba(255, 255, 255, 0.96);
    backdrop-filter: blur(12px);
    margin: 10% auto;
    padding: 28px;
    border-radius: 20px;
    width: 90%;
    max-width: 500px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
    text-align: center;
    border: 1px solid rgba(37, 150, 190, 0.25);
    color: #00264d;
}

.modal-title {
    font-size: 1.35rem;
    font-weight: 700;
    color: #00264d;
    margin-bottom: 22px;
}

.btn-close {
    background: linear-gradient(135deg, #ccc, #bbb);
    color: #000;
    border: none;
    border-radius: 10px;
    padding: 10px 18px;
    cursor: pointer;
    font-weight: 600;
    transition: 0.2s;
}

.btn-close:hover {
    background: linear-gradient(135deg, #bbb, #aaa);
    transform: translateY(-1px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.1);
}

</style>

</head>
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Open+Sans&display=swap" rel="stylesheet">
<body>

<div class="container">
    <div class="header">
        <div class="header-left">
            <button class="back-btn" onclick="window.location.href='../principalp/landing.php'">←</button>
            <div class="header-title">Exportar Registros</div>
        </div>
    </div>

    <div class="table-container">
        <table id="exportTable">
            <thead>
                <tr>
                    <th><input type="checkbox" id="selectAll" class="checkbox"></th>
                    <th>Fecha</th>
                    <th>Artículo</th>
                    <th>Bolsas Del</th>
                    <th>Bolsas Corte</th>
                    <th>Cuello-Morley</th>
                    <th>Estampería Salida</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

    <button class="export-btn" onclick="exportSelected()">Exportar datos</button>
</div>

<!-- Modal de confirmación -->
<div id="exportModal" class="modal">
    <div class="modal-content">
        <div class="modal-title">Exportación completada</div>
        <p>Se generó el archivo <b>registros_seleccionados.xls</b></p>
        <button class="btn-close" onclick="closeModal()">Cerrar</button>
    </div>
</div>

<script>
const API_URL = 'database_handler.php';
let registros = [];

document.addEventListener('DOMContentLoaded', async () => {
    await cargarRegistros();
});

async function cargarRegistros() {
    try {
        const res = await fetch(API_URL);
        const json = await res.json();
        if (!json.success) throw new Error('Error al obtener datos');
        registros = json.data || [];
        renderTabla(registros);
    } catch (e) {
        alert('No se pudieron cargar los datos.');
    }
}

function renderTabla(data) {
    const tbody = document.querySelector('#exportTable tbody');
    tbody.innerHTML = '';
    data.forEach(r => {
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td><input type="checkbox" class="checkbox" value="${r.id}"></td>
            <td>${r.fecha ?? ''}</td>
            <td>${r.articulo ?? ''}</td>
            <td>${r.bolsas_del ?? ''}</td>
            <td>${r.bolsas_corte ?? ''}</td>
            <td>${r.cuello_morley ?? ''}</td>
            <td>${r.estamperia_salida ?? ''}</td>
        `;
        tbody.appendChild(tr);
    });
}

document.getElementById('selectAll').addEventListener('change', function() {
    document.querySelectorAll('#exportTable tbody .checkbox').forEach(cb => cb.checked = this.checked);
});

async function exportSelected() {
    const selectedIds = Array.from(document.querySelectorAll('#exportTable tbody .checkbox:checked'))
        .map(cb => cb.value);

    if (!selectedIds.length) {
        alert('Selecciona al menos un registro para exportar.');
        return;
    }

    // Petición al backend exportador
    const res = await fetch('exportar_excel.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify({ ids: selectedIds })
    });

    const blob = await res.blob();
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'registros_seleccionados.xls';
    document.body.appendChild(a);
    a.click();
    a.remove();
    window.URL.revokeObjectURL(url);

    openModal();
}

function openModal() {
    document.getElementById('exportModal').style.display = 'block';
}
function closeModal() {
    document.getElementById('exportModal').style.display = 'none';
}
</script>

</body>
</html>