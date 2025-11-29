<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Informe de Órdenes de Compra</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background: white;
        }

        .encabezado {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 5px;
        }

        .logo {
            width: 90px;
        }

        .centro {
            text-align: center;
            flex-grow: 1;
        }

        .centro h1, .centro h2 {
            margin: 3px;
        }

        .info-der {
            text-align: right;
            font-size: 12px;
        }

        .periodo {
            text-align: center;
            font-weight: bold;
            margin-top: 8px;
            margin-bottom: 6px;
            font-size: 14px;
        }

        .linea {
            border-bottom: 2px solid black;
            margin-bottom: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        th, td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
            font-size: 13px;
        }

        th {
            background-color: #eaeaea;
        }
    </style>
</head>
<body>

    <!-- ================= ENCABEZADO ================= -->
    <div class="encabezado">

        <!-- LOGO IZQUIERDO -->
        <div>
            <img src="imagenes/logo_izq.png" class="logo">
        </div>

        <!-- CENTRO -->
        <div class="centro">
            <h1>MUNICIPALIDAD DE DANLÍ, EL PARAÍSO</h1>
            <h2>INFORME DETALLADO DE ÓRDENES DE COMPRA</h2>
        </div>

        <!-- DERECHA: FECHA Y PAGINA -->
        <div class="info-der">
            <img src="imagenes/logo_der.jpeg" class="logo"><br>
            Fecha: <span id="fechaActual"></span><br>
            Página: 1
        </div>

    </div>

    <!-- ================= PERIODO (ANTES DE LA LINEA) ================= -->
    <div class="periodo">
        PERÍODO DEL: <span id="periodoDesde">01/02/2025</span>
        AL <span id="periodoHasta">15/02/2025</span>
    </div>

    <!-- ================= LINEA ================= -->
    <div class="linea"></div>

    <!-- ================= TABLA ================= -->
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Factura</th>
                <th>Nombre</th>
                <th>Concepto</th>
                <th>Cantidad</th>
                <th>Precio L.</th>
                <th>Impto L.</th>
                <th>Valor L.</th>
                <th>Total L.</th>
            </tr>
        </thead>
        <tbody>
            <!-- VACÍO -->
        </tbody>
    </table>

    <!-- ================= FECHA AUTOMATICA Y PERIODO ================= -->
    <script>
        const hoy = new Date();
        document.getElementById("fechaActual").textContent =
            hoy.toLocaleDateString("es-HN");

        // ESTAS FECHAS LAS PUEDES CAMBIAR DESDE TU SISTEMA PRINCIPAL
        document.getElementById("periodoDesde").textContent = "01/02/2025";
        document.getElementById("periodoHasta").textContent = "15/02/2025";
    </script>

</body>
</html>
