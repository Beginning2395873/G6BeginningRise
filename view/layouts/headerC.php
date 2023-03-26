<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Security-Policy" content="default-src *;
   img-src * 'self' data: https:; script-src 'self' 'unsafe-inline' 'unsafe-eval' *;
   style-src  'self' 'unsafe-inline' *">
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
    <!-- whatsapp -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/stylewhatsapp.css">
    <!-- whatsapp button-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ver más -->
    <link rel="stylesheet" href="<?php echo urlsite ?>/config/css/vermas.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <!-- PayPal -->
    <script src="https://www.paypal.com/sdk/js?client-id=ATc-M4Qcn9cruydocERtqST63I4uj2cOwMROEWiTfQjJXMjlU2XS8BEtAewXAvVhwNl7Xbd6U4-eP8ZR&currency=USD"></script>
    <title>Beginning Rise</title>

    <!-- Definir la función de puntuación -->
    <script type="text/javascript">
        function ratestar($id, $nit, $puntaje) {
            $.ajax({
                type: 'GET',
                url: '?page=cliente&opcion=votarProducto',
                data: 'votarElemento=' + $id + '&n=' + $nit + '&puntaje=' + $puntaje,
                success: function(data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    </script>


</head>

<body>
    <div class="spinner-container">
        <span class="loader"></span>
    </div>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #291430;">
            <div class="container-fluid" style="max-width: 240px;">
                <div class="row">
                    <div class="col">
                        <a class="navbar-brand" href="<?php echo urlsite ?>?page=cliente">
                            <img src="<?php echo urlsite ?>/config/img/icon.png" height="48" width="48">
                            <span class="fs-4">Beginning Rise</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="container-fluid" style="max-width: 900px;">
                <div class="col-12">
                    <!-- Busqueda -->
                    <form action="?page=cliente&opcion=buscar" role="search" method="POST">
                        <div class="input-group my-auto">
                            <input type="search" id="buscar" class="form-control" name="busqueda" placeholder="Buscar Producto" aria-label="Search" />
                            <button type="submit" name="search" role="button" class="btn btn-secondary me-2" value="Buscar" onclick="reSubmission()"><i class="fas fa-search"></i></button>
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
                                    <a class="dropdown-item" href="?page=cliente&opcion=carrito">
                                        <i class="fa-solid fa-cart-shopping me-2"></i>
                                        Carrito de Compras
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="?page=cliente&opcion=pedidos">
                                        <i class="fa-solid fa-truck-fast"></i>
                                        Pedidos
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

        <a href="https://api.whatsapp.com/send?phone=3012814712&text=Hola, tengo una duda respecto a BeginningRise" class="float pulse" target="_blank">
            <i class="fa fa-whatsapp my-float "></i>
        </a>
    </header>