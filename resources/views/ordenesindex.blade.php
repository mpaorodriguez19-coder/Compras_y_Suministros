<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8" /> <!-- Codificación de caracteres -->
    <title>Orden de Compra - Plantilla</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" /> <!-- Responsive -->
    
    <!-- Bootstrap: Framework CSS para estilos rápidos y responsivos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>

    <!-- Estilos personalizados -->
    <style>
        /* ---------------- VARIABLES GLOBALES ---------------- */
        :root{
            --accent-1: #0ea5a4; /* color principal teal */
            --accent-2: #06b6d4; /* color secundario cyan */
            --accent-3: #0f766e; /* color teal más oscuro */
            --panel-bg: linear-gradient(135deg,#e6fffa 0%, #ecfeff 100%); /* fondo gradiente panel */
            --card-bg: linear-gradient(180deg,#ffffff 0%, #f6fffd 100%); /* fondo de tarjeta */
            --right-panel: linear-gradient(180deg,#eefaf6 0%, #ddf6f4 100%); /* fondo panel derecho */
        }

        /* ---------------- ESTILO GENERAL DEL BODY ---------------- */
        body{
            background: linear-gradient(180deg,#e8faf8 0%, #dff7f6 100%);  /* fondo general de la página */
            font-family: "Helvetica Neue", Arial, sans-serif; /* fuente principal */
            padding: 18px; /* espacio interno */
        }

        /* ---------------- TARJETA PRINCIPAL ---------------- */
        .main-card {
            background: var(--card-bg); /* fondo de la tarjeta */
            border-radius: 14px; /* bordes redondeados */
            box-shadow: 0 8px 28px rgba(6,22,22,0.08); /* sombra suave */
            padding: 18px;
            position: relative;
            overflow: hidden; /* evita que elementos sobresalgan */
        }

        /* ---------------- BARRA DE ENCABEZADO ---------------- */
        .header-bar{
            background: linear-gradient(90deg,var(--accent-2),var(--accent-1)); /* degradado horizontal */
            color: white;
            padding: 10px 14px;
            border-radius: 10px;
            margin-bottom: 12px;
            display:flex; /* para alinear elementos dentro */
            justify-content:space-between; /* espacio entre elementos */
            align-items:center; /* centrado vertical */
        }

        /* ---------------- PANEL DERECHO ---------------- */
        .right-panel {
            background: var(--right-panel);
            padding: 10px;
            border-radius: 10px;
            width: 175px; /* ancho fijo */
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.7); /* efecto de relieve interno */
        }

        /* Botones del panel derecho */
      .btn-as-panel {
    display: flex;           /* Icono y texto en línea */
    align-items: center;     /* Centrado vertical */
    gap: 10px;               /* Espacio entre icono y texto */
    padding: 8px 12px;       /* Espacio interno */
    font-weight: 500;
    border-radius: 8px;      /* Bordes redondeados */
    text-decoration: none;   /* Quitar subrayado */
    color: #000;             /* Color del texto */
    background: #fff;        /* Fondo base (opcional) */
    box-shadow: 0 3px 8px rgba(11,22,22,0.05);
    margin-bottom: 8px;      /* Separación entre botones */
    transition: transform 0.1s, box-shadow 0.2s;
}
/* Hover efecto */
.btn-as-panel:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 12px rgba(11,22,22,0.1);
}

/* Iconos dentro de los botones */
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
        /* ---------------- TABLA Y ENTRADAS ---------------- */
        .table-responsive {
            max-height: 1000px; /* altura máxima para scroll */
            overflow-y: auto;  /* scroll vertical si hay muchas filas */
        }

        .table thead th { 
            background: rgba(255,255,255,0.5); /* fondo cabecera tabla */
            border-top: none;
            border-bottom: 3px solid rgba(6,22,22,0.05); /* línea inferior */
        }

        td .form-control, th .form-control { 
            height: 36px; 
            padding: .4rem .6rem; 
        }

        /* Quitar flechas en inputs tipo number */
        input[type=number]::-webkit-outer-spin-button,
        input[type=number]::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        input[type=number] {
            -moz-appearance: textfield;
        }
        .no-arrows { appearance: none; -webkit-appearance:none; -moz-appearance:textfield; }

        /* Checkboxes pequeños */
        .small-checkbox {
            width: 16px;
            height: 16px;
            margin-right: 6px;
        }

        /* Campos solo lectura para mostrar valor */
        .valor-read {
            text-align: right;
            font-weight: 600;
            border: none;
            background: transparent;
            color: #0f766e;
            width:100%;
        }

        /* Panel de totales */
        .totals-panel {
            background: rgba(255,255,255,0.7);
            padding: 10px;
            border-radius:8px;
            box-shadow: 0 6px 12px rgba(6,22,22,0.04);
        }

        /* Botones de guardar / reset */
        .btn-save {
            background: linear-gradient(90deg,#06b6d4,#0ea5a4);
            color:white;
            border:none;
            font-weight:600;
            border-radius:8px;
            padding:10px 18px;
        }

        .btn-reset {
            border-radius:8px;
            padding:10px 18px;
        }

        .form-top-row .input-group .btn {
            border-radius: 0 8px 8px 0;
        }

        /* Media queries para pantallas pequeñas */
        @media (max-width: 1100px){
            .right-panel { width: 100%; margin-top:12px; }
        }
    </style>
</head>
<body>

<!-- ---------------- CONTENEDOR PRINCIPAL ---------------- -->
<div class="container main-card">

    <!-- Barra superior con título -->
    <div class="header-bar">
        <div>
            <h4 class="m-0">Orden de Compra</h4>
        </div>
    </div>
   

<!-- ---------------- FORMULARIO DE ENCABEZADO ---------------- -->
<form id="ordenForm" onsubmit="guardar(event)">
  <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

    <!-- FORMULARIO IZQUIERDA -->
    <div class="p-2 rounded shadow-sm bg-light flex-grow-1" style="max-width: 600px;">
      <!-- Fecha -->
      <div class="d-flex align-items-center mb-1">
        <label for="fecha" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Fecha:</label>
        <input id="fecha" type="date" class="form-control form-control-sm shadow-sm" style="max-width: 200px;">
      </div>

      <!-- Proveedor -->
      <div class="d-flex align-items-center mb-1">
        <label for="proveedor" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Proveedor:</label>
        <div class="input-group input-group-sm" style="max-width: 400px;">
          <input id="proveedor" type="text" class="form-control shadow-sm" placeholder="Proveedor...">
          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar proveedor" onclick="abrirBusqueda('proveedor')">🔍</button>
        </div>
      </div>

      <!-- Lugar -->
      <div class="d-flex align-items-center mb-1">
        <label for="lugar" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Lugar:</label>
        <input id="lugar" type="text" class="form-control form-control-sm shadow-sm" placeholder="Sede / ubicación" style="max-width: 400px;">
      </div>

      <!-- Solicitado por -->
      <div class="d-flex align-items-center mb-1">
        <label for="solicitado" class="form-label fw-bold me-2 mb-0 text-end" style="width: 120px; font-size: 14px;">Solicitado por:</label>
        <div class="input-group input-group-sm" style="max-width: 400px;">
          <input id="solicitado" type="text" class="form-control shadow-sm" placeholder="Usuario solicitante...">
          <button type="button" class="btn btn-outline-primary btn-sm" title="Buscar usuario" onclick="abrirBusqueda('solicitado')">🔍</button>
        </div>
      </div>
    </div>


      <!-- Fila con Orden en Espera y Reponer -->
      <div class="d-flex justify-content-between gap-2 mb-2">
        <!-- ORDEN EN ESPERA -->
        <a href="{{ route('orden.espera') }}" class="btn-as-panel flex-fill text-center">
          <span class="icon" style="background: linear-gradient(90deg,#f97316,#fb923c)">⏳</span>
          <div>Orden en espera</div>
        </a>

        <!-- REPONER -->
        <a href="{{ route('orden.reponer') }}" class="btn-as-panel flex-fill text-center">
          <span class="icon" style="background: linear-gradient(90deg,#10b981,#34d399)">♻️</span>
          <div>Reponer</div>
        </a>
      </div>
      


  </div>
</form>

    <!-- ---------------- SECCION TABLA Y PANEL DERECHO ---------------- -->
    <div class="row">
        <!-- Tabla principal -->
        <div class="col-lg-10">
            <div class="table-responsive mb-2">
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
                      
                    
                    <!-- FILAS INICIALES DE EJEMPLO -->
                      <tr>
  
    
    <!-- Columna de descripción y checkbox -->
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




                        <!-- Se repite 2 veces más para completar 3 filas iniciales -->
                    </tbody>
                </table>
            </div>

            <!-- Concepto y panel de totales -->
            <div class="d-flex justify-content-between align-items-start gap-3">
                <div class="flex-grow-1">
                    <label class="form-label">Concepto</label>
                    <textarea id="concepto" rows="3" class="form-control"></textarea>
                    <div class="mt-2">
                        <button type="button" class="btn btn-outline-primary btn-sm" onclick="agregarFila()">+ Agregar fila</button>
             
                    </div>
                </div>

            <script>
function agregarFila() {
    // Seleccionamos el tbody de la tabla
    const tbody = document.querySelector('#itemsTable tbody');

    // Creamos una nueva fila
    const fila = document.createElement('tr');

    // Contenido de la fila (igual que tus filas iniciales)
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

    // Añadimos la fila al tbody
    tbody.appendChild(fila);
}

// Función para eliminar fila
function eliminarFila(boton) {
    const fila = boton.closest('tr');
    fila.remove();
}
</script>

                <!-- Totales -->
                <div style="width:260px;">
                    <div class="totals-panel">
                        <div class="d-flex justify-content-between">
                            <div>Sub-Total</div><div><strong id="subTotal">0.00</strong></div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div>Descuento Total</div><div id="descTotal">0.00</div>
                        </div>
                        <div class="d-flex justify-content-between mt-1">
                            <div>Impuesto</div><div id="impuesto">0.00</div>
                        </div>
                        <hr/>
                        <div class="d-flex justify-content-between">
                            <div class="fw-bold">Total</div><div class="fw-bold" id="total">0.00</div>
                        </div>
                        <div class="mt-2 text-center">
                            <button type="button" class="btn btn-sm btn-outline-success" onclick="generarPDF()">Generar PDF</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <!-- Panel derecho con botones de acciones -->
<div class="col-lg-1">
    <div class="right-panel">
        <div class="mb-1">
  <!-- LINK (debajo) -->
      <a href="#" class="btn-as-panel w-100 mb-2 text-center">
        <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#3b82f6)">🔗</span>
        <div>Link</div>
      </a>

<!-- Revisar -->
<div class="btn-as-panel p-2 text-start">
    <input type="number" id="numeroBuscar" class="form-control form-control-sm shadow-sm mb-2" placeholder="N°" style="border-radius:6px;">
    <button type="button" class="btn btn-outline-primary btn-sm w-100">Revisar</button>
</div>


            <!-- INFORME DETALLADO -->
            <a href="{{ route('informe.detallado') }}" class="btn-as-panel">
                <span class="icon" style="background: linear-gradient(90deg,#3b82f6,#06b6d4)">📝</span>
                Informe detallado
            </a>

            <!-- COMPRAS A UN PROVEEDOR -->
            <a href="{{ route('compras.proveedor') }}" class="btn-as-panel">
                <span class="icon" style="background: linear-gradient(90deg,#06b6d4,#10b981)">🏷️</span>
                Compras a un proveedor
            </a>

            <!-- RESUMEN POR PROVEEDOR -->
            <a href="{{ route('resumen.proveedor') }}" class="btn-as-panel">
                <span class="icon" style="background: linear-gradient(90deg,#f59e0b,#06b6d4)">📊</span>
                Resumen por proveedor
            </a>

            <!-- INFORME -->
            <a href="{{ route('informe') }}" class="btn-as-panel">
                <span class="icon" style="background: linear-gradient(90deg,#6366f1,#06b6d4)">📄</span>
                Informe
            </a>

            <!-- TRANSPARENCIA -->
            <a href="{{ route('transparencia') }}" class="btn-as-panel">
                <span class="icon" style="background: linear-gradient(90deg,#ef4444,#06b6d4)">🔎</span>
                Transparencia
            </a>

        </div>
    </div>
</div>
<!-- Botones Guardar / Cancelar centrados con estilo moderno -->
<div class="d-flex justify-content-center gap-2 mt-2">
    <button type="submit" class="btn btn-success btn-sm" 
            style="border-radius:6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0.35rem 0.75rem;">
        Guardar
    </button>
    <button type="button" class="btn btn-secondary btn-sm" onclick="resetForm()" 
            style="border-radius:6px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); padding: 0.35rem 0.75rem;">
        Cancelar
    </button>
</div>

        </div>       
    </div>
</form>
</div>

