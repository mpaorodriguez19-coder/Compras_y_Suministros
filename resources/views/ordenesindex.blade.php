<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Orden de Compra</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light p-4">

<div class="container bg-white p-4 rounded shadow">
    <h3 class="text-center mb-4">Orden de Comprasss</h3>

    <form>
        <div class="row mb-3">
            <div class="col">
                <label>Fecha:</label>
                <input type="date" class="form-control">
            </div>
            <div class="col">
                <label>Proveedor:</label>
                <input type="text" class="form-control">
            </div>
            <div class="col">
                <label>Lugar:</label>
                <input type="text" class="form-control">
            </div>
            <div class="col">
                <label>Solicitado Por:</label>
                <input type="text" class="form-control">
            </div>
        </div>

        <table class="table table-bordered text-center">
            <thead class="table-secondary">
                <tr>
                    <th>Cantidad</th>
                    <th>Descripción</th>
                    <th>Unidad</th>
                    <th>Precio Unitario</th>
                    <th>Descuento</th>
                    <th>Valor L.</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" class="form-control" value="1"></td>
                    <td><input type="text" class="form-control" value="TONER"></td>
                    <td><input type="text" class="form-control" value="UNIDAD"></td>
                    <td><input type="number" class="form-control" value="5000"></td>
                    <td><input type="number" class="form-control" value="0"></td>
                    <td><input type="number" class="form-control" value="5000"></td>
                </tr>
            </tbody>
        </table>

        <div class="row">
            <div class="col-8">
                <label>Concepto:</label>
                <textarea class="form-control" rows="2"></textarea>
            </div>
            <div class="col-4">
                <table class="table table-sm">
                    <tr><td>Sub-total:</td><td class="text-end">5,000.00</td></tr>
                    <tr><td>Descuento:</td><td class="text-end">0.00</td></tr>
                    <tr><td>Impuesto:</td><td class="text-end">750.00</td></tr>
                    <tr class="fw-bold"><td>Total:</td><td class="text-end">5,750.00</td></tr>
                </table>
            </div>
        </div>

        <div class="text-end">
            <button type="submit" class="btn btn-success">Guardar</button>
            <button type="reset" class="btn btn-secondary">Cancelar</button>
        </div>
    </form>
</div>

</body>
</html>
