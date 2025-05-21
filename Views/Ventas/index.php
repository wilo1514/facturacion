<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Nueva Venta</li>
</ol>
<form id="frmPrincipal">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="cliente">Seleccionar Cliente</label>
                <select id="cliente" class="form-control" name="id_cliente">
                    <?php foreach ($data['cliente'] as $row) { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="medico">Seleccionar Medico</label>
                <select id="medico" class="form-control" name="medico">
                    <?php foreach ($data['medico'] as $row) { ?>
                        <option value="<?php echo $row['id']; ?>">
                            <?php echo $row['nombre']; ?>
                        </option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="seguro">IESS</label>
                <select id="seguro" class="form-control" name="seguro">
                    <option value="si">Si</option>
                    <option value="no" selected>No</option>
                </select>
            </div>
        </div>
    </div>
</form>
<div class="card">
    <div class="card-body">
        <form id="frmVenta">
            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="codigo">Código de barras</label>
                        <input type="hidden" id="id" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo" placeholder="Código de barras"
                            onkeyup="buscarVenta(event)">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="busqueda">Buscar N. Comercial</label>
                        <input id="busqueda" class="form-control" type="text" name="busqueda"
                            placeholder="Busqueda por nombre">
                    </div>
                </div>

                <script>
                    $(document).ready(function () {
                        $("#busqueda").autocomplete({
                            source: function (request, response) {

                                $.ajax({
                                    url: base_url + "Ventas/buscarCodigoNombreAutocompletar",
                                    dataType: "json",
                                    data: {
                                        term: request.term
                                    },
                                    success: function (data) {
                                        var nombresComerciales = data.map(function (item) {
                                            return item.ncomercial + "  -  " + item.ngenerico;
                                        });
                                        response(nombresComerciales);
                                    },
                                    error: function (xhr, status, error) {
                                        console.error(xhr.responseText);
                                    }
                                });
                            },
                            minLength: 2, // Número mínimo de caracteres antes de iniciar la búsqueda
                            select: function (event, ui) {
                                var e = jQuery.Event("keypress");
                                ncomercial = ui.item.value.split("  -  ")[0];
                                //console.log(ncomercial);
                                e.which = 13; // 13 es el código ASCII para la tecla Enter
                                buscarVentaNombre(e, ncomercial);
                            },
                            open: function () {
                                // Agregar un identificador a la lista desplegable
                                var $menu = $(this).autocomplete("widget");
                                $menu.addClass("custom-autocomplete-list"); // Puedes cambiar el nombre del identificador según lo necesites
                            }
                        });
                    });

                </script>

                <!-- fin cambios -->
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ngenerico">Nombre genérico</label>
                        <input id="ngenerico" class="form-control" type="text" name="ngenerico"
                            placeholder="Nombre genérico" disabled>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="ncomercial">Nombre comercial</label>
                        <input id="ncomercial" class="form-control" type="text" name="ncomercial"
                            placeholder="Nombre comercial" disabled>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="laboratorio">Laboratorio</label>
                        <input id="laboratorio" class="form-control" type="text" name="laboratorio"
                            placeholder="Laboratorio" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="precio_venta">Precio de Venta</label>
                        <input id="precio_venta" class="form-control" type="text" name="precio_venta"
                            placeholder="Precio de venta" disabled>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="cantidad">Cantidad</label>
                        <input id="cantidad" class="form-control" type="number" name="cantidad" placeholder="Cantidad"
                            onkeyup="calcularVenta(event)">
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
    <tbody id="tblDetalleVenta">
    </tbody>
</table>
<form id="frmSegundo">
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="observacion">Observaciones</label>
                <input id="observacion" class="form-control" type="text" name="observacion" placeholder="Observaciones"
                    value="Ninguna">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="tarjeta">Tarjeta</label>
                <select id="tarjeta" class="form-control" name="tarjeta">
                    <option value="si">Si</option>
                    <option value="no" selected>No</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3 ml-auto">
            <div class="form-group">
                <label for="totalventa" class="font-weight-bold">Total</label>
                <input id="totalventa" class="form-control" type="text" name="totalventa" placeholder="Total">
                <button class="btn btn-primary mt-2 btn-block" type="button" onclick="trasferirVentaOb(event)">Generar
                    Venta</button>
            </div>
        </div>
    </div>
</form>

<?php include "Views/Templates/footer.php"; ?>