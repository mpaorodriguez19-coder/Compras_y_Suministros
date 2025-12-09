<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Orden de Compra</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
<style>
:root{
    --accent-1: #0ea5a4;
    --accent-2: #06b6d4;
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
    margin-bottom: 6px;
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

.form-group {
    margin-bottom: 6px;
}

input, select, textarea {
    font-size: 14px;
}

.no-margin { margin: 0 !important; }
.no-padding { padding: 0 !important; }

@media (max-width: 1100px){
    .right-panel { width: 100%; margin-top:12px; position: static !important; }
}
</style>
</head>
<body>
<div class="container main-card p-0">

  <!-- Barra superior -->
  <div class="header-bar">
      <h4 class="m-0">Orden de Compra</h4>
  </div>

  <!-- Formulario + Panel derecho -->
  <div class="row g-2 mb-0">
    
      <!-- Formulario -->
      <div class="col-lg-10 pe-0">
          <form action="{{ route('orden.reponer.guardar') }}" method="POST">
    @csrf
     <div class="p-2 rounded shadow-sm bg-light mb-0">


                  <div class="d-flex flex-wrap align-items-center mb-1">
                      <label for="fecha" class="form-label fw-bold me-2 mb-0" style="width: 120px;">Fecha:</label>
                      <input id="fecha" name="fecha" type="date" class="form-control form-control-sm shadow-sm" style="max-width: 200px;">
                  </div>

                  <div class="d-flex flex-wrap align-items-center mb-1">
                      <label for="proveedor" class="form-label fw-bold me-2 mb-0" style="width: 120px;">Proveedor:</label>
                      <div class="input-group input-group-sm" style="max-width: 400px;">
                          <input id="proveedor" name="proveedor" type="text" class="form-control shadow-sm" placeholder="Proveedor...">
                          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar proveedor">🔍</button>
                      </div>
                  </div>

                  <div class="d-flex flex-wrap align-items-center mb-1">
                      <label for="lugar" class="form-label fw-bold me-2 mb-0" style="width: 120px;">Lugar:</label>
                      <input id="lugar" name="lugar" type="text" class="form-control form-control-sm shadow-sm" placeholder="Sede / ubicación" style="max-width: 400px;">
                  </div>

                  <div class="d-flex flex-wrap align-items-center mb-1">
                      <label for="solicitado" class="form-label fw-bold me-2 mb-0" style="width: 120px;">Solicitado por:</label>
                      <div class="input-group input-group-sm" style="max-width: 400px;">
                          <input id="solicitado" name="solicitado" type="text" class="form-control shadow-sm" placeholder="Usuario solicitante...">
                          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar usuario">🔍</button>
                      </div>
   <!-- DESDE Y HASTA -->
                  <div style="
    display:flex;
    flex-direction:column;
    gap:6px;
    padding:10px;
    border:1px solid #d1d5db;
    border-radius:8px;
    background:#ffffff;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
    width:fit-content;

     position:absolute;
    right:400px;
    top:25%;
    transform: translateY(-50%);
">

    <div style="display:flex; align-items:center; gap:8px;">
        <label style="font-weight:bold; min-width:50px;" for="desde">Desde</label>
        <input type="date" name="desde" id="desde"
               onchange="handleInput()"
               value="{{ request('desde', Carbon\Carbon::now()->subMonth()->toDateString()) }}">
    </div>

    <div style="display:flex; align-items:center; gap:8px;">
        <label style="font-weight:bold; min-width:50px;" for="hasta">Hasta</label>
        <input type="date" name="hasta" id="hasta"
               onchange="handleInput()"
               value="{{ request('hasta', Carbon\Carbon::now()->toDateString()) }}">
    </div>

</div>
<script>
function handleInput() {
    const desde = document.getElementById('desde').value;
    const hasta = document.getElementById('hasta').value;

    if (!desde || !hasta) {
        return; // no hace nada hasta que estén las dos fechas
    }

    const url = new URL(window.location.href);
    url.searchParams.set('desde', desde);
    url.searchParams.set('hasta', hasta);

    window.location.href = url.toString();
}
</script>


                  </div>



                  <!-- ---------------- SECCION TABLA Y PANEL DERECHO ---------------- -->
                <table id="itemsTable" class="table table-bordered align-middle mb-0">
    <thead>
        <tr class="text-center">
            <th>Cant.</th>
            <th>Descripción</th>
            <th>Unidad</th>
            <th>Precio Unit.</th>
            <th>Descuento</th>
            <th>Valor L.</th>
            <th>Acción</th>
        </tr>
    </thead>
                        <tbody>

                           <!-- Columna de descripción y checkbox -->
      <script>
let index = 0;

/* AGREGAR FILA (ILIMITADAS) */
function agregarFila() {
    const tbody = document.getElementById('itemsBody');

    const tr = document.createElement('tr');
    tr.style.height = '26px';

    tr.innerHTML = `
        <td>
            <input type="number" min="0" step="1"
                   name="items[${index}][cantidad]"
                   class="form-control form-control-sm no-arrows qty"
                   style="height:22px;padding:1px 4px;font-size:12px;">
        </td>

        <td class="d-flex align-items-center">
            <input type="text"
                   name="items[${index}][descripcion]"
                   class="form-control form-control-sm desc me-1"
                   placeholder="Descripción del artículo"
                   style="height:22px;padding:1px 4px;font-size:12px;">
            <input type="checkbox"
                   class="form-check-input small-checkbox"
                   style="width:14px;height:14px;margin:0;">
        </td>

        <td>
            <input type="text"
                   name="items[${index}][unidad]"
                   class="form-control form-control-sm unidad"
                   style="height:22px;padding:1px 4px;font-size:12px;">
        </td>

        <td>
            <input type="number" step="0.01"
                   name="items[${index}][precio]"
                   class="form-control form-control-sm no-arrows price"
                   style="height:22px;padding:1px 4px;font-size:12px;">
        </td>

        <td>
            <input type="number" step="0.01"
                   name="items[${index}][descuento]"
                   class="form-control form-control-sm no-arrows discount"
                   value="0"
                   style="height:22px;padding:1px 4px;font-size:12px;">
        </td>

        <td>
            <input type="text"
                   class="valor-read"
                   readonly value="0.00"
                   style="height:22px;padding:1px 4px;font-size:12px;">
        </td>

        <td class="text-center">
            <button type="button"
                    class="btn btn-sm btn-danger py-0 px-2"
                    style="font-size:12px;"
                    onclick="eliminarFila(this)">X</button>
        </td>
    `;

    tbody.appendChild(tr);
    index++;
}

/* ELIMINAR FILA */
function eliminarFila(btn) {
    btn.closest('tr').remove();
    calcularTotales();
}

/* CALCULO AUTOMATICO*/
document.addEventListener('input', function () {
    calcularTotales();
});

function calcularTotales() {
    let subtotal = 0;
    let descuentoTotal = 0;

    document.querySelectorAll('#itemsBody tr').forEach(tr => {
        const qty = parseFloat(tr.querySelector('.qty')?.value) || 0;
        const price = parseFloat(tr.querySelector('.price')?.value) || 0;
        const discount = parseFloat(tr.querySelector('.discount')?.value) || 0;

        const totalFila = (qty * price) - discount;

        subtotal += qty * price;
        descuentoTotal += discount;

        tr.querySelector('.valor-read').value = totalFila.toFixed(2);
    });

    const impuesto = subtotal * 0.15;
    const total = subtotal - descuentoTotal + impuesto;

    document.getElementById('subTotal').innerText = subtotal.toFixed(2);
    document.getElementById('descTotal').innerText = descuentoTotal.toFixed(2);
    document.getElementById('impuesto').innerText = impuesto.toFixed(2);
    document.getElementById('total').innerText = total.toFixed(2);
}

/* AGREGAR PRIMERA FILA*/
window.onload = () => {
    agregarFila();
};
</script>

                              <div class="mt-2 text-center">
                               <button type="submit" class="btn btn-sm btn-outline-success">
    💾 Guardar
</button>
                                   <button type="button" class="btn btn-sm btn-outline-danger" onclick="salir()">Salir</button>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          </form>
      </div>
</table>
      <!-- Panel derecho -->
   <div class="col-lg-2 ps-0">
    <div class="right-panel position-sticky" style="top:0;">
        <div class="d-flex flex-column mb-2">
            <div class="mb-2">

            <input type="number" id="numeroBuscar" class="form-control shadow-sm mb-1"
                   placeholder="N°" style="border-radius:6px; height:38px; font-size:14px;"/>
            <button type="button" class="btn btn-outline-primary w-100"
                    style="height:38px; font-size:14px;">Revisar</button>
        </div>

        <a href="{{ route('orden.espera') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#f97316,#fb923c)">⏳</span>
           Rep 2
        </a>

        <a href="{{ route('orden.reponer') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#10b981,#34d399)">♻️</span>
            Reponer
        </a>

        <a href="{{ route('informe.detallado') }}" class="btn-as-panel w-100 text-center">
            <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#3b82f6)">🔗</span>
            Informe detallado
        </a>

        <a href="{{ route('compras.proveedor') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#10b981)">🏷️</span>
            Compras proveedor
        </a>

        <a href="{{ route('resumen.proveedor') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#f59e0b,#06b6d4)">📊</span>
            Resumen proveedor
        </a>

        <a href="{{ route('informe') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#6366f1,#06b6d4)">📄</span>
            Informe
        </a>

        <a href="{{ route('transparencia') }}" class="btn-as-panel">
            <span class="icon" style="background: linear-gradient(90deg,#ef4444,#06b6d4)">🔎</span>
            Transparencia
        </a>
    </div>
</div>

<script>
function agregarFila() {
    const tbody = document.querySelector('#itemsTable tbody');
    const fila = document.createElement('tr');
    fila.style.height = '26px'; // altura del tr

    fila.innerHTML = `
        <td><input type="number" min="0" step="1" class="form-control form-control-sm no-arrows qty" style="height:22px; padding:1px 4px; font-size:12px;" /></td>
        <td class="d-flex align-items-center">
            <input type="text" class="form-control form-control-sm desc me-1" placeholder="Descripción del artículo" style="height:22px; padding:1px 4px; font-size:12px;" />
            <input type="checkbox" class="form-check-input small-checkbox" title="Aplica descuento?" style="width:14px; height:14px; margin:0;" />
        </td>
        <td><input type="text" class="form-control form-control-sm unidad" style="height:22px; padding:1px 4px; font-size:12px;" /></td>
        <td><input type="number" inputmode="decimal" step="0.01" class="form-control form-control-sm no-arrows price" style="height:22px; padding:1px 4px; font-size:12px;" /></td>
        <td><input type="number" inputmode="decimal" step="0.01" class="form-control form-control-sm no-arrows discount" style="height:22px; padding:1px 4px; font-size:12px;" /></td>
        <td><input type="text" class="valor-read" readonly value="0.00" style="height:22px; padding:1px 4px; font-size:12px;" /></td>
        <td class="text-center"><button class="btn btn-sm btn-danger py-0 px-2" style="font-size:12px;" onclick="eliminarFila(this)">X</button></td>
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