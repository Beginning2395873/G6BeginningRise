<?php
session_start();
// Capturo el correo para futuras consultas
$_SESSION['inicio'] = time();
$sestime = 30000;
if (isset($_SESSION['inicio']) && time() - $_SESSION['inicio'] > $sestime ) {
    header('Location: ?page=logout');
}

if (isset($_SESSION['login'])) {
    $user = $_SESSION['login'];
} else {
    header("Location: ?page=logout");
}

// Conexión y consulta para total de registros
$connect = new Conexion();
$connect->conectar();

// Conexión y consulta para el NIT
$connect = new Conexion();
$connect->conectar();
$queryid = $connect->conexion->prepare(
    "SELECT * FROM tiendas WHERE email_tienda = '$user'"
);
$queryid->execute();
$resid = $queryid->fetch();
// Almaceno NIT para futuras consultas
$nit = $resid[0];
$query = $connect->conexion->prepare(
    "SELECT count(*) as totalRegistros from ventas_productos WHERE nit_tienda = '$nit'"
);
$query->execute();
$arreglo = $query->fetch(PDO::FETCH_ASSOC);

// Consulta
$query2 = $connect->conexion->prepare(
    // id, cliente, email cliente, tienda, marca, nombre producto, precio, fecha
    "SELECT ventas.id_venta,
    persona.nombre_persona,
    ventas.email_cliente,
    ventas_productos.nit_tienda,
    tiendas.nombre_tienda,
    tiendas.email_tienda,
    marcas.marca,
    productos.id_producto,
    productos.nombre_producto,
    tiendas_productos.precio,
    tiendas_productos.descuento,
    ventas.fecha
    FROM ventas
    INNER JOIN persona ON ventas.email_cliente = persona.email_persona
    INNER JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta
    INNER JOIN tiendas ON ventas_productos.nit_tienda = tiendas.nit_tienda
    INNER JOIN tiendas_productos ON ventas_productos.nit_tienda = tiendas_productos.nit_tienda 
    AND ventas_productos.id_producto = tiendas_productos.id_producto
    INNER JOIN productos ON ventas_productos.id_producto = productos.id_producto
    INNER JOIN marcas ON productos.id_marca = marcas.id_marca
    -- Buscar por id venta, nombre cliente, marca, nombre producto
    WHERE ventas_productos.nit_tienda = '$nit'"
);
$query2->execute();
$arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
?>

<?php require "view/layouts/headerT.php" ?>

<div class="container-fluid my-4">
    <div class="row d-flex justify-content-center">
        <div class="rounded col-sm-11 col-md-11 col-lg-11 col-xl-11 bg-white">
            <div class="my-2">
                <h3 class="text-center my-3">Informe Total de Ventas</h3>
                <!-- Botones -->
                <div class="row d-flex justify-content-start">
                    <!-- Regresar -->
                    <div class="col" style="max-width: 140px;">
                        <a onclick="window.history.back();" class="btn btn-dark my-2">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                            Regresar
                        </a>
                    </div>
                    <!-- Listar -->
                    <div class="col" style="max-width: 120px;">
                        <a href="" class="btn btn-secondary my-2">
                            <i class="fa-solid fa-list me-2"></i>
                            Listar
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive px-2 mb-4">
                <table class="table table-hover align-middle" id="myTable">
                    <thead class="table-secondary">
                    <!-- id, nombre persona, correo cliente, nit tienda, nombre tienda, correo tienda, marca, nombre producto, precio, descuento, fecha -->
                        <tr>
                            <th>ID_Venta</th>
                            <th>Nombre Comprador</th>
                            <th>Correo Comprador</th>
                            <th>NIT Empresa</th>
                            <th>Marca</th>
                            <th>Nombre Producto</th>
                            <th>Precio</th>
                            <th>Descuento</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($arreglo2 === false) { ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo "No hay registros" ?>
                            </div>
                            <?php } else {
                            do {
                                // Descuento
                                $price = $arreglo2['precio'];
                                $discount = $arreglo2['descuento'];
                                if ($discount != 0) {
                                    $oferta = $price - ceil(($price * $discount / 100));
                                    $class = "text-success fw-semibold";
                                } else {
                                    $oferta = $price;
                                    $class = "text-dark fw-semibold";
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $arreglo2['id_venta'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nombre_persona'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['email_cliente'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nit_tienda'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['marca'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nombre_producto'] ?>
                                    </td>
                                    <td>
                                        <span class="<?php echo $class ?>">
                                            $<?php echo number_format($oferta) ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $discount ?>%
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['fecha'] ?>
                                    </td>
                                </tr>
                        <?php } while ($arreglo2 = $query2->fetch(PDO::FETCH_ASSOC));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>