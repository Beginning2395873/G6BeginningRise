<?php
include "../connect/config.php";

// Variable para la búsqueda
if ($_POST) {
    $obj->busqueda = strtolower($_REQUEST['busqueda']);
}
// Conexión
$connect = new Conexion();
$c = $connect->conectando();
// Conteo para paginador
$query = "SELECT count(*) as totalRegistros from productos";
$resultado = mysqli_query($c, $query);
$arreglo = mysqli_fetch_array($resultado);
$totalRegistros = $arreglo['totalRegistros'];


$maximoRegistros = 5;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

// Condicional por si se introduce algo en la barra de búsqueda
if (!empty($_POST['search'])) {
    // Resultado de búsqueda
    $query2 = "SELECT ventas.id_ventas, persona.nombre_persona, tiendas.nombre_tienda, marcas.marca, productos.nombre_producto, productos.precio, ventas.fecha FROM ventas inner JOIN persona ON ventas.email_cliente = persona.email_persona INNER JOIN tiendas ON ventas.nit_tienda = tiendas.nit_tienda INNER JOIN productos ON ventas.id_producto = productos.id_producto INNER JOIN marcas ON productos.id_marca = marcas.id_marca where id_ventas like '%$obj->busqueda%' or nombre_persona like '%$obj->busqueda%' or nombre_tienda like '%$obj->busqueda%' or marca like '%$obj->busqueda%' or nombre_producto like '%$obj->busqueda%' order by productos.id_producto asc limit $desde,$maximoRegistros";
    $resultado2 = mysqli_query($c, $query2);
    $arreglo2 = mysqli_fetch_array($resultado2);
} else {
    // Todos los registros
    $query2 = "SELECT ventas.id_ventas, persona.nombre_persona, tiendas.nombre_tienda, marcas.marca, productos.nombre_producto, productos.precio, ventas.fecha FROM ventas inner JOIN persona ON ventas.email_cliente = persona.email_persona INNER JOIN tiendas ON ventas.nit_tienda = tiendas.nit_tienda INNER JOIN productos ON ventas.id_producto = productos.id_producto INNER JOIN marcas ON productos.id_marca = marcas.id_marca limit $desde,$maximoRegistros";
    $resultado2 = mysqli_query($c, $query2);
    $arreglo2 = mysqli_fetch_array($resultado2);
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
    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="input-group" style="max-width: 270px;">
                    <!-- Formulario de Búsqueda -->
                    <form action="estadisticas_venta.php" class="d-flex" role="search" method="POST">
                        <input type="search" id="buscar" class="form-control me-2" name="busqueda" placeholder="Buscar" aria-label="Search" />
                        <button type="submit" name="search" role="button" class="btn btn-outline-primary" value="Buscar">
                            <i class="fas fa-search"></i>
                        </button>
                    </form>
                </div>
            </div>
            <!-- Botón por si podemos desactivar varios -->
            <!-- <div class="col-3">
                <a href="">
                    <button class="btn btn-danger">
                        Desactivar Producto
                    </button>
                </a>
            </div> -->
        </div>
    </div>
    <div class="container mt-4">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <tr>
                                        <td colspan="6" class="p-3 mb-2">
                                            <h5>Informe de Ventas</h5>
                                        </td>
                                    </tr>

                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-secondary">
                                        <!-- Títulos de las columnas -->
                                        <td scope="col">ID Venta</td>
                                        <td scope="col">Nombre Cliente</td>
                                        <td scope="col">Nombre Tienda</td>
                                        <td scope="col">Marca</td>
                                        <td scope="col">Nombre Producto</td>
                                        <td scope="col">Precio</td>
                                        <td scope="col">Fecha</td>
                                    </tr>
                                    <?php
                                    if ($arreglo2 == 0) {
                                    ?>
                                        <div class="alert alert-success" role="alert">
                                            <?php echo "No hay registros" ?>
                                        </div>
                                        <?php
                                    } else {
                                        do {
                                        ?>
                                            <tr>
                                                <td><?php echo $arreglo2[0] ?></td>
                                                <td><?php echo $arreglo2[1] ?></td>
                                                <td><?php echo $arreglo2[2] ?></td>
                                                <td><?php echo $arreglo2[3] ?></td>
                                                <td><?php echo $arreglo2[4] ?></td>
                                                <td><?php echo $arreglo2[5] ?></td>
                                                <td><?php echo $arreglo2[6] ?></td>
                                            </tr>
                                    <?php
                                        } while ($arreglo2 = mysqli_fetch_array($resultado2));
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <nav class="" aria-label="paginador">
                            <ul class="pagination justify-content-center">
                                <?php
                                if ($pagina != 1) {
                                ?>
                                    <li class="page-item ">
                                        <a class="page-link" href="?pagina=<?php echo 1; ?>">
                                            <i class="fa-solid fa-backward-fast"></i>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">
                                            <i class="fa-solid fa-backward-step"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                for ($i = 1; $i <= $totalPaginas; $i++) {
                                    if ($i == $pagina) {
                                        echo '<li class="page-item active" aria-current="page">
                                                <a class="page-link" href="?pagina=' . $i . '">' . $i . '</a>
                                            </li>';
                                    } else {
                                        echo '<li class="page-item ">
                                                <a class="page-link" href="?pagina=' . $i . '">' . $i . '</a>
                                            </li>';
                                    }
                                }
                                if ($pagina != $totalPaginas) {
                                ?>

                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">
                                            <i class="fa-solid fa-forward-step"></i>
                                        </a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="?pagina=<?php echo $totalPaginas; ?>">
                                            <i class="fa-solid fa-forward-fast"></i>
                                        </a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- grafico -->
    <!-- <div class="col-9 mx-auto" style="max-width: 800px;">
        <div class="card mt-5">
            <h1 class="text-center">Estadisiticas de ventas
            </h1>
            <div id="current_date">
                <p class="text-center">
                    <script>
                        date = new Date().toLocaleDateString();
                        document.write(date);
                    </script>
                </p>
                <section class="container_grafico">
                    <div class="grafico"></div>
                    <div class="container_leyenda">
                        <span class="leyenda_all">
                            <span class="color_1"></span>
                            <p class="social">40% Acer</p>
                        </span>
                        <span class="leyenda_all">
                            <span class="color_2"></span>
                            <p class="social">30% Hp</p>
                        </span>
                        <span class="leyenda_all">
                            <span class="color_3"></span>
                            <p class="social">18% Asus</p>
                        </span>
                        <span class="leyenda_all">
                            <span class="color_4"></span>
                            <p class="social">48% MacBook</p>
                        </span>
                        <p class="social">Total 500.000 vendidos</p>
                    </div>
                </section>
            </div>
        </div>
    </div> -->


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
</body>

</html>