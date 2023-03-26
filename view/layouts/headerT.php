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
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Cositas -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/cositas.css">
    <script src="<?php echo urlsite ?>/config/js/cositas.js"></script>
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <!-- DataTable -->
    <link href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.css">
    <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.js"></script>
    <link href="https://cdn.datatables.net/1.13.3/css/dataTables.bootstrap5.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.3.5/css/buttons.bootstrap5.min.css" rel="stylesheet" />
    <title>Beginning Rise</title>
</head>

<body>
    <div class="spinner-container">
        <span class="loader"></span>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0A1E35;">
            <div class="container-fluid" style="max-width: 240px;">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="<?php echo urlsite ?>?page=tienda">
                            <img src="<?php echo urlsite ?>/config/img/icon.png" height="48" width="48"><span class="fs-4">Beginning Rise</span></a>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 800px;">
                <div class="col-12">
                    <h2 class="text-center text-light">
                        BeginningRise - Empresa
                    </h2>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 260px;">
                <div class="row mx-auto" style="max-width: 140px;">
                    <div class="col">
                        <div class="dropdown mx-auto">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-user me-1"></i>
                                Mi perfil
                            </button>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="<?php echo urlsite ?>?page=tienda&opcion=editarPerfilTienda">
                                        <i class="fa-solid fa-pen-to-square me-2"></i>
                                        Editar Perfil
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" id="logout" onclick="event.preventDefault(); alertaCerrarSesion()" href="?page=logout">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>
                                        Cerrar Sesión
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>