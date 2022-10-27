<?php

$consulta = consultarTienda($_GET['nit_tienda']);

function consultarTienda($tienda)
{
    include "../connect/config.php";
    $connect = new Conexion();
    $c = $connect->conectando();
    $sentencia = "SELECT * FROM tiendas WHERE nit_tienda='" . $tienda . "' ";
    $resultado = mysqli_query($c, $sentencia);
    $fila = mysqli_fetch_assoc($resultado);
    return [
        $fila['nit_tienda'],
        $fila['nombre_tienda'],
        $fila['direccion_tienda'],
        $fila['telefono_tienda'],
        $fila['email_tienda'],
        $fila['foto_tienda']
    ];
}
?>
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
        <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #0A1E35;">
            <div class="container">
                <div class="col-2">
                    <a class="btn text-light btn-lg btn-outline-link" href="perfiltienda.php">
                        <i class="fa-solid fa-angle-left"></i>
                        Volver
                    </a>
                </div>
                <div class="col-8 mx-auto" style="max-width: 600px;">
                    <h2 class="text-center text-light">
                        BeginningRise - Tienda
                    </h2>
                </div>
                <div class="col-2 px-2">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse align-self-end" id="navbarTogglerDemo02">

                        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="btn text-light btn-lg btn-outline-link px-2 me-2" href="../index.php">
                                    <i class="fa-solid fa-lg fa-arrow-right-from-bracket"></i>
                                    Salir
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <!-- Fila -->
    <div class="row mt-5">
        <!-- Columna Derecha -->
        <div class="col-10 mx-auto" style="max-width: 600px;">
            <div class="card mt-4">
                <div class="card-header">
                    <h3 class="text-center">
                        Editar Perfil:
                    </h3>
                    <p class="text-center">
                        Los campos marcados con <span style="color: red;">(*)</span> son obligatorios.
                    </p>
                </div>
                <div class="card-body">
                    <form action="../controller/tiendasControlador.php" method="POST" enctype="multipart/form-data">
                        <!-- Nombre y NIT -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input class="form-control" type="text" id="nombreTienda" name="nombreTienda" value="<?php echo $consulta[1] ?>" />
                                    <label class="form-label" for="nombreTienda">Nombre de la tienda<span style="color: red;">(*)</span></label>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input class="form-control" type="text" id="nit" name="nit" value="<?php echo $consulta[0] ?>" readonly />
                                    <label class="form-label" for="nit">Número de Identificación Tributaria
                                        (NIT)<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Dirección y Teléfono -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $consulta[2] ?>" />
                                    <label class="form-label" for="direccion">Dirección<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline mb-4">
                                    <input class="form-control" type="number" id="telefono" name="telefono" value="<?php echo $consulta[3] ?>" />
                                    <label class="form-label" for="telefono">Teléfono<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>
                        <!--Correo -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input class="form-control" type="email" id="correoTienda" name="correoTienda" value="<?php echo $consulta[4] ?>" />
                                    <label class="form-label" for="correoTienda">Correo Electrónico<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>
                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="fotoTienda" class="form-label">Foto de Perfil</label>
                            <input class="form-control" type="file" id="fotoTienda" accept=".jpg, .png, .webp" name="fotoTienda">
                        </div>
                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 150px;">
                            <input type="hidden" name="modificar" />
                            <input type="submit" class="btn btn-outline-success sbtn-block mb-4" value="Guardar Cambios" />
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