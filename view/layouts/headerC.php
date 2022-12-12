<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo urlsite ?>/config/img/favicon.ico">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- CSS only -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/cositas.css">
    <title>Beginning Rise</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark mb-4" style="background-color: #291430;">
            <div class="container-fluid" style="max-width: 240px;">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="<?php echo urlsite ?>?page=cliente">
                            <img src="<?php echo urlsite ?>/config/img/icon.png" height="48" width="48"><span class="fs-4">Beginning Rise</span></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 900px;">
                <div class="col-12">
                    <!-- Busqueda -->
                    <form action="" class="d-flex" role="search" method="POST">
                        <div class="input-group">
                            <input type="search" id="buscar" class="form-control" name="busqueda" placeholder="Buscar Producto" aria-label="Search" />
                            <button type="submit" name="search" role="button" class="btn btn-secondary me-2" value="Buscar"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 260px;">
                <div class="row mx-auto" style="max-width: 140px;">
                    <div class="col">
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user me-1"></i>
                                Mi perfil
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo urlsite ?>?page=cliente&opcion=editarPerfilComprador">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Editar Perfil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-solid fa-cart-shopping me-2"></i>
                                        Carrito de Compras
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#">
                                        <i class="fa-solid fa-truck-fast"></i>
                                        Pedidos
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="<?php echo urlsite ?>?page=logout">
                                    <i class="fa-solid fa-right-from-bracket me-2"></i>
                                    Cerrar Sesión
                                </a>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>