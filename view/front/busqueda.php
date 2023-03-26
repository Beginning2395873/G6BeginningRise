<?php
require "connect/dbconnect.php";
session_start();

// Evitar reenvío de formulario
header("Cache-Control: no-cache, must-revalidate, max-age=0");

// Capturar lo que se escribió en la barra de búsqueda
if ($_POST) {
    $busqueda = strtolower($_REQUEST['busqueda']);
}
// Conexión y consulta para el NIT
$connect = new Conexion;
$connect->conectar();
$query = $connect->conexion->prepare(
    "SELECT count(*) as totalRegistros from tiendas_productos"
);
$query->execute();
$arreglo = $query->fetch(PDO::FETCH_ASSOC);
$totalRegistros = $arreglo["totalRegistros"];
// Máximo de registros para el paginador
$maximoRegistros = 6;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = round($totalRegistros / $maximoRegistros);
// Valido que se haya ingresado algo en la barra de búsqueda
if (!empty($_POST['search'])) {
    // Para el paginador luego de buscar
    $sqlcuentaBusqueda = $connect->conexion->prepare(
        "SELECT DISTINCT count(tiendas_productos.id_producto) as totalBusqueda, 
        tiendas_productos.nit_tienda,
        tiendas.nombre_tienda,
        tiendas.foto_tienda,
        marcas.marca, 
        productos.nombre_producto, 
        tipo.tipo, 
        tiendas_productos.almacenamiento, 
        productos.procesador, 
        tiendas_productos.ram, 
        productos.pantalla, 
        productos.grafica, 
        productos.bateria, 
        tiendas_productos.precio, 
        tiendas_productos.descuento, 
        tiendas_productos.imagen, 
        tiendas_productos.estado, 
        votaciones.cantidad_votantes,
        votaciones.puntuacion_total
        FROM tiendas_productos 
        INNER JOIN tiendas ON tiendas_productos.nit_tienda = tiendas.nit_tienda
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto 
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
        INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
        INNER JOIN votaciones ON votaciones.id_producto = tiendas_productos.id_producto 
        AND votaciones.nit_tienda = tiendas_productos.nit_tienda
        WHERE tiendas_productos.id_producto like '%$busqueda%' AND tiendas_productos.estado != 0
        or marca like '%$busqueda%' AND tiendas_productos.estado != 0
        or tipo like '%$busqueda%' AND tiendas_productos.estado != 0
        or nombre_producto like '%$busqueda%' AND tiendas_productos.estado != 0
        or nombre_tienda like '%$busqueda%' AND tiendas_productos.estado != 0
        or almacenamiento like '%$busqueda%' AND tiendas_productos.estado != 0
        or ram like '%$busqueda%' AND tiendas_productos.estado != 0
        or procesador like '%$busqueda%' AND tiendas_productos.estado != 0
        or grafica like '%$busqueda%' AND tiendas_productos.estado != 0
        or pantalla like '%$busqueda%' AND tiendas_productos.estado != 0"
    );
    $sqlcuentaBusqueda->execute();
    $arregloBusqueda = $sqlcuentaBusqueda->fetch(PDO::FETCH_ASSOC);
    $totalBusqueda = $arregloBusqueda['totalBusqueda'];
    $maximoRegistrosBusqueda = 6;
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
    $totalPaginas = round($totalBusqueda / $maximoRegistrosBusqueda);
    // Traer Info luego de Buscar
    $query2 = $connect->conexion->prepare(
        "SELECT DISTINCT tiendas_productos.id_producto, 
        tiendas_productos.nit_tienda,
        tiendas.nombre_tienda,
        tiendas.foto_tienda,
        marcas.marca, 
        productos.nombre_producto, 
        tipo.tipo, 
        tiendas_productos.almacenamiento, 
        productos.procesador, 
        tiendas_productos.ram, 
        productos.pantalla, 
        productos.grafica, 
        productos.bateria, 
        tiendas_productos.precio, 
        tiendas_productos.descuento, 
        tiendas_productos.imagen, 
        tiendas_productos.estado, 
        votaciones.cantidad_votantes,
        votaciones.puntuacion_total
        FROM tiendas_productos 
        INNER JOIN tiendas ON tiendas_productos.nit_tienda = tiendas.nit_tienda
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto 
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
        INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
        INNER JOIN votaciones ON votaciones.id_producto = tiendas_productos.id_producto 
        AND votaciones.nit_tienda = tiendas_productos.nit_tienda
        WHERE tiendas_productos.id_producto like '%$busqueda%' AND tiendas_productos.estado != 0
        or marca like '%$busqueda%' AND tiendas_productos.estado != 0
        or tipo like '%$busqueda%' AND tiendas_productos.estado != 0
        or nombre_producto like '%$busqueda%' AND tiendas_productos.estado != 0
        or nombre_tienda like '%$busqueda%' AND tiendas_productos.estado != 0
        or almacenamiento like '%$busqueda%' AND tiendas_productos.estado != 0
        or ram like '%$busqueda%' AND tiendas_productos.estado != 0
        or procesador like '%$busqueda%' AND tiendas_productos.estado != 0
        or grafica like '%$busqueda%' AND tiendas_productos.estado != 0
        or pantalla like '%$busqueda%' AND tiendas_productos.estado != 0
        limit $desde,$maximoRegistros"
    );
    $query2->execute();
    $arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
} else {
    // Consulta
    $sentencia = "SELECT DISTINCT tiendas_productos.id_producto, 
    tiendas_productos.nit_tienda,
    tiendas.nombre_tienda,
    tiendas.foto_tienda,
    marcas.marca, 
    productos.nombre_producto, 
    tipo.tipo, 
    tiendas_productos.almacenamiento, 
    productos.procesador, 
    tiendas_productos.ram, 
    productos.pantalla, 
    productos.grafica, 
    productos.bateria, 
    tiendas_productos.precio, 
    tiendas_productos.descuento, 
    tiendas_productos.imagen, 
    tiendas_productos.estado,
    votaciones.cantidad_votantes,
    votaciones.puntuacion_total
    FROM tiendas_productos 
    INNER JOIN tiendas ON tiendas_productos.nit_tienda = tiendas.nit_tienda
    INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto 
    INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
    INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
    INNER JOIN votaciones ON votaciones.id_producto = tiendas_productos.id_producto 
    AND votaciones.nit_tienda = tiendas_productos.nit_tienda
    WHERE tiendas_productos.estado != 0";
    // Completar consulta
    $comp = " order by tiendas_productos.id_producto asc 
    limit $desde,$maximoRegistros";
    if (isset($_GET['comp'])) {
        $comp = $_GET['comp'];
    }
    switch ($comp) {
        case 'precioasc':
            $comp = " order by tiendas_productos.precio asc 
            limit $desde,$maximoRegistros";
            $sentencia .= $comp;
            $query2 = $connect->conexion->prepare($sentencia);
            $query2->execute();
            $arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
            break;
        case 'preciodesc':
            $comp = " order by tiendas_productos.precio desc 
            limit $desde,$maximoRegistros";
            $sentencia .= $comp;
            $query2 = $connect->conexion->prepare($sentencia);
            $query2->execute();
            $arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
            break;
        default:
            $sentencia .= $comp;
            $query2 = $connect->conexion->prepare($sentencia);
            $query2->execute();
            $arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
            break;
    }
}

