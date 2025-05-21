<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Ventas del Mes</li>
</ol>
<div class="table-responsive">
    <table class="table table-light" id="tblListaVentasMes">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>F. Venta</th>
                <th>Usuario</th>
                <th>Codigo</th>
                <th>Nombre generico</th>
                <th>Nombre comercial</th>
                <th>Cantidad</th>
                <th>P Venta</th>
                <th>Medico</th>
                <th>Cliente</th>
                <th>IESS</th>
                <th>Sub Total</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<form id="frmVentaMes">
    <div class="row">
        <div class="col-md-3 ml-auto">
            <div class="form-group">
                <label for="totalventames" class="font-weight-bold">Total</label>
                <input id="totalventames" class="form-control" type="text" name="totalventames" placeholder="Total">
                <button class="btn btn-primary mt-2 btn-block" type="button" onclick="reporteMensual(event)">Generar
                    reporte Mensual</button>
            </div>
        </div>
    </div>
</form>
<?php include "Views/Templates/footer.php"; ?>