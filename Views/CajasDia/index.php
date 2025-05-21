<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Ventas del dia</li>
</ol>
<div class="table-responsive">
    <table class="table table-light" id="tblListaVentasDiaAd">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Dinero I.</th>
                <th>Contado</th>
                <th>Tarjeta</th>
                <th>Total Ventido</th>
                <th>Total en Caja</th>
                <th>Observacion</th>
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
<form id="frmVentaDiaAd">
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
                <label for="totalventadiaAd" class="font-weight-bold">Total</label>
                <input id="totalventadiaAd" class="form-control" type="text" name="totalventadiaAd" placeholder="Total">
                <button class="btn btn-primary mt-2 btn-block" type="button" onclick="reporteDiarioAd(event)">Generar
                    reporte diario</button>
            </div>
        </div>
    </div>
</form>
<?php include "Views/Templates/footer.php"; ?>