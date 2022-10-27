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
        <!-- NavBar -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <div class="col-3">
                    <a class="btn text-light btn-outline-link" href="registro.php">
                        <i class="fa-solid fa-angle-left"></i>
                        Volver
                    </a>
                </div>
                <!-- Busqueda -->
                <!-- <div class="col-7 mx-auto" style="max-width: 500px;">
                    <form class="d-flex" role="search">
                        <input class="form-control me-2" type="search" placeholder="Buscar productos..." aria-label="Search">
                        <a href="busqueda.php" class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></a>
                    </form>
                </div> -->
                <div class="col-2 px-2">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse align-self-end" id="navbarTogglerDemo02">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                    <!-- <a  href="login.php"> -->
                                        <button class="btn text-light btn-outline-link">
                                        Acceder
                                        </button>
                                    <!-- </a> -->
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <!-- NavBar -->
    </header>
    <div class="row justify-content-center align-self-center mt-5 ">
        <div class="col-12">
            <div class="card top-50 start-50 translate-middle w-50 h-auto" style="max-width: 600px;">
                <div class="card-header">
                    <h3 class="text-center">
                        <i class="fa-solid fa-user"></i>
                        Registro Comprador
                    </h3>
                    <p class="text-center">
                        Ingrese los datos solicitados para registrarse, recuerde que los campos marcados con <span style="color: red;">(*)</span> son obligatorios.</p>
                </div>
                <div class="card-body">

                    <form method="POST" action="../controller/clientesControlador.php" enctype="multipart/form-data">
                        <!-- Tipo y Número de Documento -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <select class="form-select" aria-label="Default select example" name="t_doc" id="t_doc">
                                        <option selected></option>
                                        <option value="1">Cédula de Ciudadanía</option>
                                        <option value="2">Cédula de Extranjería</option>
                                        <option value="3">Tarjeta de Identidad</option>
                                    </select>
                                    <label class="form-label" for="t_doc">Tipo de documento<span style="color: red;">(*)</span></label>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="number" id="documento" class="form-control" name="documento" inputmode="numeric"/>
                                    <label class="form-label" for="documento">Número de documento<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-outline mb-4">
                            <input type="text" id="nombre" class="form-control" name="nombre" />
                            <label class="form-label" for="nombre">Nombre Completo<span style="color: red;">(*)</span></label>
                        </div>

                        <!-- Correo -->
                        <div class="form-outline mb-4">
                            <input type="email" id="correo" class="form-control" name="correo" />
                            <label class="form-label" for="correo">Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="correo2" class="form-control" name="correo2" />
                            <label class="form-label" for="correo2">Vuelva a ingresar el Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Dirección-->
                        <div class="form-outline mb-4">
                            <input type="text" id="direccion" class="form-control" name="direccion" />
                            <label class="form-label" for="nombre">Dirección<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Telefóno-->
                        <div class="form-outline mb-4">
                            <input type="number" id="telefono" class="form-control" name="telefono" inputmode="numeric"/>
                            <label class="form-label" for="nombre">Telefono<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Contraseña -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="password" id="pass" class="form-control" name="pass" />
                                    <label class="form-label" for="pass">Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="password" id="pass2" class="form-control" name="pass2" />
                                    <label class="form-label" for="pass2">Vuelva a ingresar la Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div id="passwordHelpBlock" class="form-text">
                                Su contraseña debe tener entre 8 y 20 caracteres, contener letras, números, y no debe
                                contener espacios, caracteres especiales o emojis.
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="fotoPerfil" class="form-label" >Foto Perfil</label>
                            <input class="form-control" type="file" id="fotoPerfil" accept=".jpg, .png, .webp" name="fotoPerfil">
                        </div>

                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 150px;">
                            <input type="hidden" name="añadir" id="añadir">
                            <input type="submit" class="btn btn-outline-primary btn-block mb-4" value="Registrarse" />
                        </div>
                    </form>
                </div>
            </div>
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
                        <p><i class="fas fa-phone mr-3"></i>601 566 1469</p>
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
</body>

</html>