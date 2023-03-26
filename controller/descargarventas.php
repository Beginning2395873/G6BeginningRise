<?php
require "../connect/dbconnect.php";
session_start();
// Conexión y consulta para total de registros
$connect = new Conexion();
$connect->conectar();
$user = $_SESSION['login'];
// Capturar lo que se escribió en la barra de búsqueda
if ($_POST) {
    $busqueda = strtolower($_REQUEST['busqueda']);
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
$query = $connect->conexion->prepare(
    "SELECT count(*) as totalRegistros from ventas_productos WHERE nit_tienda = '$nit'"
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
if (!empty($_POST['search'])) {
    $sqlcuentaBusqueda = $connect->conexion->prepare(
        // id, cliente, email cliente, tienda, marca, nombre producto, precio, fecha
        "SELECT count(ventas.id_venta) as totalBusqueda,
        persona.nombre_persona,
        clientes.email_cliente,
        ventas_productos.nit_tienda,
        tiendas.nombre_tienda,
        marcas.marca,
        productos.nombre_producto,
        tiendas_productos.precio,
        ventas.fecha
        FROM ventas
        INNER JOIN persona ON ventas.email_cliente = persona.email_persona
        INNER JOIN clientes ON ventas.email_cliente = clientes.email_cliente
        INNER JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta
        INNER JOIN tiendas ON ventas_productos.nit_tienda = tiendas.nit_tienda
        INNER JOIN tiendas_productos ON tiendas.nit_tienda = tiendas_productos.nit_tienda
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca
        -- Buscar por id venta, nombre cliente, marca, nombre producto
        WHERE ventas.id_venta like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or marca like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or nombre_persona like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or nombre_producto like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'"
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
        // id, cliente, email cliente, tienda, marca, nombre producto, precio, fecha
        "SELECT ventas.id_venta,
        persona.nombre_persona,
        clientes.email_cliente,
        ventas_productos.nit_tienda,
        tiendas.nombre_tienda,
        marcas.marca,
        productos.nombre_producto,
        tiendas_productos.precio,
        ventas.fecha
        FROM ventas
        INNER JOIN persona ON ventas.email_cliente = persona.email_persona
        INNER JOIN clientes ON ventas.email_cliente = clientes.email_cliente
        INNER JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta
        INNER JOIN tiendas ON ventas_productos.nit_tienda = tiendas.nit_tienda
        INNER JOIN tiendas_productos ON tiendas.nit_tienda = tiendas_productos.nit_tienda
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca
        -- Buscar por id venta, nombre cliente, marca, nombre producto
        WHERE ventas.id_venta like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or marca like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or nombre_persona like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        or nombre_producto like '%$busqueda%' and ventas_productos.nit_tienda = '$nit'
        limit $desde,$maximoRegistros"
    );
    $query2->execute();
    $arreglo2 = $query2->fetch();
} else {
    // Consulta
    $query2 = $connect->conexion->prepare(
        // id, cliente, email cliente, tienda, marca, nombre producto, precio, fecha
        "SELECT ventas.id_venta,
        persona.nombre_persona,
        clientes.email_cliente,
        ventas_productos.nit_tienda,
        tiendas.nombre_tienda,
        marcas.marca,
        productos.nombre_producto,
        tiendas_productos.precio,
        ventas.fecha
        FROM ventas
        INNER JOIN persona ON ventas.email_cliente = persona.email_persona
        INNER JOIN clientes ON ventas.email_cliente = clientes.email_cliente
        INNER JOIN ventas_productos ON ventas.id_venta = ventas_productos.id_venta
        INNER JOIN tiendas ON ventas_productos.nit_tienda = tiendas.nit_tienda
        INNER JOIN tiendas_productos ON tiendas.nit_tienda = tiendas_productos.nit_tienda
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca
        -- Buscar por id venta, nombre cliente, marca, nombre producto
        WHERE ventas_productos.nit_tienda = '$nit'
        limit $desde,$maximoRegistros"
    );
    $query2->execute();
    $arreglo2 = $query2->fetch();
}
?>

<table border="2">
    <caption border="2">Informe de Ventas</caption>
    <tr>
        <th scope="col">ID Venta</th>
        <th scope="col">Nombre cliente</th>
        <th scope="col">Correo cliente</th>
        <th scope="col">NIT Tienda</th>
        <th scope="col">Nombre Tienda</th>
        <th scope="col">Marca</th>
        <th scope="col">Nombre Producto</th>
        <th scope="col">Precio</th>
        <th scope="col">Fecha</th>
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
                <td>$<?php echo number_format($arreglo2[7]) ?></td>
                <td><?php echo $arreglo2[8] ?></td>
            </tr>
    <?php
        } while ($arreglo2 = $query2->fetch());
    }
    ?>
</table>