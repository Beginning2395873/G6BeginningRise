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
$arreglo = $query->fetch(PDO::FETCH_ASSOC);
if ($arreglo != false) {
    $email = $arreglo['email_cliente'];
}

?>

<?php require 'view/layouts/headerC.php' ?>
<div class="container-flex">
    <div class="card mt-4 mx-4">
        <div class="col ms-4 mt-4">
            <a href="?page=cliente&opcion=carrito" class="btn btn-dark me-2 btn-lg">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Regresar
            </a>
        </div>
        <div class="row d-flex justify-content-evenly">
            <div class="col-4 my-auto d-flex">
                <img src="<?php echo urlsite ?>/config/img/icon.png" alt="logo" height="100" width="100">
                <h2 class="ms-2 fs-1">Detalles de pago</h2>
            </div>
            <div class="col-8 px-2">
                <div class="table-responsive mt-5 px-2">
                    <table class="table table-sm table-hover mt-5">
                        <thead class="table-secondary">
                            <tr>
                                <th>Imagen</th>
                                <th>Producto</th>
                                <th>Cantidad</th>
                                <th>Subtotal COP</th>
                                <th>Subtotal USD</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php if ($arreglo != 0) {
                                $subCOP = 0;
                                $totalCOP = 0;
                                $subUSD = 0;
                                $totalUSD = 0;
                                do {

                                    $price = $arreglo['precio'];
                                    $discount = $arreglo['descuento'];
                                    $cant = $arreglo['cantidad'];
                                    if ($discount != 0) {
                                        $oferta = $price - ceil(($price * $discount / 100));
                                        $item = ($subCOP + $oferta) * $cant;
                                        $itemUSD = intdiv($item, $dolar);
                                    } else {
                                        $oferta = $price;
                                        $item = ($subCOP + $oferta) * $cant;
                                        $itemUSD = intdiv($item, $dolar);
                                    }
                                    $totalCOP = $totalCOP + $item;
                                    $totalUSD = $totalUSD + $itemUSD;
                            ?>
                                    <tr>
                                        <td class="text-center">
                                            <img src="<?php echo $arreglo['imagen'] ?>" alt="imagen" width="90" height="90">
                                        </td>
                                        <td class="fw-semibold">
                                            <?php echo $arreglo['marca'] . ' ' . $arreglo['nombre_producto'] ?>
                                        </td>
                                        <td class="text-center">
                                            <?php echo $arreglo['cantidad'] ?>
                                        </td>
                                        <td class="fw-semibold">
                                            $<?php echo number_format($item) ?>
                                        </td>
                                        <td class="fw-semibold">
                                            $<?php echo number_format($itemUSD) ?>
                                        </td>
                                    </tr>

                                <?php  } while ($arreglo = $query->fetch(PDO::FETCH_ASSOC));
                            } else { ?>
                                <div class="alert alert-info">No hay Registros</div>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive">
                    <table class="table border">
                        <tr>
                            <th class="fs-5 fw-semibold" scope="col">
                                <span class="text-muted">
                                    Envío:
                                </span>$<?php
                                        if (isset($envio)) {
                                            echo number_format($envio) . ' / ' . 'USD$' . number_format(ceil($envio / $dolar));
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                            </th>
                            <th class="fs-5 fw-semibold" scope="col">
                                <span class="text-muted">
                                    Total COP:
                                </span>$<?php
                                        if (isset($totalCOP)) {
                                            $total = $totalCOP + $envio;
                                            echo number_format($total);
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                            </th>
                            <th class="fs-5 fw-semibold" scope="col">
                                <span class="text-muted">
                                    Total USD:
                                </span>$<?php
                                        if (isset($totalUSD)) {
                                            $pay = intdiv($total, $dolar);
                                            echo number_format($pay);
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                            </th>
                        </tr>
                    </table>
                </div>
                <div class="text-start">
                    <div id="paypal-button-container" style="max-width: 24rem;"></div>
                </div>
                <script>
                    paypal.Buttons({
                        style: {
                            color: 'blue',
                            shape: 'pill',
                            label: 'pay'
                        },
                        createOrder: function(data, actions) {
                            return actions.order.create({
                                purchase_units: [{
                                    amount: {
                                        value: <?php echo $pay ?>
                                    }
                                }]
                            });
                        },
                        oncancel: function(data) {
                            Swal.fire(
                                'Pago Cancelado',
                                '',
                                'error'
                            );
                        },
                        onApprove: function(data, actions) {
                            actions.order.capture().then(function(detalles) {
                                let listData = {
                                    email_cliente: `<?php echo $email ?>`,
                                }
                                $.ajax({
                                    type: 'POST',
                                    url: '?page=cliente&opcion=completarCompra',
                                    data: listData,
                                    success: function(data) {
                                        swal.fire({
                                            position: 'center',
                                            icon: 'info',
                                            title: data,
                                            showConfirmButton: true,
                                            timer: 2000
                                        });
                                        setTimeout(() => {
                                            location.reload();
                                        }, 2500);
                                    }
                                });
                                // console.log(detalles)
                                // Swal.fire(
                                //     'Pago Aprobado',
                                //     '',
                                //     'success'
                                // );
                            });
                        }
                    }).render("#paypal-button-container");
                </script>
            </div>
        </div>
    </div>
    <?php require 'view/layouts/footer.php' ?>