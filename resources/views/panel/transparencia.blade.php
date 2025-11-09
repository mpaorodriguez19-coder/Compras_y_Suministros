<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8" />
<title>Orden de Compra - Plantilla</title>
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<style>
:root{
    --accent-1: #0ea5a4;
    --accent-2: #06b6d4;
    --accent-3: #0f766e;
    --panel-bg: linear-gradient(135deg,#e6fffa 0%, #ecfeff 100%);
    --card-bg: linear-gradient(180deg,#ffffff 0%, #f6fffd 100%);
    --right-panel: linear-gradient(180deg,#eefaf6 0%, #ddf6f4 100%);
}

body{
    background: linear-gradient(180deg,#e8faf8 0%, #dff7f6 100%);
    font-family: "Helvetica Neue", Arial, sans-serif;
    padding: 18px;
}

.main-card {
    background: var(--card-bg);
    border-radius: 14px;
    box-shadow: 0 8px 28px rgba(6,22,22,0.08);
    padding: 18px;
    position: relative;
    overflow: hidden;
}

.header-bar{
    background: linear-gradient(90deg,var(--accent-2),var(--accent-1));
    color: white;
    padding: 10px 14px;
    border-radius: 10px;
    margin-bottom: 12px;
    display:flex;
    justify-content:center;
    align-items:center;
}

.right-panel {
    background: var(--right-panel);
    padding: 10px;
    border-radius: 10px;
    width: 100%;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.7);
}

.btn-as-panel {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    font-weight: 500;
    border-radius: 8px;
    text-decoration: none;
    color: #000;
    background: #fff;
    box-shadow: 0 3px 8px rgba(11,22,22,0.05);
    margin-bottom: 8px;
    transition: transform 0.1s, box-shadow 0.2s;
}
.btn-as-panel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(11,22,22,0.1);
}
.btn-as-panel .icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border-radius: 6px;
    color: white;
    font-size: 16px;
}

.table-responsive {
    max-height: 1000px;
    overflow-y: auto;
}
.table thead th { 
    background: rgba(255,255,255,0.5);
    border-top: none;
    border-bottom: 3px solid rgba(6,22,22,0.05);
}

td .form-control, th .form-control { 
    height: 36px; 
    padding: .4rem .6rem; 
}

input[type=number]::-webkit-outer-spin-button,
input[type=number]::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
input[type=number] { -moz-appearance: textfield; }
.no-arrows { appearance: none; -webkit-appearance:none; -moz-appearance:textfield; }

.small-checkbox { width: 16px; height: 16px; margin-right: 6px; }

.valor-read {
    text-align: right;
    font-weight: 600;
    border: none;
    background: transparent;
    color: #0f766e;
    width:100%;
}

.totals-panel {
    background: rgba(255,255,255,0.7);
    padding: 10px;
    border-radius:8px;
    box-shadow: 0 6px 12px rgba(6,22,22,0.04);
}

@media (max-width: 1100px){
    .right-panel { width: 100%; margin-top:12px; position: static !important; }
}
</style>
</head>
<body>

<div class="container main-card">

  <!-- Barra superior -->
  <div class="header-bar">
      <h4 class="m-0">Orden de Compra</h4>
  </div>

  <!-- Formulario + Panel derecho en la misma fila -->
  <div class="row">
      <!-- Formulario encabezado -->
      <div class="col-lg-10">
          <form id="ordenForm" onsubmit="guardar(event)">
              <div class="p-2 rounded shadow-sm bg-light flex-grow-1">
                  <div class="d-flex align-items-center mb-1">
                      <label for="fecha" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Fecha:</label>
                      <input id="fecha" type="date" class="form-control form-control-sm shadow-sm" style="max-width: 200px;">
                  </div>

                  <div class="d-flex align-items-center mb-1">
                      <label for="proveedor" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Proveedor:</label>
                      <div class="input-group input-group-sm" style="max-width: 400px;">
                          <input id="proveedor" type="text" class="form-control shadow-sm" placeholder="Proveedor...">
                          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar proveedor" onclick="abrirBusqueda('proveedor')">🔍</button>
                      </div>
                  </div>

                  <div class="d-flex align-items-center mb-1">
                      <label for="lugar" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Lugar:</label>
                      <input id="lugar" type="text" class="form-control form-control-sm shadow-sm" placeholder="Sede / ubicación" style="max-width: 400px;">
                  </div>

                  <div class="d-flex align-items-center mb-1">
                      <label for="solicitado" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Solicitado por:</label>
                      <div class="input-group input-group-sm" style="max-width: 400px;">
                          <input id="solicitado" type="text" class="form-control shadow-sm" placeholder="Usuario solicitante...">
                          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar usuario" onclick="abrirBusqueda('solicitado')">🔍</button>
                      </div>
                  </div>
              </div>
          </form>
      </div>

      <!-- Panel derecho -->
      <div class="col-lg-2">
          <div class="right-panel" style="position: sticky; top: 18px;">
              <a href="{{ route('orden.espera') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#f97316,#fb923c)">⏳</span>
                  Orden en espera
              </a>
              <a href="{{ route('orden.reponer') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#10b981,#34d399)">♻️</span>
                  Reponer
              </a>
              <a href="#" class="btn-as-panel w-100 mb-2 text-center">
                  <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#3b82f6)">🔗</span>
                  <div>Link</div>
              </a>
              <div class="btn-as-panel p-2 text-start mb-2">
     <input type="number" 
       id="numeroBuscar" 
       class="form-control shadow-sm mb-2" 
       placeholder="N°" 
       style="border-radius:6px; height:45px; font-size:16px; padding:0.5rem; width:100%;">

                  <button type="button" class="btn btn-outline-primary btn-sm w-100">Revisar</button>
              </div>
              <a href="{{ route('informe.detallado') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#3b82f6,#06b6d4)">📝</span>
                  Informe detallado
              </a>
              <a href="{{ route('compras.proveedor') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#10b981)">🏷️</span>
                  Compras proveedor
              </a>
              <a href="{{ route('resumen.proveedor') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#f59e0b,#06b6d4)">📊</span>
                  Resumen proveedor
              </a>
              <a href="{{ route('informe') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#6366f1,#06b6d4)">📄</span>
                  Informe
              </a>
              <a href="{{ route('transparencia') }}" class="btn-as-panel mb-2">
                  <span class="icon" style="background: linear-gradient(90deg,#ef4444,#06b6d4)">🔎</span>
                  Transparencia
              </a>
          </div>
      </div>
  </div>

   <!-- ---------------- SECCION TABLA Y PANEL DERECHO ---------------- -->

  <div class="table-responsive mt-3">
        <div class="table-responsive" style="max-width: 940px; width: 100%;">
      <table id="itemsTable" class="table table-bordered align-middle">
       
          <thead>
              <tr class="text-center">
                  <th style="width:50px">Cant.</th>
                  <th>Descripción</th>
                  <th style="width:50px">Unidad</th>
                  <th style="width:50px">Precio Unitario</th>
                  <th style="width:50px">Descuento</th>
                  <th style="width:50px">Valor L.</th>
                  <th style="width:50px">Acción</th>
              </tr>
          </thead>
          <tbody>
              <tr>
                  <td><input type="number" min="0" step="1" class="form-control no-arrows qty" /></td>


                  <td class="d-flex align-items-center">
                      <input type="text" class="form-control desc me-3" placeholder="Descripción del artículo" />
                      <input type="checkbox" class="form-check-input small-checkbox" title="Aplica descuento?" />
                  </td>
                  <td><input type="text" class="form-control unidad" /></td>
                  <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows price" /></td>
                  <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows discount" /></td>
                  <td><input type="text" class="valor-read" readonly value="0.00" /></td>
                  <td class="text-center"><button class="btn btn-sm btn-danger" onclick="eliminarFila(this)">X</button></td>
              </tr>

                <tr>
    <td><input type="number" min="0" step="1" class="form-control no-arrows qty" /></td>
    
    <!-- Columna de descripción y checkbox -->
    <td class="d-flex align-items-center">
        <input type="text" class="form-control desc me-3" placeholder="Descripción del artículo" />
        <input type="checkbox" class="form-check-input small-checkbox" title="Aplica descuento?" />
    </td>

    <td><input type="text" class="form-control unidad" /></td>
    <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows price" /></td>
    <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows discount" /></td>
    <td><input type="text" class="valor-read" readonly value="0.00" /></td>
    <td class="text-center"><button class="btn btn-sm btn-danger" onclick="eliminarFila(this)">X</button></td>
</tr>

  <tr>
    <td><input type="number" min="0" step="1" class="form-control no-arrows qty" /></td>

    
    <!-- Columna de descripción y checkbox -->
    <td class="d-flex align-items-center">
        <input type="text" class="form-control desc me-3" placeholder="Descripción del artículo" />
        <input type="checkbox" class="form-check-input small-checkbox" title="Aplica descuento?" />
    </td>

    <td><input type="text" class="form-control unidad" /></td>
    <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows price" /></td>
    <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows discount" /></td>
    <td><input type="text" class="valor-read" readonly value="0.00" /></td>
    <td class="text-center"><button class="btn btn-sm btn-danger" onclick="eliminarFila(this)">X</button></td>
</tr>

          </tbody>
      </table>
  </div>

  <div class="d-flex justify-content-between align-items-start gap-3 mt-2">
      <div class="flex-grow-1">
          <label class="form-label">Concepto</label>
          <textarea id="concepto" rows="3" class="form-control"></textarea>
          <div class="mt-2">
              <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarFila()">+ Agregar fila</button>
          </div>
      </div>

      <div style="width:260px;">
          <div class="totals-panel">
              <div class="d-flex justify-content-between"><div>Sub-Total</div><div><strong id="subTotal">0.00</strong></div></div>
              <div class="d-flex justify-content-between mt-1"><div>Descuento Total</div><div id="descTotal">0.00</div></div>
              <div class="d-flex justify-content-between mt-1"><div>Impuesto</div><div id="impuesto">0.00</div></div>
              <hr/>
              <div class="d-flex justify-content-between"><div class="fw-bold">Total</div><div class="fw-bold" id="total">0.00</div></div>
              <div class="mt-2 text-center">
                  <button type="button" class="btn btn-sm btn-outline-success" onclick="generarPDF()">Generar PDF</button>
              </div>
          </div>
      </div>
  </div>

  <!-- Botones Guardar / Cancelar -->
  <div class="d-flex justify-content-center gap-2 mt-3">
      <button type="submit" class="btn btn-success btn-sm" style="border-radius:6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0.35rem 0.75rem;">Guardar</button>
      <button type="button" class="btn btn-secondary btn-sm" onclick="resetForm()" style="border-radius:6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0.35rem 0.75rem;">Cancelar</button>
  </div>

</div>

<script>
function agregarFila() {
    const tbody = document.querySelector('#itemsTable tbody');
    const fila = document.createElement('tr');
    fila.innerHTML = `
        <td><input type="number" min="0" step="1" class="form-control no-arrows qty" /></td>
        <td class="d-flex align-items-center">
            <input type="text" class="form-control desc me-3" placeholder="Descripción del artículo" />
            <input type="checkbox" class="form-check-input small-checkbox" title="Aplica descuento?" />
        </td>
        <td><input type="text" class="form-control unidad" /></td>
        <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows price" /></td>
        <td><input type="number" inputmode="decimal" step="0.01" class="form-control no-arrows discount" /></td>
        <td><input type="text" class="valor-read" readonly value="0.00" /></td>
        <td class="text-center"><button class="btn btn-sm btn-danger" onclick="eliminarFila(this)">X</button></td>
    `;
    tbody.appendChild(fila);
}

function eliminarFila(boton) {
    const fila = boton.closest('tr');
    fila.remove();
}
</script>

</body>
</html>
