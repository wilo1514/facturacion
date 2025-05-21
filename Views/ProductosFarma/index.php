<?php include "Views/Templates/header.php"; ?>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Productos Farmacia</li>
</ol>
<button class="btn btn-primary mb-2" type="button" onclick="frmProductofarma();">Nuevo</button>
<div class="table-responsive">
    <table class="table table-light" id="tblProductosFarma">
        <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Codigo</th>
                <th>N. Comercial</th>
                <th>N. Generico</th>
                <th>Laboratorio</th>
                <th>P. Venta</th>
                <th>Cantidad</th>
                <th>Presentación</th>
                <th>Categoria</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
            </tr>
        </tbody>
    </table>
</div>
<div id="nuevo_productofarma" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="my-modal-title"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="title">Nuevo Producto</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="get" id="frmProductofarma">
                    <div class="form-group">
                        <label for="codigo">Código de barras</label>
                        <input id="id" type="hidden" name="id">
                        <input id="codigo" class="form-control" type="text" name="codigo"
                            placeholder="Código de barras">
                    </div>
                    <div class="form-group">
                        <label for="ncomercial">N. Comercial</label>
                        <input id="ncomercial" class="form-control" type="text" name="ncomercial"
                            placeholder="Nombre comercial">
                    </div>
                    <div class="form-group">
                        <label for="ngenerico">N. Generico</label>
                        <input id="ngenerico" class="form-control" type="text" name="ngenerico"
                            placeholder="Nombre generico">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="laboratorio">laboratorio</label>
                                <input id="laboratorio" class="form-control" type="text" name="laboratorio"
                                    placeholder="Nombre laboratorio">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="iva">IVA</label>
                                <input id="iva" class="form-control" type="text" name="iva" placeholder="IVA">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precio_venta">Precio de Venta</label>
                                <input id="precio_venta" class="form-control" type="text" name="precio_venta"
                                    placeholder="PVP">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="presentacion">Presentacion</label>
                                <select id="presentacion" class="form-control" name="presentacion">
                                    <?php foreach ($data['presentaciones'] as $row) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <select id="categoria" class="form-control" name="categoria">
                                    <?php foreach ($data['categorias'] as $row) {
                                        ?>
                                        <option value="<?php echo $row['id']; ?>">
                                            <?php echo $row['nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="button" onclick="registrarProFar(event);"
                        id="btnAccion">Registrar</button>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>