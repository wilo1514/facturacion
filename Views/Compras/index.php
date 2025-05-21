<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva Compra</li>
</ol>
<div class="card">
    <div class="card-body">
        <form id="frmCompra">
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo">Código de barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código de barras"
                            onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ngenerico">Nombre genérico</label>
                        <input id="ngenerico" class="form-control" type="text" name="ngenerico"
                            placeholder="Nombre genérico">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ncomercial">Nombre comercial</label>
                        <input id="ncomercial" class="form-control" type="text" name="ncomercial"
                            placeholder="Nombre comercial">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_compra">Precio de compra</label>
                        <input id="precio_compra" class="form-control" type="text" name="precio_compra"
                            placeholder="Precio de compra" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="lote">Lote</label>
                        <input id="lote" class="form-control" type="text" name="lote" placeholder="Lote"
                            onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="fecha_caducidad">Fecha de caducidad</label>
                        <input id="fecha_caducidad" class="form-control" type="date" name="fecha_caducidad"
                            placeholder="Fecha de caducidad" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="laboratorio">Laboratorio</label>
                        <input id="laboratorio" class="form-control" type="text" name="laboratorio"
                            placeholder="Laboratorio">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="distribuidora">Distribuidora</label>
                        <input id="distribuidora" class="form-control" type="text" name="distribuidora"
                            placeholder="Distribuidora" onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="factura">Factura</label>
                        <input id="factura" class="form-control" type="text" name="factura" placeholder="Factura"
                            onkeyup="buscarCodigo(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad"
                            onkeyup="calcularPrecio(event)">
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="sub_total">Sub Total</label>
                        <input id="sub_total" class="form-control" type="text" name="sub_total" placeholder="Sub Total"
                            disabled>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table table-light">
    <thead class="thead-dark">
        <tr>
            <th>Id</th>
            <th>Nombre generico</th>
            <th>Nombre comercial</th>
            <th>Cantidad</th>
            <th>Aplicar</th>
            <th>Descuento</th>
            <th>precio</th>
            <th>Sub Total</th>
            <th></th>
        </tr>
    </thead>
    <tbody id="tblDetalle">
    </tbody>
</table>
<div class="row">
    <div class="col-md-4 ml-auto">
        <div class="form-group">
            <label for="total" class="font-weight-bold">Total</label>
            <input id="total" class="form-control" type="text" name="total" placeholder="Total">
            <button class="btn btn-primary mt-2 btn-block" type="button" onclick="trasferirData(event)">Generar
                compra</button>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>