// Para los filtros
// Tiendas
$sqlF = "SELECT tiendas.nombre_tienda FROM tiendas";
$queryF = $connect->conexion->prepare($sqlF);
$queryF->execute();
$resultadoF = $queryF->fetchAll(PDO::FETCH_ASSOC);
// Marcas
$sqlM = "SELECT marcas.marca FROM marcas";
$queryM = $connect->conexion->prepare($sqlM);
$queryM->execute();
$resultadoM = $queryM->fetchAll(PDO::FETCH_ASSOC);
?>

<?php require "view/layouts/header.php" ?>

<div class="container-fluid">
    <div class="row d-flex justify-content-center">
        <div class="col" style="max-width: 300px; min-width: 250px;">
            <!-- Acordeon -->
            <div class="accordion mt-5" id="accordionFlushExample">
                <div class="accordion-item">
                    <h4 class="text-center fw-semibold py-1">
                        Filtros
                    </h4>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Tienda
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                        <?php foreach ($resultadoF as $tienda) { ?>
                            <div class="accordion-body">
                                <form class="filtro" action="?page=buscar" method="POST">
                                    <input type="hidden" name="busqueda" value="<?php echo $tienda['nombre_tienda'] ?>">
                                    <input type="hidden" name="search" value="<?php echo $tienda['nombre_tienda'] ?>">
                                    <input type="submit" class="list-group-item" value="<?php echo $tienda['nombre_tienda'] ?>">
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                            Marca
                        </button>
                    </h2>
                    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                        <?php foreach ($resultadoM as $marca) { ?>
                            <div class="accordion-body">
                                <form class="filtro" action="?page=buscar" method="POST">
                                    <input type="hidden" name="busqueda" value="<?php echo $marca['marca'] ?>">
                                    <input type="hidden" name="search" value="<?php echo $marca['marca'] ?>">
                                    <input type="submit" class="list-group-item" value="<?php echo $marca['marca'] ?>">
                                </form>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingthree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsethree" aria-expanded="false" aria-controls="flush-collapsethree">
                            Tipo de almacenamiento
                        </button>
                    </h2>
                    <div id="flush-collapsethree" class="accordion-collapse collapse" aria-labelledby="flush-headingthree" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="HDD">
                                <input type="hidden" name="search" value="HDD">
                                <input type="submit" class="list-group-item" value="HDD">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="SSD">
                                <input type="hidden" name="search" value="SSD">
                                <input type="submit" class="list-group-item" value="SSD">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="NVMe">
                                <input type="hidden" name="search" value="NVMe">
                                <input type="submit" class="list-group-item" value="NVMe">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingfour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefour" aria-expanded="false" aria-controls="flush-collapsefour">
                            Capacidad de almacenamiento
                        </button>
                    </h2>
                    <div id="flush-collapsefour" class="accordion-collapse collapse" aria-labelledby="flush-headingfour" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="120GB">
                                <input type="hidden" name="search" value="120GB">
                                <input type="submit" class="list-group-item" value="≈120 GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="250GB">
                                <input type="hidden" name="search" value="240GB">
                                <input type="submit" class="list-group-item" value="≈250 GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="500GB">
                                <input type="hidden" name="search" value="480GB">
                                <input type="submit" class="list-group-item" value="≈500 GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="1TB">
                                <input type="hidden" name="search" value="1TB">
                                <input type="submit" class="list-group-item" value="≈1 TB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="2TB">
                                <input type="hidden" name="search" value="2TB">
                                <input type="submit" class="list-group-item" value="≈2 TB">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingfive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsefive" aria-expanded="false" aria-controls="flush-collapsefive">
                            Memoria RAM
                        </button>
                    </h2>
                    <div id="flush-collapsefive" class="accordion-collapse collapse" aria-labelledby="flush-headingfive" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="4GB">
                                <input type="hidden" name="search" value="4GB RAM">
                                <input type="submit" class="list-group-item" value="4GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="8GB">
                                <input type="hidden" name="search" value="8GB RAM">
                                <input type="submit" class="list-group-item" value="8GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="16GB">
                                <input type="hidden" name="search" value="16GB RAM">
                                <input type="submit" class="list-group-item" value="16GB">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="32GB">
                                <input type="hidden" name="search" value="32GB RAM">
                                <input type="submit" class="list-group-item" value="32GB">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingsix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsesix" aria-expanded="false" aria-controls="flush-collapsesix">
                            Procesador
                        </button>
                    </h2>
                    <div id="flush-collapsesix" class="accordion-collapse collapse" aria-labelledby="flush-headingsix" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="AMD">
                                <input type="hidden" name="search" value="AMD">
                                <input type="submit" class="list-group-item" value="AMD">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="Intel">
                                <input type="hidden" name="search" value="Intel">
                                <input type="submit" class="list-group-item" value="Intel">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingseven">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseseven" aria-expanded="false" aria-controls="flush-collapseseven">
                            Tarjeta gráfica
                        </button>
                    </h2>
                    <div id="flush-collapseseven" class="accordion-collapse collapse" aria-labelledby="flush-headingseven" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="NVIDIA">
                                <input type="hidden" name="search" value="NVIDIA">
                                <input type="submit" class="list-group-item" value="Dedicada NVIDIA">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="Intel U">
                                <input type="hidden" name="search" value="Intel UHD">
                                <input type="submit" class="list-group-item" value="Integrada Intel UHD/UMA">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="Intel Iris">
                                <input type="hidden" name="search" value="Intel Iris">
                                <input type="submit" class="list-group-item" value="Integrada Intel Iris">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="Radeon Vega">
                                <input type="hidden" name="search" value="Radeon Vega">
                                <input type="submit" class="list-group-item" value="Integrada AMD">
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value="Radeon RX">
                                <input type="hidden" name="search" value="Radeon RX">
                                <input type="submit" class="list-group-item" value="Dedicada AMD">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingeight">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseeight" aria-expanded="false" aria-controls="flush-collapseeight">
                            Pantalla
                        </button>
                    </h2>

                    <div id="flush-collapseeight" class="accordion-collapse collapse" aria-labelledby="flush-headingeight" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value='14"'>
                                <input type="hidden" name="search" value="14">
                                <input type="submit" class="list-group-item" value='14"'>
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value='15.6"'>
                                <input type="hidden" name="search" value="15.6">
                                <input type="submit" class="list-group-item" value='15.6"'>
                            </form>
                        </div>
                        <div class="accordion-body">
                            <form class="filtro" action="?page=buscar" method="POST">
                                <input type="hidden" name="busqueda" value='17.3"'>
                                <input type="hidden" name="search" value="17.3">
                                <input type="submit" class="list-group-item" value='17.3"'>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingnine">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapsenine" aria-expanded="false" aria-controls="flush-collapsenine">
                            Precio
                        </button>
                    </h2>
                    <div id="flush-collapsenine" class="accordion-collapse collapse" aria-labelledby="flush-headingnine" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <a class="text-decoration-none text-dark" href="?page=buscar&comp=precioasc">
                                Ascendente
                            </a>
                        </div>
                        <div class="accordion-body">
                            <a class="text-decoration-none text-dark" href="?page=buscar&comp=preciodesc">
                                Descendente
                            </a>
                        </div>
                    </div>
                </div>
                <!-- <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingten">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseten" aria-expanded="false" aria-controls="flush-collapseten">
                            Calificacion
                        </button>
                    </h2>
                    <div id="flush-collapseten" class="accordion-collapse collapse" aria-labelledby="flush-headingten" data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">Mejor Calificadas</div>
                        <div class="accordion-body">Número de Reseñas</div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="col">
            <form action="?page=comparar" method="POST">
                <div class="mx-auto mt-3 mb-3" style="max-width: 201px">
                    <input type="submit" value="Comparar Seleccionados" class="btn btn-primary">
                </div>
                <div class="row d-flex justify-content-evenly">
                    <?php
                    if ($arreglo2 == 0) {
                    ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo "Ningún producto coincide con su búsqueda" ?>
                        </div>
                        <?php
                    } else {
                        $puesto = 1;
                        do {
                            // Estado
                            $stauts = '';
                            if ($arreglo2['estado'] == 0) {
                                $status = 'Inactivo';
                            } else if ($arreglo2['estado'] == 2) {
                                $status = 'En Oferta';
                            } else {
                                $status = 'Activo';
                            }

                            // Descuento
                            $price = $arreglo2['precio'];
                            $discount = $arreglo2['descuento'];
                            if ($discount != 0) {
                                $oferta = $price - ceil(($price * $discount / 100));
                            }

                        ?>
                            <div class="col mb-5" style="max-width: 300px;">
                                <div class="card shadow-sm" style="width: 18rem;">
                                    <div class="card-header text-center">
                                        <div class="d-flex justify-content-center">
                                            <img class="rounded-circle me-2" height="45px" src="<?php echo $arreglo2['foto_tienda'] ?>" alt="<?php echo $arreglo2['nombre_tienda'] ?>">
                                            <span class="my-auto fw-semibold fs-3 text-dark"><?php echo $arreglo2['nombre_tienda'] ?></span>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="text-center" ">
                                            <img src=" <?php echo $arreglo2['imagen'] ?>" alt="imagen" width="200" height="200">
                                        </div>
                                        <h4 class="card-title" style="color:rgb(197, 23, 23);"><?php echo $arreglo2['marca'] ?></h4>
                                        <h5 class="card-title" style="color:black; height:50px"><?php echo $arreglo2['nombre_producto'] ?></h5>
                                        <!-- Codigo para las estrellas -->
                                        <div class="estrellas">
                                            <?php
                                            $totalVotos = $arreglo2['cantidad_votantes'];
                                            $puntos =  $arreglo2['puntuacion_total'];
                                            if ($totalVotos > 0) {
                                                $promedio = round(($puntos / $totalVotos), 2);
                                            } else {
                                                $promedio = 0;
                                            }
                                            // Ciclo para mostrar estrellas
                                            for ($e = 1; $e <= 5; $e++) {
                                                if ($e <= intval($promedio)) {
                                                    // Si está por debajo del promedio, sale dorada
                                                    $clase_css_estrella = 'estrella_dorada';
                                                } else {
                                                    // De lo contrario, sale normal
                                                    $clase_css_estrella = 'estrella_normal';
                                                }
                                                // Me va imprimiendo las estrellas
                                                echo '<span class="' . $clase_css_estrella . '" onclick="voto()">
                                                            <i class ="fa fa-star"></i>
                                                        </span>';
                                            }
                                            ?>
                                            <span class="text-dark fw-semibold"><?php echo $promedio ?></span>
                                            <span class="text-secondary fs-6">(<i class="fa fa-user me-2"></i><?php echo $totalVotos ?>)</span>
                                        </div>
                                        <p>
                                        <ul class="list-group">
                                            <li>
                                                <i class="fa-sharp fa-solid fa-microchip me-2"></i><span class="fw-semibold"><?php echo $arreglo2['procesador'] ?></span>
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-hard-drive me-2"></i><span class="fw-semibold"><?php echo $arreglo2['almacenamiento'] ?></span>
                                            </li>
                                            <li>
                                                <i class="fa-solid fa-memory me-2"></i><span class="fw-semibold"><?php echo $arreglo2['ram'] ?></span>
                                        </ul>
                                        </p>
                                        <!-- Mostrar Descuento -->
                                        <?php if ($arreglo2['descuento'] > 0) { ?>

                                            <p class="card_text text-secondary">
                                                <span class="text-decoration-line-through fs-6">
                                                    <?php echo "$", number_format($arreglo2['precio']) ?>
                                                </span>
                                                <br>
                                                <span class="fs-5 fw-bold text-success">
                                                    $<?php echo number_format($oferta) ?>
                                                </span>
                                                <span class="fs-5 fw-bold" style="color:rgb(197, 23, 23);">
                                                    -<?php echo $discount ?>%
                                                </span>
                                            </p>
                                        <?php } else { ?>
                                            <p class="card_text text-success fw-bold fs-5" style="height: 55px;"><?php echo "$", number_format($arreglo2['precio']) ?></p>
                                        <?php } ?>
                                    </div>
                                    <div class="card-footer d-flex">
                                        <div class="col-6 me-3">
                                            <a href='?page=login&msg=Debe Iniciar Sesión para activar su carrito de compras' class='btn btn-success addCart' onClick='alertaAddCart()'>
                                                <i class='fa-solid fa-cart-shopping me-2'></i>Añadir al Carrito
                                            </a>
                                        </div>
                                        <div class="col-6 my-auto">
                                            <input class="form-check-input" name="productos[<?php echo $puesto ?>]" type="checkbox" value="<?php echo $arreglo2['id_producto'] ?>">
                                            <input type="hidden" name="nits[<?php echo $puesto ?>]" value="<?php echo $arreglo2['nit_tienda'] ?>">
                                            <label class="form-check-label text-dark fw-semibold" for="productos[<?php echo $puesto ?>]">
                                                Comparar
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    <?php
                            $puesto = $puesto + 1;
                        } while ($arreglo2 = $query2->fetch());
                    }
                    ?>
                </div>
            </form>
            <nav class="mt-5" aria-label="paginador">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pagina != 1) {
                        if (isset($_GET['comp'])) {
                            $comp = $_GET['comp'];
                    ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo urlsite ?>?page=buscar&comp=<?php echo $comp ?>&pagina=<?php echo 1; ?>">
                                    <i class="fa-solid fa-backward-fast my-1"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=buscar&comp=<?php echo $comp ?>&pagina=<?php echo $pagina - 1; ?>">
                                <i class="fa-solid fa-backward-step my-1"></i>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="page-item ">
                                <a class="page-link" href="?page=buscar&pagina=<?php echo 1 ?>">
                                    <i class="fa-solid fa-backward-step my-1"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=buscar&pagina=<?php echo $pagina - 1 ?>">
                                    <i class="fa-solid fa-backward-step my-1"></i>
                                </a>
                            </li>
                        <?php
                        }
                    }
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        if ($i == $pagina) {
                            if (isset($_GET['comp'])) {
                                $comp = $_GET['comp'];
                                echo '
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="?page=buscar&comp=' . $comp . '&pagina=' . $i . '">
                                                ' . $i . '
                                            </a>
                                        </li>';
                            } else {
                                echo '
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="?page=buscar&pagina=' . $i . '">
                                                ' . $i . '
                                            </a>
                                        </li>';
                            }
                        } else {
                            if (isset($_GET['comp'])) {
                                $comp = $_GET['comp'];
                                echo '<li class="page-item ">
                                        <a class="page-link" href="?page=buscar&comp=' . $comp . '&pagina=' . $i . '">
                                            ' . $i . '
                                        </a>
                                    </li>';
                            } else {
                                echo '<li class="page-item ">
                                        <a class="page-link" href="?page=buscar&pagina=' . $i . '">
                                            ' . $i . '
                                        </a>
                                    </li>';
                            }
                            
                        }
                    }
                    if ($pagina != $totalPaginas) {
                        if (isset($_GET['comp'])) {
                            $comp = $_GET['comp'];
                        ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo urlsite ?>?page=buscar&comp=<?php echo $comp ?>&pagina=<?php echo $pagina + 1; ?>">
                                    <i class="fa-solid fa-forward-step my-1"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=buscar&comp=<?php echo $comp ?>&pagina=<?php echo $totalPaginas; ?>">
                                    <i class="fa-solid fa-forward-fast my-1"></i>
                                </a>
                            </li>
                        <?php } else { ?>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo urlsite ?>?page=buscar&pagina=<?php echo $pagina + 1; ?>">
                                    <i class="fa-solid fa-forward-step my-1"></i>
                                </a>
                            </li>
                            <li class="page-item">
                                <a class="page-link" href="?page=buscar&pagina=<?php echo $totalPaginas; ?>">
                                    <i class="fa-solid fa-forward-fast my-1"></i>
                                </a>
                            </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>