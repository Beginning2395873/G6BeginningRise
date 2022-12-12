<?php
session_start();
// Almaceno correo para próxima consulta
$user = $_SESSION['login'];
// Capturar lo que se escribió en la barra de búsqueda
if ($_POST) {
    $busqueda = strtolower($_REQUEST['busqueda']);
}
// Conexión y consulta para total de registros
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
    "SELECT count(*) as totalRegistros from productos"
);
$query->execute();
$arreglo = $query->fetch(PDO::FETCH_ASSOC);
$totalRegistros = $arreglo["totalRegistros"];
// Máximo de registros para el paginador
$maximoRegistros = 5;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);
// Valido que se haya ingresado algo en la barra de búsqueda
if (!empty($_POST['search'])) {
    // Para el paginador luego de buscar
    $sqlcuentaBusqueda = $connect->conexion->prepare(
        "SELECT count(tiendas_productos.id_producto) as totalBusqueda, 
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
            WHERE tiendas_productos.id_producto like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or marca like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or tipo like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or nombre_producto like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            order by tiendas_productos.id_producto asc"
    );
    $sqlcuentaBusqueda->execute();
    $arregloBusqueda = $sqlcuentaBusqueda->fetch(PDO::FETCH_ASSOC);
    $totalBusqueda = $arregloBusqueda['totalBusqueda'];
    $maximoRegistrosBusqueda = 5;
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
    $totalPaginas = ceil($totalBusqueda / $maximoRegistrosBusqueda);
    // Traer Info luego de Buscar
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
            WHERE tiendas_productos.id_producto like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or marca like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or tipo like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            or nombre_producto like '%$busqueda%' and tiendas_productos.nit_tienda = '$nit' 
            order by tiendas_productos.id_producto asc 
            limit $desde,$maximoRegistros"
    );
    $query2->execute();
    $arreglo2 = $query2->fetch();
} else {
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
            and tiendas_productos.estado != 0 
            order by tiendas_productos.id_producto asc 
            limit $desde,$maximoRegistros"
    );
    $query2->execute();
    $arreglo2 = $query2->fetch();
}
?>
<?php require "view/layouts/headerT.php" ?>
<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <div class="input-group d-flex" style="max-width: 400px;">
                <!-- Búsqueda -->
                <form action="" class="d-flex" role="search" method="POST">
                    <input type="search" id="buscar" class="form-control" name="busqueda" placeholder="Buscar Producto" aria-label="Search" />
                    <button type="submit" name="search" role="button" class="btn btn-primary me-2" value="Buscar">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="?page=tienda&opcion=listaProductos" class="btn btn-warning ">
                    <i class="fa-solid fa-list"></i>
                    Listar
                </a>
            </div>
        </div>
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
                                    <td colspan="6" class="p-3 mb-2">
                                        <h5>Lista de Productos</h5>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-secondary">
                                    <!-- Títulos de las columnas -->
                                    <th scope="col">
                                        ID Producto
                                    </th>
                                    <th scope="col">
                                        Marca
                                    </th>
                                    <th scope="col">
                                        Nombre del Producto
                                    </th>
                                    <th scope="col">
                                        Tipo
                                    </th>
                                    <th scope="col">
                                        Almacenamiento
                                    </th>
                                    <th scope="col">
                                        CPU
                                    </th>
                                    <th scope="col">
                                        RAM
                                    </th>
                                    <th scope="col">
                                        Pantalla
                                    </th>
                                    <th scope="col">
                                        GPU
                                    </th>
                                    <th scope="col">
                                        Bateria
                                    </th>
                                    <th scope="col">
                                        Precio
                                    </th>
                                    <th scope="col">
                                        Descuento
                                    </th>
                                    <th scope="col">
                                        Imagen
                                    </th>
                                    <th scope="col">
                                        Estado
                                    </th>
                                    <th scope="col">
                                        Modificar
                                    </th>
                                    <th scope="col">
                                        Eliminar
                                    </th>
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
                                        // Descuento
                                        $price = $arreglo2[10];
                                        $discount = $arreglo2[11];
                                        if ($discount != 0) {
                                            $oferta = $price - ceil(($price * $discount / 100));
                                            $status = 2;
                                        } else {
                                            $oferta = $price;
                                        }
                                        // Estado
                                        if ($arreglo2[13] == 0) {
                                            $status = 'Inactivo';
                                        } else if ($arreglo2[13] == 2) {
                                            $status = 'En Oferta';
                                        } else {
                                            $status = 'Activo';
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $arreglo2[0] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[1] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[2] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[3] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[4] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[5] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[6] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[7] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[8] ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[9] ?>
                                            </td>
                                            <td>
                                                $<?php echo number_format($oferta) ?>
                                            </td>
                                            <td>
                                                <?php echo $arreglo2[11] ?>%
                                            </td>
                                            <td>
                                                <img src="<?php echo $arreglo2[12] ?>" alt="imagen" width="80px">
                                            </td>
                                            <td>
                                                <?php echo $status ?>
                                            </td>
                                            <!-- Editar -->
                                            <td>
                                                <?php
                                                echo "
                                                    <form action='" . urlsite . "?page=tienda&opcion=modificarProducto' method='POST'>
                                                        <input type='hidden' name='idProducto' value=" . $arreglo2[0] . " />
                                                        <button type='submit' class='btn btn-success' name='modificar' >
                                                            <i class='fa-solid fa-pen-to-square'></i>
                                                        </button>
                                                    </form>";
                                                ?>
                                            </td>
                                            <!-- Desactivar/Activar -->
                                            <?php if ($status == 'Activo' or $status == 'En Oferta') { ?>
                                                <td>
                                                    <?php echo "
                                                        <form id='toggleProducto' action='" . urlsite . "?page=toggleProducto' name='desactivar' method='POST'>
                                                            <input type='hidden' id='idProducto' name='idProducto' value='$arreglo2[0]' />
                                                            <input type='hidden' id='idProducto' name='nit' value='$nit' />
                                                            <button type='submit' name='eliminar' class='btn btn-warning' onClick='alertaProductoDesactivar()' >
                                                                <i class='fa-solid fa-circle-xmark'></i>
                                                            </button>
                                                        </form>"
                                                    ?>
                                                </td>
                                            <?php } else if ($status == 'Inactivo') { ?>
                                                <td>
                                                    <?php echo "
                                                        <form id='toggleProducto' action='" . urlsite . "?page=toggleProducto' name='activar' method='POST'>
                                                            <input type='hidden' id='idProducto' name='idProducto' value='$arreglo2[0]' />
                                                            <input type='hidden' id='idProducto' name='nit' value='$nit' />
                                                            <button type='submit' name='eliminar' class='btn btn-success' onClick='alertaProductoActivar()' >
                                                                <i class='fa-solid fa-eye'></i>
                                                            </button>
                                                        </form>"
                                                    ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                <?php
                                    } while ($arreglo2 = $query2->fetch());
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <nav class="mt-5" aria-label="paginador">
                        <ul class="pagination justify-content-center">
                            <?php
                            if ($pagina != 1) 
                            {
                            ?>
                                <li class="page-item ">
                                    <a class="page-link" href="?page=tienda&opcion=listaProductos&pagina=<?php echo 1; ?>">
                                        <i class="fa-solid fa-backward-fast"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=tienda&opcion=listaProductos&pagina=<?php echo $pagina - 1; ?>">
                                        <i class="fa-solid fa-backward-step"></i>
                                    </a>
                                </li>
                            <?php
                            }
                            for ($i = 1; $i <= $totalPaginas; $i++) {
                                if ($i == $pagina) {
                                    echo '
                                        <li class="page-item active" aria-current="page">
                                            <a class="page-link" href="?page=tienda&opcion=listaProductos&pagina=' . $i . '">
                                                ' . $i . '
                                            </a>
                                        </li>';
                                } else {
                                    echo '<li class="page-item ">
                                        <a class="page-link" href="?page=tienda&opcion=listaProductos&pagina=' . $i . '">
                                            ' . $i . '
                                        </a>
                                    </li>';
                                }
                            }
                            if ($pagina != $totalPaginas) 
                            {
                            ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo urlsite ?>?page=tienda&opcion=listaProductos&pagina=<?php echo $pagina + 1; ?>">
                                        <i class="fa-solid fa-forward-step"></i>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link" href="?page=tienda&opcion=listaProductos&pagina=<?php echo $totalPaginas; ?>">
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
<?php require "view/layouts/footer.php" ?>