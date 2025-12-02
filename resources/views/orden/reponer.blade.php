<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Compra</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 13px;
            margin: 40px;
        }

        .titulo-centro {
            text-align: center;
            font-weight: bold;
            font-size: 16px;
        }

        .tabla-header {
            width: 100%;
            margin-top: 10px;
        }

        .tabla-header td {
            vertical-align: top;
        }

        .tabla-detalle {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .tabla-detalle th, .tabla-detalle td {
            border: 1px solid black;
            padding: 5px;
            font-size: 12px;
            text-align: center;
        }

        .firma {
            margin-top: 40px;
            width: 100%;
            text-align: center;
        }

        .firmas td {
            padding-top: 50px;
        }

        .subtotales {
            width: 40%;
            float: right;
            margin-top: 10px;
            border: 1px solid black;
            padding: 10px;
        }

        .subtotales td {
            padding: 3px;
        }
    </style>
</head>
<body>

    <div class="titulo-centro">
        MUNICIPALIDAD DE DANLÍ, EL PARAÍSO<br>
        Departamento de El Paraíso, Honduras, C.A.<br>
        Teléfonos: 2763-2080 / 2763-2405 &nbsp;&nbsp;&nbsp; Fax: 2763-2638<br>
        <h3>ORDEN DE COMPRA No. ___________</h3>
    </div>

    <table class="tabla-header">
        <tr>
            <td><strong>LUGAR:</strong> _____________________________</td>
            <td><strong>FECHA:</strong> _____________________________</td>
        </tr>
        <tr>
            <td colspan="2"><strong>A:</strong> ____________________________________________________</td>
        </tr>
    </table>

    <p>
        Estimados señores:<br>
        Agradecemos entregar los materiales o prestar los servicios indicados en el siguiente cuadro:
    </p>

    <table class="tabla-detalle">
        <thead>
            <tr>
                <th>No.</th>
                <th>DESCRIPCIÓN</th>
                <th>UNIDAD</th>
                <th>CANTIDAD</th>
                <th>PRECIO U.</th>
                <th>VALOR L.</th>
            </tr>
        </thead>
        <tbody>
            @for ($i = 1; $i <= 10; $i++)
                <tr>
                    <td>{{ $i }}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            @endfor
        </tbody>
    </table>

    <table class="subtotales">
        <tr>
            <td><strong>Sub - Total L.</strong></td>
            <td>_________</td>
        </tr>
        <tr>
            <td><strong>Descuento.</strong></td>
            <td>_________</td>
        </tr>
        <tr>
            <td><strong>Impuesto.</strong></td>
            <td>_________</td>
        </tr>
        <tr>
            <td><strong>Total Pago:</strong></td>
            <td>_________</td>
        </tr>
    </table>

    <div style="clear: both;"></div>

    <p style="margin-top: 40px;">
        UTILIZADOS POR: ______________________________________________________________
    </p>

    <p>
        SOLICITADO POR: ______________________________________________________________
    </p>

    <br><br>

    <table class="firmas" width="100%">
        <tr>
            <td>_____________________________<br>Jefe de Compras</td>
            <td>_____________________________<br>Gerente Administrativo</td>
            <td>_____________________________<br>Alcalde Municipal</td>
        </tr>
    </table>

    <p style="margin-top: 40px;">
        <strong>Copia</strong> &nbsp;&nbsp;&nbsp;&nbsp; Hecho por: ______________________
    </p>

</body>
</html>

