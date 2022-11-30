<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="<?php echo urlsite ?>/config/img/favicon.ico">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- CSS only -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/bootstrap.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/sweetalert2.min.css">
    <!-- Cositas -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/cositas.css">
    <title>Beginning Rise</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
            <div class="container-fluid" style="max-width: 240px;">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="<?php echo urlsite ?>">
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
                            <button type="submit" name="search" role="button" class="btn btn-primary me-2" value="Buscar"><i class="fas fa-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 330px;">
                <div class="row">
                    <div class="col mt-2 mb-2">
                        <a href="<?php echo urlsite ?>?page=login" class="btn btn-outline-light me-2">
                        <i class="fa-solid fa-right-to-bracket me-2"></i>
                        Iniciar Sesión
                    </a>
                        <a href="<?php echo urlsite ?>?page=registro" class="btn btn-outline-light me-2">
                            <i class="fa-solid fa-user-plus me-2"></i>
                            Registrarse
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>