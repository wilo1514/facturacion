<?php include "Views/Templates/header.php"; ?>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary">
            <div class="card-body d-flex text-white">
                Usuarios
                <i class="fas fa-user fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Usuarios" class="text-white">Ver Detalle</a>
                <span class="text-white">
                    <?php echo $data['usuarios']['total']; ?>
                </span>
            </div>
        </div>
        <div class="card bg-success">
            <div class="card-body d-flex text-white">
                Clientes
                <i class="fas fa-users fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Clientes" class="text-white">Ver Detalle</a>
                <span class="text-white">
                    <?php echo $data['clientes']['total']; ?>
                </span>
            </div>
        </div>
        <div class="card bg-warning">
            <div class="card-body d-flex text-white">
                Productos
                <i class="fab fa-product-hunt fa-2x"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a href="<?php echo base_url; ?>Productos" class="text-white">Ver Detalle</a>
                <span class="text-white">
                    <?php echo $data['productos']['total']; ?>
                </span>
            </div>
        </div>
    </div>
</div>
<?php include "Views/Templates/footer.php"; ?>