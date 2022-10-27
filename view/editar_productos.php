<?php

$consulta = Consultarproducto($_GET['id_producto']);

function Consultarproducto($producto)
{
    include "../connect/config.php";
    $connect = new Conexion();
    $c = $connect->conectando();
    $sentencia = "SELECT * FROM productos WHERE id_producto='" . $producto . "' ";
    $resultado = mysqli_query($c, $sentencia);
    $fila = mysqli_fetch_assoc($resultado);
    return [
        $fila['id_producto'],
        $fila['nombre_producto'],
        $fila['almacenamiento'],
        $fila['ram'],
        $fila['precio'],
        $fila['estado'],
        $fila['imagen']
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
    <div class="row mt-5">
        <div class="col-12 mx-auto" style="max-width: 600px;">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                        Editar Producto
                    </h3>
                </div>
                <div class="card-body">
                    <form action="../controller/productoControlador.php" method="POST" enctype="multipart/form-data">
                        <!-- <div class="form-outline mb-4">
                            <select class="form-select" aria-label="Default select example" name="marca">
                                <option selected>Seleccione...</option>
                                ?php
                                    include "../connect/config.php";
                                    $query = "SELECT * FROM marcas";
                                    $resultado = mysqli_query($con, $query) or die (mysqli_error($con));
                                ?>
                                ?php foreach ($resultado as $opciones): ?>
                                    <option value="?php echo $opciones['marca']?>">?php echo $opciones['marca']?></option>
                                ?php endforeach ?>
                            </select>
                            <label class="form-label" for="marca">Marca</label>
                        </div> -->

                        <div class="form-outline mb-4">
                            <input type="text" id="idProducto" class="form-control" name="idProducto" value="<?php echo $consulta[0] ?>">
                            <label class="form-label" for="idProducto">Código</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="nombreProducto" class="form-control" name="nombreProducto" value="<?php echo $consulta[1] ?>">
                            <label class="form-label" for="nombreProducto">Nombre del producto</label>
                        </div>

                        <!-- <div class="col">
                            <div class="form-outline">
                                <select class="form-select" aria-label="Default select example" name="tipo">
                                    <option selected>Seleccione...</option>
                                    <option value="1">Gamer</option>
                                    <option value="2">Ofimática</option>
                                </select>
                                <label class="form-label" for="tipo">Tipo de Computador</label>
                            </div>
                        </div> -->

                        <!-- Correo -->
                        <div class="form-outline mb-4">
                            <input type="text" id="disco" class="form-control" name="disco" value="<?php echo $consulta[2] ?>" />
                            <label class="form-label" for="disco">Almacenamiento</label>
                        </div>

                        <!-- <div class="form-outline mb-4">
                            <input type="text" id="cpu" class="form-control" name="cpu" />
                            <label class="form-label" for="cpu">Procesador</label>
                        </div> -->

                        <!--Dirección-->
                        <div class="form-outline mb-4">
                            <input type="text" id="ram" class="form-control" name="ram" value="<?php echo $consulta[3] ?>" />
                            <label class="form-label" for="ram">Memoria Ram</label>
                        </div>

                        <!-- <div class="form-outline mb-4">
                            <input type="text" id="pantalla" class="form-control" name="pantalla" />
                            <label class="form-label" for="pantalla">Pantalla</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="grafica" class="form-control" name="grafica" />
                            <label class="form-label" for="grafica">Grafica</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="bateria" class="form-control" name="bateria" />
                            <label class="form-label" for="bateria">Bateria</label>
                        </div> -->
                        <div class="form-outline mb-4">
                            <input type="text" id="precio" class="form-control" name="precio" value="<?php echo $consulta[4] ?>" />
                            <label class="form-label" for="precio">Precio</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" id="estado" class="form-control" name="estado" value="<?php echo $consulta[5] ?>" />
                            <label class="form-label" for="estado">Estado</label>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="imagen" class="form-label" >Insertar imagen del Computador</label>
                            <input class="form-control" type="file" id="imagen" value="<?php echo $consulta[6] ?>" accept=".jpg, .png, .webp" name="imagen">
                        </div>

                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 95px;">
                            <input type="submit" name="modificar" class="btn btn-outline-success sbtn-block mb-4" value="Modificar" />
                        </div>
                    </form>
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
    <!-- Footer -->

</body>

</html>