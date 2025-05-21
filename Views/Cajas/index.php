<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Ventas del dia</li>
</ol>
<div class="table-responsive">
    <table class="table table-light" id="tblListaVentasDia">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>F. Venta</th>
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
<form id="frmVentaDia">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="apertura">Apertura</label>
                <input id="apertura" class="form-control" type="text" name="apertura" placeholder="dinero de apertura"
                    value="0.00">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="observacion">Observaciones</label>
                <input id="observacion" class="form-control" type="text" name="observacion" placeholder="Observaciones"
                    value="Ninguna">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 ml-auto">
            <div class="form-group">
                <label for="totalventadia" class="font-weight-bold">Total</label>
                <input id="totalventadia" class="form-control" type="text" name="totalventadia" placeholder="Total">
                <button class="btn btn-primary mt-2 btn-block" type="button" onclick="reporteDiario(event)">Generar
                    reporte diario</button>
            </div>
        </div>
    </div>
</form>
<?php include "Views/Templates/footer.php"; ?>