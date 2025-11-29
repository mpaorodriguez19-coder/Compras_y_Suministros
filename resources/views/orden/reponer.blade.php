<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
<title>Orden de Compra - Plantilla</title>
<style>
    /* Hoja tamaño carta */
    @page { size: A4 portrait; margin: 20mm; }
    body{
        font-family: "Times New Roman", Times, serif;
        background:#f0f0f0;
        display:flex;
        justify-content:center;
        padding:20px;
    }
    .hoja{
        width: 216mm;
        min-height: 279mm;
        background: white;
        padding: 18px 20px;
        box-shadow: 0 0 6px rgba(0,0,0,.25);
        box-sizing: border-box;
        color: #000;
    }

    /* ENCABEZADO */
    .encabezado{
        display:flex;
        align-items: flex-start;
        justify-content: space-between;
    }
    .logo{
        width:82px;
        height:auto;
    }
    .centro{
        text-align:center;
        line-height: 1;
        flex:1;
        margin:0 8px;
    }
    .centro .titulo1{
        font-size:20px;
        font-weight:bold;
        letter-spacing:1px;
    }
    .centro .sub{
        font-size:13px;
    }
    .centro .tel{
        font-size:12px;
        margin-top:4px;
    }

    /* orden numero */
    .ordenwrap{
        display:flex;
        align-items:center;
        justify-content:center;
        margin-top:6px;
        gap:8px;
    }
    .ordenwrap b{ font-size:14px; }
    .numbox{
        border:2px solid #c2c2c2;
        padding:4px 10px;
        border-radius:8px;
        min-width:120px;
        text-align:center;
        position:relative;
        font-size:13px;
    }
    .num-red{
        display:inline-block;
        border:2px solid #c23b3b;
        color:#c23b3b;
        padding:2px 8px;
        border-radius:6px;
        font-weight:bold;
        font-size:14px;
        margin-left:8px;
    }

    /* linea doble */
    .linea-doble{
        border-top:3px double #000;
        margin:10px 0 12px 0;
    }

    /* datos generales */
    .datos{
        font-size:13px;
        margin-bottom:8px;
    }
    .datos .fila{
        margin-bottom:6px;
    }
    .datos b{ display:inline-block; width:80px; }

    /* texto intro */
    .intro{
        margin:8px 0 6px 0;
        font-size:13px;
    }

    /* tabla principal */
    table.oc{
        width:100%;
        border-collapse:collapse;
        font-size:12.5px;
    }
    table.oc thead th{
        border:1px solid #000;
        padding:6px;
        background:#efefef;
        font-weight:bold;
        text-align:center;
        letter-spacing:1px;
        font-size:12px;
    }
    table.oc tbody td{
        border:1px solid #000;
        padding:6px;
        vertical-align:middle;
        font-size:12px;
    }
    .td-desc { text-align:left; padding-left:8px; }
    .col-no { width:40px; }
    .col-desc { width:46%; }
    .col-unid { width:80px; }
    .col-cant { width:80px; }
    .col-pre { width:90px; }
    .col-val { width:110px; }

    /* totales cuadro */
    .totales {
        width: 260px;
        float: right;
        margin-top:8px;
        border:1px solid #000;
        padding:6px;
        box-sizing:border-box;
        font-size:13px;
    }
    .totales .row {
        display:flex;
        justify-content:space-between;
        padding:4px 0;
    }
    .totales .label { text-align:left; }
    .totales .value { text-align:right; min-width:80px; }

    /* pie grande con texto e instrucciones */
    .pie-text {
        margin-top:18px;
        border:1px solid #000;
        padding:10px;
        font-size:12px;
        line-height:1.15;
    }

    /* firma */
    .firmas {
        margin-top:26px;
        display:flex;
        justify-content:space-between;
    }
    .firma-line {
        width:32%;
        text-align:center;
        border-top:1px solid #000;
        padding-top:6px;
        font-size:13px;
    }

    /* copia y texto inferior */
    .copia {
        margin-top:18px;
        font-size:12px;
    }

    /* boton imprimir (no se muestra en impresión) */
    .btn-print{
        position:fixed;
        right:18px;
        top:18px;
        z-index:999;
        background:#007bff;
        color:white;
        border:none;
        padding:8px 12px;
        border-radius:6px;
        cursor:pointer;
    }
    @media print{
        .btn-print { display:none; }
        body { background:white; }
        .hoja { box-shadow:none; margin:0; }
    }
