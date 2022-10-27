<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../config/img/favicon.ico">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- CSS only -->
    <link rel="stylesheet" href="../config/css/bootstrap.min.css">
    <link rel="stylesheet" href="../config/css/cositas.css">
    <title>Beginning Rise</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="col-3">
                    <a class="btn text-light btn-lg btn-outline-link" href="busqueda.php">
                        <i class="fa-solid fa-angle-left"></i>
                        Volver
                    </a>
                </div>
                <div class="col-7 mx-auto" style="max-width: 600px;">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar productos..." aria-label="Search">
                        <a href="busqueda.php" class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </form>
                </div>
                <div class="col-2 px-2">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse align-self-end" id="navbarTogglerDemo02">
                        <div class="btn-group pt-2">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                Mi Perfil
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="editar_perfil_comprador.php">Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="carrito.php">Carrito de Compras</a></li>
                                <li><a class="dropdown-item" href="admin.php">Administrador</a></li>
                                <li><a class="dropdown-item" href="../index.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <div class="container">
        <div>
            <h2 class="text-center mt-5 mb-5">
                Productos añadidos al carrito
            </h2>
        </div>
        <div class="row row-cols-1 row-cols-md-2 g-2">
            <div class="col">
                <div class="card">
                    <img src="../config/img/compu.png" class="card-img-top" alt="...">
                    <div class="card-body" style="color: #000;">
                        <div class="card-title">
                            Gigabyte Aero 15 Oled Xd Intel I7 11800h Rtx 3070s
                        </div>
                        $1,937,000
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <img src="../config/img/compu2.png" class="card-img-top" alt="...">
                    <div class="card-body" style="color: #000;">
                        <div class="card-title">
                            ACER ASPIRE 15" CORE I5+NVIDIA MX330+SSD
                        </div>
                        $2,749,000
                    </div>
                </div>
            </div>
        </div>
        <table class="table mb-4 mt-4">
            <tr>
                <th>Subtotal: </th>
                <td>$1000000</td>
            </tr>
            <tr>
                <th>Envio: </th>
                <td>$55959</td>
            </tr>
            <tr>
                <th>Total: </th>
                <td>$86897870</td>
            </tr>
        </table>
        <h3 class="text-center">
            Seleccione el medio de pago
        </h3>
        <div class="mt-5 mx-auto" style="max-width: 330px;">
            <button class="btn btn-outline-link btn-lg" style="color: #000" ;>
                <i class="fa-brands fa-2xl fa-cc-paypal"></i>
            </button>

            <button class="btn btn-outline-link btn-lg" style="color: #000" ;>
                <i class="fa-brands fa-2xl fa-cc-visa"></i>
            </button>

            <button class="btn btn-outline-link btn-lg" style="color: #000;">
                <i class="fa-brands fa-2xl fa-cc-mastercard"></i>
            </button>

            <button class="btn btn-outline-link btn-lg" style="color: #000;">
                <i class="fa-brands fa-2xl fa-bitcoin"></i>
            </button>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-center text-lg-start text-white mt-5">
        <!-- Grid container -->
        <div class="container p-4 pb-0">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">
                            Beginning Rise
                        </h6>
                        <p>
                            Sistema de Información para la compra y venta de equipos portátiles, enfocado a nuevos
                            emprendedores y personas que no poseen mucho conocimiento en computadores.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Productos</h6>
                        <p>
                            <a class="text-white">www.beginningrise.com</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
                        <p><i class="fas fa-home mr-3"></i> Bogotá, Colombia</p>
                        <p><i class="fas fa-envelope mr-3"></i> beginningrise@gmail.com</p>
                        <p><i class="fas fa-phone mr-3"></i>601 604 6088</p>
                        <p><i class="fas fa-print mr-3"></i>601 566 1469</p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold">Redes</h6>

                        <!-- Facebook -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

                        <!-- Twitter -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

                        <!-- Google -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

                        <!-- Instagram -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

                        <!-- Linkedin -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
                        <!-- Github -->
                        <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2022 Copyright:
            <a class="text-white" href="#">Beginning Rise</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>