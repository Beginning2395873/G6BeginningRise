<?php
session_start();
if (!isset($_SESSION['login'])) {
    session_destroy();
}

require "connect/dbconnect.php";

if (!empty($_POST['maxRegistros'])) {
    $maxRegistros = $_POST['maxRegistros'];
} else {
    $maxRegistros = 4;
}

$connect = new Conexion();
$connect->conectar();
// Todas los registros de la tabla
$query = $connect->conexion->query("SELECT * FROM tiendas WHERE tiendas.banner_prom IS NOT NULL");
$arreglo = $query->fetch(PDO::FETCH_ASSOC);
$slide_to = 0;
$aria_label = 1;

// Consulta para contar registros con oferta
$sqlRegistros = $connect->conexion->query(
    "SELECT count(tiendas_productos.id_producto) as totalRegistros
    FROM tiendas_productos
    WHERE tiendas_productos.descuento > 0
    AND tiendas_productos.estado != 0"
);
$arreglo1 = $sqlRegistros->fetch(PDO::FETCH_ASSOC);
$totalRegistros = $arreglo1['totalRegistros'];
// Consulta para las tarjetas
$sqlCard = $connect->conexion->query(
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
    WHERE tiendas_productos.descuento > 0
    AND tiendas_productos.estado != 0
    ORDER BY tiendas_productos.descuento DESC
    LIMIT $maxRegistros"
);
$arreglo2 = $sqlCard->fetch(PDO::FETCH_ASSOC);


?>
<?php require "view/layouts/header.php" ?>

<!-- carrusel -->
<div class="container-fluid text-dark rounded mt-4">
    <div class="row d-flex justify-content-center">
        <div class="col mx-auto" style="max-width: 95%;">
            <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
                <span class="border-dark">
                    <div id="carouselBasicExample" class="carousel slide carousel-fade " data-mdb-ride="carousel">
                        <!-- indicadores -->
                        <!-- carrusel cuerpo -->
                        <div class="carousel-inner rounded">
                            <!-- Primer Registro -->
                            <div class="carousel-item active">
                                <img src="<?php echo $arreglo['banner_prom'] ?>" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="1" focusable="true" width="980" height="513">
                            </div>
                            <!-- Ciclo para el resto -->
                            <?php foreach ($query as $opciones) { ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $opciones['banner_prom'] ?>" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="2" focusable="false" width="980" height="513">
                                </div>
                            <?php } ?>
                            <!-- botones -->
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"> </span>
                        </button>
                    </div>
            </div>
        </div>
    </div>
    <div class="card mx-auto my-2" style="max-width: 95%;">
        <h3 class="rounded text-center text-light mt-3 px-3 py-2 mx-auto fs-2 bg-success">
            ¡Ofertas Destacadas!
        </h3>
        <div class="row mt-4 d-flex justify-content-center" id="listaOfertas">
            <?php if ($arreglo2 != false) {
                do {
                    $puesto = 1;
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
                                        $promedio = round(($puntos / $totalVotos), 1);
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
                                    <p class="card_text text-success fw-semibold" style="height: 55px;"><?php echo "$", number_format($arreglo2['precio']) ?></p>
                                <?php } ?>
                            </div>
                            <div class="card-footer">
                                <div class="col mx-auto" style="max-width: 168px;">
                                    <a href='?page=login&msg=Debe Iniciar Sesión para activar su carrito de compras' class='btn btn-success addCart'>
                                        <i class='fa-solid fa-cart-shopping me-2'></i>Añadir al Carrito
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    $puesto = $puesto + 1;
                } while ($arreglo2 = $sqlCard->fetch(PDO::FETCH_ASSOC));
                if ($totalRegistros > $maxRegistros) {
                    $maxRegistros = $maxRegistros + 4;
                ?>
                    <div class="row text-center mb-3">
                        <form action="#vermas" method="POST">
                            <input type="hidden" name="maxRegistros" value="<?php echo $maxRegistros ?>">
                            <button id="vermas" type="submit" style="max-width: 120px;" class="mx-auto btn btn-success btn-lg"> ↓ Ver más</button>
                        </form>
                    </div>
                <?php } else { ?>
                    <div class="row text-center mb-3 px-4">
                        <div class="alert alert-info" id="vermas">
                            No hay más ofertas
                        </div>
                    </div>
            <?php }
            }
            ?>
        </div>
    </div>
</div>



<?php require "view/layouts/footer.php" ?>