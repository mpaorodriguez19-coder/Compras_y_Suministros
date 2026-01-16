<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Orden de Compra</title>

<style>
    body{
        font-family: Arial, Helvetica, sans-serif;
        background:#f0f0f0;
        display:flex;
        justify-content:center;
        padding:20px;
    }

    .hoja{
        width:216mm;
        min-height:279mm;
        background:white;
        padding:20px 30px;
        box-shadow:0 0 10px rgba(0,0,0,.3);
        box-sizing:border-box;
        font-size:13px;
    }

    /* ================= ENCABEZADO ================= */
    .encabezado{
        display:flex;
        align-items:center;
        justify-content:space-between;
    }

    .logo{
        width:80px;
    }

    .centro{
        text-align:center;
        flex:1;
        font-size:14px;
    }

    .centro h2,
    .centro h3{
        margin:2px 0;
        font-weight:bold;
    }

    .centro small{
        font-size:12px;
    }

    .orden-num{
        text-align:right;
        font-size:13px;
        font-weight:bold;
    }

    .orden-num span{
        border:1px solid black;
        padding:3px 10px;
        margin-left:5px;
    }

    hr{
        border:1px solid black;
        margin:10px 0;
    }

    /* ================= DATOS ================= */
    .datos{
        width:100%;
        margin-top:10px;
    }

    .fila{
        display:flex;
        margin-bottom:5px;
    }

    .fila div{
        flex:1;
    }

    .etiqueta{
        font-weight:bold;
    }

    /* ================= TABLA ================= */
    table{
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
    }

    th, td{
        border:1px solid black;
        padding:6px;
        font-size:12px;
    }

    th{
        background:#eaeaea;
        text-align:center;
    }

    td{
        text-align:center;
    }

    .desc{
        text-align:left;
    }

    /* ================= TOTALES ================= */
    .totales{
        width:100%;
        margin-top:10px;
        display:flex;
        justify-content:flex-end;
    }

    .totales table{
        width:40%;
    }

    /* ================= FIRMAS ================= */
    .firmas{
        margin-top:40px;
        display:flex;
        justify-content:space-between;
        text-align:center;
    }

    .firma{
        width:40%;
    }

    .linea-firma{
        border-top:1px solid black;
        margin-top:40px;
    }

    /* ================= IMPRIMIR ================= */
    .btn-imprimir{
        position:fixed;
        top:20px;
        right:20px;
        padding:8px 16px;
        background:#007bff;
        color:white;
        border:none;
        border-radius:4px;
        cursor:pointer;
    }

    @media print{
        .btn-imprimir{display:none;}
        body{background:white;}
        .hoja{box-shadow:none;}
    }
</style>
</head>

<body>

<button class="btn-imprimir" onclick="window.print()">🖨 Imprimir</button>

<div class="hoja">

    <!-- ENCABEZADO -->
    <div class="encabezado">

     <!-- LOGO IZQUIERDO -->
            <div>
                <img src="imagenes/logo_izq.png" class="logo">
            </div>
    
        <div class="centro">
            <h2>MUNICIPALIDAD DE DANLÍ, EL PARAÍSO</h2>
            <small>Departamento de El Paraíso, Honduras C.A.</small><br>
            <small>Tel: 2763-2080 / 2763-2405</small>
            <h3>ORDEN DE COMPRA</h3>   <div class="orden-num">
            ORDEN No.
            <span></span>
        </div>
        </div>
 
       
          <div>
                <img src="imagenes/logo_der.png" class="logo">
            </div>
    </div>

    <hr>

    <!-- DATOS -->
    <div class="datos">
        <div class="fila">
            <div><span class="etiqueta">Lugar:</span> Danlí, El Paraíso</div>
            <div><span class="etiqueta">Fecha:</span> </div>
        </div>

        <div class="fila">
            <div><span class="etiqueta">A:</span> </div>
            <div><span class="etiqueta">RTN:</span> </div>
        </div>
    </div>

    <p style="margin-top:10px;">
        Estimados señores:<br>
        Agradecemos entregar los materiales o prestar los servicios indicados
        en el siguiente cuadro:
    </p>

    <!-- TABLA -->
    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Descripción</th>
                <th>Unidad</th>
                <th>Cantidad</th>
                <th>Precio L.</th>
                <th>Valor L.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td class="desc"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </tbody>
    </table>

    <!-- TOTALES -->
    <div class="totales">
        <table>
            <tr>
                <th></th>
                <td></td>
            </tr>
        </table>
    </div>

    <!-- FIRMAS -->
    <div class="firmas">
        <div class="firma">
            <div class="linea-firma"></div>
            Elaborado por
        </div>

        <div class="firma">
            <div class="linea-firma"></div>
            Autorizado
        </div>
    </div>

</div>

</body>
</html>
