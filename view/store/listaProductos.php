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
// Consulta
$query2 = $connect->conexion->prepare(
    "SELECT tiendas_productos.id_producto, 
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
    tiendas_productos.estado 
    FROM tiendas_productos 
    INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto 
    INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
    INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
    WHERE tiendas_productos.nit_tienda = '$nit'
    order by tiendas_productos.id_producto asc"
);
$query2->execute();
$arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
// id tipo marca nombre almacenamiento procesador ram grafica pantalla bateria precio descuento imagen estado modificar activar/desactivar
?>
<?php require "view/layouts/headerT.php" ?>
<div class="container-fluid my-4">
    <div class="row d-flex justify-content-center">
        <div class="rounded col-sm-11 col-md-11 col-lg-11 col-xl-11 bg-white">
            <!-- nit, nombre, dirección, telefono, correo, foto, estado, activar/desactivar -->
            <div class="my-2">
                <h3 class="text-center my-3">Lista de Productos</h3>
                <?php
                    if (isset($_SESSION['msj']) and isset($_SESSION['icon'])) {
                        $respuesta = $_SESSION['msj'];
                        $icono = $_SESSION['icon'];
                    ?>
                        <script>
                            Swal.fire(
                                'Editar Producto',
                                '<?php echo $respuesta ?>',
                                '<?php echo $icono ?>'
                            )
                        </script>
                    <?php
                        unset($_SESSION['msj']);
                        unset($_SESSION['icon']);
                    }
                    ?>
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
                        <tr>
                            <th class="text-nowrap">ID Producto</th>
                            <th class="text-nowrap">Tipo</th>
                            <th class="no-exportar text-nowrap">Imagen</th>
                            <th class="text-nowrap">Marca</th>
                            <th class="text-nowrap">Referencia</th>
                            <th class="text-nowrap">Almacenamiento</th>
                            <th class="text-nowrap">Procesador</th>
                            <th class="text-nowrap">Memoria RAM</th>
                            <th class="text-nowrap">Tarjeta Gráfica</th>
                            <th class="text-nowrap">Pantalla</th>
                            <th class="text-nowrap">Batería</th>
                            <th class="text-nowrap">Precio</th>
                            <th class="text-nowrap">Descuento</th>
                            <th class="text-nowrap">Estado</th>
                            <th class="no-exportar text-nowrap">Modificar</th>
                            <th class="no-exportar text-nowrap">Activar / Desactivar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($arreglo2 === false) { ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo "No hay registros" ?>
                            </div>
                            <?php } else {
                            do {
                                // Estado
                                $stauts = '';
                                if ($arreglo2['estado'] == 0) {
                                    $clase = 'text-center py-auto my-1 p-2 rounded bg-danger text-light fw-semibold';
                                    $status = 'Inactivo';
                                } else if ($arreglo2['estado'] == 1) {
                                    $status = 'Activo';
                                    $clase = 'text-center py-auto my-1 p-2 rounded bg-success text-light fw-semibold';
                                } else if ($arreglo2['estado'] == 2) {
                                    $status = 'Oferta';
                                    $clase = 'text-center py-auto my-1 p-2 rounded bg-primary text-light fw-semibold';
                                }
                                // Descuento
                                $price = $arreglo2['precio'];
                                $discount = $arreglo2['descuento'];
                                if ($discount > 0) {
                                    $oferta = $price - ceil(($price * $discount / 100));
                                    $class = "text-success fw-semibold";
                                }
                            ?>
                                <tr>
                                    <td class="text-center fw-semibold text-primary">
                                        <?php echo $arreglo2['id_producto'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['tipo'] ?>
                                    </td>
                                    <td>
                                        <img class="rounded" src="<?php echo $arreglo2['imagen'] ?>" alt="imagen" width="75" height="75" >
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['marca'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nombre_producto'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['almacenamiento'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['procesador'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['ram'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['grafica'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['pantalla'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['bateria'] ?>
                                    </td>
                                    <td>
                                        <?php if($discount > 0) { ?>
                                            <span class="<?php echo $class?>">
                                                $<?php echo number_format($oferta)?>
                                            </span>
                                        <?php } else { ?>
                                            <?php echo number_format($arreglo2['precio'])?>
                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php echo $arreglo2['descuento'] ?>%
                                    </td>
                                    <td class="text-center">
                                        <span class="<?php echo $clase ?>">
                                            <?php echo $status ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php echo '
                                            <a href="?page=tienda&opcion=modificarProducto&idProd='.$arreglo2['id_producto'].'" class="btn btn-success">
                                                <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                        ' ?>

                                    </td>
                                    <td class="text-center">
                                    <?php if ($status != 'Inactivo') {
                                            echo '
                                                <button onclick="confirmarDesactivarProducto(' . $nit . ',' . $arreglo2['id_producto'] . ')" class="btn btn-outline-danger">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                ';
                                        } else {
                                            echo '
                                                <button onclick="confirmarActivarProducto(' . $nit . ',' . $arreglo2['id_producto'] . ')" class="btn btn-outline-success">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </button>
                                                ';
                                        }
                                        ?>
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