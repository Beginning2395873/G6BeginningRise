<!-- Importante copiar los links de Font Awesome, Google Fonts y Bootstrap -->
<!DOCTYPE html>
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
                    <a class="navbar-brand" href="../inicio.php">
                        <img src="../config/img/icon.png" height="30" width="30"> BeginningRise</a>
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
                                <li><a class="dropdown-item" href="editar_perfil_comprador.php?correoCliente=carlitos@lechuga.com">Editar Perfil</a></li>
                                <li><a class="dropdown-item" href="carrito.php">Carrito de Compras</a></li>
                                <li><a class="dropdown-item" href="admin.php">Administrador</a></li>
                                <li><a class="dropdown-item" href="../controller/logoutControlador.php">Cerrar Sesión</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <div class="container text-light mt-5">
        <div class="row">
            <div class="col-3">
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Tienda
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Vampix</div>
                            <div class="accordion-body">GLA TECNOLOGIA</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Marca
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">Acer</div>
                            <div class="accordion-body">Asus</div>
                            <div class="accordion-body">HP</div>
                            <div class="accordion-body">Lenovo</div>
                            <div class="accordion-body">Mac</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingthree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsethree" aria-expanded="false" aria-controls="flush-collapsethree">
                                Tipo de almacenamiento
                            </button>
                        </h2>
                        <div id="flush-collapsethree" class="accordion-collapse collapse" aria-labelledby="flush-headingthree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">HDD</div>
                            <div class="accordion-body">SSD</div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfour">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                                    Capacidad de almacenamiento
                                </button>
                            </h2>
                            <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">240GB</div>
                                <div class="accordion-body">500GB</div>
                                <div class="accordion-body">1TB</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingfive">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefive" aria-expanded="false" aria-controls="flush-collapsefive">
                                    Memoria RAM
                                </button>
                            </h2>
                            <div id="flush-collapsefive" class="accordion-collapse collapse" aria-labelledby="flush-headingfive" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">4GB</div>
                                <div class="accordion-body">8GB</div>
                                <div class="accordion-body">16GB</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingsix">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsesix" aria-expanded="false" aria-controls="flush-collapsesix">
                                    Procesador
                                </button>
                            </h2>
                            <div id="flush-collapsesix" class="accordion-collapse collapse" aria-labelledby="flush-headingsix" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">AMD</div>
                                <div class="accordion-body">Intel</div>
                                <div class="accordion-body">M1</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingseven">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseseven" aria-expanded="false" aria-controls="flush-collapseseven">
                                    Tarjeta gráfica
                                </button>
                            </h2>
                            <div id="flush-collapseseven" class="accordion-collapse collapse" aria-labelledby="flush-headingseven" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Dedicada</div>
                                <div class="accordion-body">Integrada</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingeight">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseeight" aria-expanded="false" aria-controls="flush-collapseeight">
                                    Pantalla
                                </button>
                            </h2>

                            <div id="flush-collapseeight" class="accordion-collapse collapse" aria-labelledby="flush-headingeight" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">14"</div>
                                <div class="accordion-body">15.6"</div>
                                <div class="accordion-body">17.3"</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingnine">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsenine" aria-expanded="false" aria-controls="flush-collapsenine">
                                    Precio
                                </button>
                            </h2>
                            <div id="flush-collapsenine" class="accordion-collapse collapse" aria-labelledby="flush-headingnine" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Ascendente</div>
                                <div class="accordion-body">Descendente</div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingten">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseten" aria-expanded="false" aria-controls="flush-collapseten">
                                    Calificacion
                                </button>
                            </h2>
                            <div id="flush-collapseten" class="accordion-collapse collapse" aria-labelledby="flush-headingten" data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">Mejor Calificadas</div>
                                <div class="accordion-body">Número de Reseñas</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-9">
                <div class="row row-cols-1 row-cols-md-3 g-4">
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/compu.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">Gigabyte Aero 15 Oled Xd
                                    Intel I7 11800h
                                    Rtx 3070s</h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$1,937,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/compu2.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">ACER ASPIRE 15" CORE
                                    I5+NVIDIA MX330+SSD
                                </h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$2,749,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/compu3.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">HP PAVILION GAMING
                                    15-EC1037LA RYZEN</h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$3,773,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/compu4.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">Msi 15 Katana Gf66 11uc Intel
                                    I7 11800H
                                </h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$5,998,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/compu5.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">Msi Alpha 17 B5eek Ryzen 7
                                    5800h Rtx6600m
                                </h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$7,139,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card shadow-sm">
                            <img class="card-img-top" src="../config/img/Compu6.png">
                            <div class="card-body">
                                <h5 class="card-title" style="color:rgb(197, 23, 23);">Xpg Xenia 15 Kc Intel I7
                                    11800h Rtx 3070
                                </h5>
                                <p class="card_text" style="color:rgb(35, 4, 59);">$10,351,000</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                        <label class="form-label" style="color: #000000;">
                                            Comparar
                                        </label>
                                    </div>
                                    <th scope="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" />
                                            <label class="form-label" style="color: #000000;">
                                                Añadir al carrito
                                            </label>
                                        </div>
                                    </th>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container mt-3">
                    <div class="row">
                        <div class="col">
                            <a href="comparar.php"><button class="btn btn-primary">Comparar</button></a>
                        </div>
                        <div class="col">
                            <a href="carrito.php"><button class="btn btn-warning" style="color: #fff;">Añadir al
                                    Carrito</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>