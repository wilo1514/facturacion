<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Panel de Administración</title>

    <link href="<?php echo base_url; ?>Assets/DataTables/dataTables.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="<?php echo base_url; ?>Assets/css/select2.min.css" rel="stylesheet" />
    <script src="<?php echo base_url; ?>Assets/js/all.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo base_url; ?>Assets/js/jquery-ui.js" crossorigin="anonymous"></script>
    <link href="<?php echo base_url; ?>Assets/css/styles.css" rel="stylesheet" />
    <link href="<?php echo base_url; ?>Assets/css/estilos.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand" href="index.html">Sistema Clinica Alban</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i
                class="fas fa-bars"></i></button>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                    <input id="idusuario" class="form-control" type="text" name="idusuario" disabled>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url; ?>Usuarios/salir">Cerrar Sesión</a>
                </div>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="<?php echo base_url; ?>Administracion">
                            <div class="sb-nav-link-icon"><i class="fas fa-home"></i></div>
                            Home
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts"
                            aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-cogs"></i></div>
                            Configuración
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Usuarios">Usuarios</a>
                                <!-- <a class="nav-link" href="<?php echo base_url; ?>Cajas">Cajas Farmacia</a> -->
                                <a class="nav-link" href="<?php echo base_url; ?>ListaComprasAdmin">Lista de compras
                                    Admin</a>
                                <a class="nav-link" href="<?php echo base_url; ?>ListaVentasAdmin">Lista de ventas
                                    Admin</a>
                                <!-- <a class="nav-link" href="<?php echo base_url; ?>Categorias">Categorias</a> -->
                                <a class="nav-link" href="<?php echo base_url; ?>Productos">
                                    Productos Admin
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>CajasDia">
                                    Cierre Caja diario
                                </a>
                                <a class="nav-link" href="<?php echo base_url; ?>CajasAd">
                                    Cierre Caja Mensual
                                </a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?php echo base_url; ?>Clientes">
                            <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                            Clientes
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Medicos">
                            <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                            Medicos
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Presentaciones">
                            <div class="sb-nav-link-icon"><i class="fas fa-ruler"></i></div>
                            Presentaciones
                        </a>
                        <!-- <a class="nav-link" href="<?php echo base_url; ?>Categorias">
                            <div class="sb-nav-link-icon"><i class="fas fa-file-invoice"></i></div>
                            Categorias
                        </a> -->
                        <!-- <a class="nav-link" href="<?php echo base_url; ?>Productos">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                            Productos
                        </a> -->
                        <a class="nav-link" href="<?php echo base_url; ?>ProductosFarma">
                            <div class="sb-nav-link-icon"><i class="fab fa-product-hunt"></i></div>
                            Productos Farmacia
                        </a>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts2"
                            aria-expanded="false" aria-controls="collapseLayouts2">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Compras
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts2" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Compras">Ingresar compras</a>
                                <a class="nav-link" href="<?php echo base_url; ?>ListaCompras">Lista de compras</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts3"
                            aria-expanded="false" aria-controls="collapseLayouts3">
                            <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                            Ventas
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts3" aria-labelledby="headingOne"
                            data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="<?php echo base_url; ?>Ventas">Ingresar ventas</a>
                                <a class="nav-link" href="<?php echo base_url; ?>ListaVentas">Lista de ventas</a>
                            </nav>
                        </div>
                        <a class="nav-link" href="<?php echo base_url; ?>Cajas">
                            <div class="sb-nav-link-icon"><i class="fas fa-box"></i></div>
                            Cierre Caja
                        </a>
                        <a class="nav-link" href="<?php echo base_url; ?>Caducados">
                            <div class="sb-nav-link-icon"><i class="fas fa-exclamation-triangle"></i></div>
                            Proximos a caducar
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Desarrollado por:</div><i class="fas fa-user"></i>
                    Ing. William Lituma, Mgtr.
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid mt-2">