<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>inicio secion Alban</title>
    <link href="<?php echo base_url; ?>/Assets/css/styles.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>/Assets/js/all.min.js" crossorigin="anonymous"></script>
</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Iniciar Sesión</h3>
                                </div>
                                <div class="card-body">
                                    <form id="frmLogin">
                                        <div class="form-group">
                                            <label class="small mb-1" for="usuario"><i class="fas fa-user"></i>
                                                Usuario</label>
                                            <input class="form-control py-4" id="usuario" name="usuario" type="text"
                                                placeholder="Ingrese usuario" />
                                        </div>
                                        <div class="form-group">
                                            <label class="small mb-1" for="clave"><i class="fas fa-key"></i>
                                                Contraseña</label>
                                            <input class="form-control py-4" id="clave" name="clave" type="password"
                                                placeholder="Ingrese contraseña" />
                                        </div>
                                        <div class="alert alert-danger text-center d-none" id="alerta" role="alert">
                                        </div>
                                        <div
                                            class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <button class="btn btn-primary" type="submit"
                                                onclick="frmLogin(event);">Entrar</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="<?php echo base_url; ?>/Assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>/Assets/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>/Assets/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url; ?>/Assets/js/scripts.js"></script>
    <script>
        const base_url = "<?php echo base_url; ?>";
    </script>
    <script src="<?php echo base_url; ?>/Assets/js/login.js"></script>
</body>

</html>