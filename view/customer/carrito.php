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

$envio = 9500;
$dolar = 4800;
$con = new Conexion;
$con->conectar();
$query = $con->conexion->query(
    "SELECT carrito_productos.id_producto,
    carrito_productos.email_cliente,
    carrito_productos.nit_tienda,
    tiendas_productos.imagen,
    productos.nombre_producto,
    marcas.marca,
    tiendas_productos.precio,
    tiendas_productos.descuento,
    carrito_productos.cantidad
    FROM carrito_productos
    INNER JOIN tiendas_productos ON carrito_productos.id_producto = tiendas_productos.id_producto
    INNER JOIN productos ON carrito_productos.id_producto = productos.id_producto
    INNER JOIN marcas ON productos.id_marca = marcas.id_marca
    WHERE carrito_productos.email_cliente = '$user'
    and tiendas_productos.estado != 0
    "
);
$arreglo = $query->fetch();
?>
<?php require "view/layouts/headerC.php" ?>

<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <h3 class="fw-bold">
                    <i class="fa-solid fa-cart-shopping me-2"></i>
                    Carrito de Compras
                </h3>
                <table class="table border">
                    <tr>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col"></th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Imagen</th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Producto</th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Precio</th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Descuento</th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Cantidad</th>
                        <th class="fs-5 fw-semibold text-muted text-center" scope="col">Eliminar</th>
                    </tr>
                    <?php if ($arreglo == 0) { ?>
                        <div class="alert alert-success" role="alert">
                            <?php echo "No hay productos en el carrito" ?>
                        </div>
                        <?php } else {
                        $sub = 0;
                        $cart = 0;
                        do {
                            // idProducto, email, nit, imagen, nombre, marca, precio, descuento
                            $price = $arreglo[6];
                            $discount = $arreglo[7];
                            $cant = $arreglo[8];
                            if ($discount != 0) {
                                $oferta = $price - ceil(($price * $discount / 100));
                                $item = ($sub + $oferta) * $cant;
                            } else {
                                $oferta = $price;
                                $item = ($sub + $oferta) * $cant;
                            }
                            $cart = $cart + $item;
                        ?>
                            <tr>
                                <td class="text-center"></td>
                                <td class="text-center"><img src="<?php echo $arreglo[3] ?>" alt="imagen" width="80px"></td>
                                <td class="fs-5 fw-semibold text-center"><?php echo $arreglo[5] ?> <?php echo $arreglo[4] ?></td>
                                <td class="fs-5 fw-semibold text-center">$<?php echo number_format($oferta) ?></td>
                                <td class="fs-5 fw-semibold text-center"><?php echo $discount ?>%</td>
                                <td class="fs-5 fw-semibold text-center">
                                    <div class="d-flex justify-content-center">
                                        <form action="?page=cliente&opcion=reducirItem" method="POST">
                                            <input type='hidden' id='email' name='email' value='<?php echo $user ?>' />
                                            <input type='hidden' id='idProducto' name='idProducto' value='<?php echo $arreglo[0] ?>' />
                                            <input type='hidden' id='nitTienda' name='nitTienda' value='<?php echo $arreglo[2] ?>' />
                                            <input class="btn btn-sm btn-outline-danger" type="submit" value="-">
                                        </form>
                                        <span class="px-2"><?php echo $arreglo[8] ?></span>
                                        <form action="?page=cliente&opcion=aumentarItem" method="POST">
                                            <input type='hidden' id='email' name='email' value='<?php echo $user ?>' />
                                            <input type='hidden' id='idProducto' name='idProducto' value='<?php echo $arreglo[0] ?>' />
                                            <input type='hidden' id='nitTienda' name='nitTienda' value='<?php echo $arreglo[2] ?>' />
                                            <input class="btn btn-sm btn-outline-success" type="submit" value="+">
                                        </form>
                                    </div>
                                </td>
                                <td class="fs-5 fw-semibold text-center">
                                    <?php echo "
                                        <form class='dropCart' id='dropCart' action='" . urlsite . "?page=cliente&opcion=dropCart' method='POST'>
                                            <input type='hidden' id='email' name='email' value='$user' />
                                            <input type='hidden' id='idProducto' name='idProducto' value='$arreglo[0]' />
                                            <input type='hidden' id='nitTienda' name='nitTienda' value='$arreglo[2]' />
                                            <button style='color: #FF0000' type='submit' name='eliminar' class='btn' onClick='alertaDropCart()' >
                                                <i class='fa-solid fa-circle-xmark fa-xl'></i>
                                            </button>
                                        </form>" ?>
                                </td>
                            </tr>

                    <?php
                        } while ($arreglo = $query->fetch());
                    } ?>
                </table>
            </div>
            <div class="table-responsive">
                <table class="table border">
                    <tr>
                        <th class="fs-5 fw-semibold" scope="col">
                            <span class="text-muted">
                                Subtotal:
                            </span> $<?php if (isset($cart)) {
                                            echo number_format($cart);
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                        </th>
                        </th>
                        <th class="fs-5 fw-semibold" scope="col">
                            <span class="text-muted">
                                Envío:
                            </span>$<?php
                                    if (isset($envio)) {
                                        echo number_format($envio);
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                        </th>
                        <th class="fs-5 fw-semibold" scope="col">
                            <span class="text-muted">
                                Total:
                            </span>$<?php
                                    if (isset($cart)) {
                                        $total = $cart + $envio;
                                        echo number_format($total);
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                        </th>
                        <th class="fs-5 fw-semibold" scope="col">
                            <span class="text-muted">
                                Total paypal USD:
                            </span>$<?php
                                    if (isset($total)) {
                                        $totalpay = intdiv($total, $dolar);
                                        echo round($totalpay);
                                    } else {
                                        echo "-";
                                    }
                                    ?>
                        </th>
                    </tr>
                </table>
            </div>
            <div class="text-center">
                <div class="row d-flex justify-content-center">
                        <div class="col-2">
                            <a href="?page=cliente" class="btn btn-outline-danger me-2 btn-lg">
                                <i class="fa-solid fa-xmark me-2"></i>
                                Cancelar
                            </a>
                        </div>
                        <div class="col-3">
                            <a href="?page=cliente&opcion=detallesCompra" class="btn btn-outline-success me-2 btn-lg">
                                <i class="fa-solid fa-wallet me-2"></i>
                                Proceder al Pago
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>