<?php
include "../connect/config.php";

if ($_POST) {
    $obj->busqueda = strtolower($_REQUEST['busqueda']);
}
$connect = new Conexion();
$c = $connect->conectando();
$query = "SELECT count(*) as totalRegistros from productos where estado != 0";
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

if (!empty($_POST['search'])) {
    // Para el paginador luego de buscar
    $sqlcuentaBusqueda = "SELECT count(productos.id_producto) as totalBusqueda, marcas.marca, productos.nombre_producto, tipo.tipo, productos.almacenamiento, productos.procesador, productos.ram, productos.pantalla, productos.grafica, productos.bateria, productos.precio, productos.imagen, productos.estado FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo where id_producto like '%$obj->busqueda%' or marca like '%$obj->busqueda%' or tipo like '%$obj->busqueda%' or nombre_producto like '%$obj->busqueda%' and productos.estado != 0";
    $resultadoBusqueda = mysqli_query($c, $sqlcuentaBusqueda);
    $arregloBusqueda = mysqli_fetch_array($resultadoBusqueda);
    $totalBusqueda = $arregloBusqueda['totalBusqueda'];

    $maximoRegistrosBusqueda = 5;
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
    $totalPaginas = ceil($totalBusqueda / $maximoRegistrosBusqueda);

    $query2 = "SELECT productos.id_producto, marcas.marca, productos.nombre_producto, tipo.tipo, productos.almacenamiento, productos.procesador, productos.ram, productos.pantalla, productos.grafica, productos.bateria, productos.precio, productos.imagen, productos.estado FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo where id_producto like '%$obj->busqueda%' or marca like '%$obj->busqueda%' or tipo like '%$obj->busqueda%' or nombre_producto like '%$obj->busqueda%' and productos.estado != 0 order by productos.id_producto asc limit $desde,$maximoRegistros";
    $resultado2 = mysqli_query($c, $query2);
    $arreglo2 = mysqli_fetch_array($resultado2);
} else {
    $query2 = "SELECT productos.id_producto, marcas.marca, productos.nombre_producto, tipo.tipo, productos.almacenamiento, productos.procesador, productos.ram, productos.pantalla, productos.grafica, productos.bateria, productos.precio, productos.imagen, productos.estado FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo where productos.estado != 0 order by productos.id_producto asc limit $desde,$maximoRegistros";
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
                <div class="input-group d-flex" style="max-width: 400px;">
                    <!-- Búsqueda -->
                    <form action="verproductos.php" class="d-flex" role="search" method="POST">
                        <input type="search" id="buscar" class="form-control me-2" name="busqueda" placeholder="Buscar Producto" aria-label="Search" />
                        <button type="submit" name="search" role="button" class="btn btn-outline-primary me-2" value="Buscar"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="verproductos.php" class="btn btn-outline-warning ms-2">
                        <i class="fa-solid fa-list"></i>
                        Listar
                    </a>
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
                                            <h5>Lista de Productos</h5>
                                        </td>
                                    </tr>

                                    </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="table-secondary">
                                        <!-- Títulos de las columnas -->
                                        <td scope="col">ID Producto</td>
                                        <td scope="col">Marca</td>
                                        <td scope="col">Nombre del Producto</td>
                                        <td scope="col">Tipo </td>
                                        <td scope="col">Almacenamiento</td>
                                        <td scope="col">CPU</td>
                                        <td scope="col">RAM</td>
                                        <td scope="col">Pantalla</td>
                                        <td scope="col">GPU</td>
                                        <td scope="col">Bateria</td>
                                        <td scope="col">Precio</td>
                                        <td scope="col">Imagen</td>
                                        <td scope="col">Estado</td>
                                        <td scope="col">Modificar</td>
                                        <td scope="col">Eliminar</td>
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
                                            // Estado
                                            $stauts = '';
                                            if ($arreglo2[12] == 0) {
                                                $status = 'Inactivo';
                                            } else if ($arreglo2[12] == 2) {
                                                $status = 'En Oferta';
                                            } else {
                                                $status = 'Activo';
                                            }
                                        ?>
                                            <tr>
                                                <td><?php echo $arreglo2[0] ?></td>
                                                <td><?php echo $arreglo2[1] ?></td>
                                                <td><?php echo $arreglo2[2] ?></td>
                                                <td><?php echo $arreglo2[3] ?></td>
                                                <td><?php echo $arreglo2[4] ?></td>
                                                <td><?php echo $arreglo2[5] ?></td>
                                                <td><?php echo $arreglo2[6] ?></td>
                                                <td><?php echo $arreglo2[7] ?></td>
                                                <td><?php echo $arreglo2[8] ?></td>
                                                <td><?php echo $arreglo2[9] ?></td>
                                                <td><?php echo $arreglo2[10] ?></td>
                                                <td><img src="<?php echo $arreglo2[11] ?>" alt="imagen" width="80px"></td>
                                                <td><?php echo $status ?></td>
                                                <td><?php echo "<a href='editar_productos.php?id_producto=" . $arreglo2[0] . "''><button type='button' class='btn btn-primary'><i class='fa-solid fa-pen-to-square'></i></button></a>" ?></td>
                                                <td><?php echo "<form action='../controller/productoControlador.php' method='POST'>
                                                <input type='hidden' name='idProducto' value='$arreglo2[0]' />
                                                <button type='submit' name='eliminar' class='btn btn-danger'><i class='fa-solid fa-trash-can'></i></button>
                                            </form>" ?></td>
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
                                        echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                                    } else {
                                        echo '<li class="page-item "><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
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