</style>
</head>
<body>

<button class="btn-print" onclick="window.print()">🖨 Imprimir</button>

<div class="hoja">

    <!-- encabezado -->
    <div class="encabezado">
        <!-- logo izquierdo: ajusta ruta -->
        <img src="public/logo_izq.png" alt="logo izq" class="logo">

        <div class="centro">
            <div class="titulo1">MUNICIPALIDAD DE DANLÍ, EL</div>
            <div class="sub">Departamento de El Paraíso, Honduras, C.A.</div>
            <div class="tel">Teléfono: &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Fax:</div>
        </div>

        <!-- logo derecho: ajusta ruta -->
        <img src="public/logo_der.png" alt="logo der" class="logo">
    </div>

    <!-- orden -->
    <div class="ordenwrap">
        <div><b>ORDEN DE COMPRA No.</b></div>
        <div class="numbox" aria-hidden="true"></div>
        <div class="num-red" aria-hidden="true"></div>
    </div>

    <div class="linea-doble"></div>

    <!-- datos (vacíos) -->
    <div class="datos">
        <div class="fila"><b>LUGAR:</b> <span></span></div>
        <div class="fila"><b>FECHA:</b> <span></span></div>
        <div class="fila"><b>A:</b> <span></span></div>
    </div>

    <div class="intro">Estimados señores:</div>
    <div style="font-size:13px; margin-bottom:8px;">
        Agradecemos entregar los materiales o prestar los servicios indicados en el siguiente cuadro:
    </div>

    <!-- tabla items (vacías) -->
    <table class="oc">
        <thead>
            <tr>
                <th class="col-no">No.</th>
                <th class="col-desc">DESCRIPCIÓN</th>
                <th class="col-unid">UNIDAD</th>
                <th class="col-cant">CANTIDAD</th>
                <th class="col-pre">PRECIO U.</th>
                <th class="col-val">VALOR L.</th>
            </tr>
        </thead>
        <tbody>
            <!-- 12 filas en blanco (puedes agregar/quitar) -->
            <tr>
                <td class="col-no"></td>
                <td class="td-desc"></td>
                <td class="col-unid"></td>
                <td class="col-cant"></td>
                <td class="col-pre"></td>
                <td class="col-val"></td>
            </tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
            <tr><td></td><td class="td-desc"></td><td></td><td></td><td></td><td></td></tr>
        </tbody>
    </table>

    <!-- cuadro totales (vacío) -->
    <div class="totales" aria-hidden="true">
        <div class="row"><div class="label">Sub - Total L.</div><div class="value"></div></div>
        <div class="row"><div class="label">Descuento:</div><div class="value"></div></div>
        <div class="row"><div class="label">Impuesto:</div><div class="value"></div></div>
        <div style="border-top:1px solid #000; margin-top:6px; padding-top:6px;" class="row">
            <div class="label"><b>Total Pago:</b></div><div class="value"><b></b></div>
        </div>
    </div>

    <div style="clear:both"></div>

    <!-- bloque informativo como en foto -->
    <div class="pie-text">
        UTILIZADOS POR EMPLEADOS DEL PLANTEL EN RECOLECCIÓN DE DESECHOS SÓLIDOS EN TODA LA CIUDAD... <br>
        <br>
        Solicitado por: <span style="font-weight:bold;"></span>
    </div>

    <!-- firmas -->
    <div class="firmas">
        <div class="firma-line">SUMINISTRANTE:</div>
        <div class="firma-line">Jefe de Compras</div>
        <div class="firma-line">Gerente Administrativo</div>
    </div>

    <div class="copia">
        Copia &nbsp;&nbsp;&nbsp;&nbsp; Hecho Por: <span></span>
    </div>

</div>

</body>
</html>
