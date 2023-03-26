<?php
session_start();

require "connect/dbconnect.php";

$connect = new Conexion;
$connect->conectar();

// Variable Auxiliar para cuando no haya registros
$registros = "1";

// Condicional para saber si existen los productos
if (isset($_POST['productos'])) {
    // Preparo la primera parte de la consulta 
    $sql = "SELECT tiendas_productos.id_producto, 
    tiendas_productos.nit_tienda,
    marcas.marca, 
    productos.nombre_producto, 
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
    WHERE ";
    // Creo un arreglo para los parámetros con el ciclo
    $parametros = array();
    foreach ($_POST['productos'] as $key => $value) {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        // Saco el nit de cada producto
        $nit = $_POST['nits'][$key];
        // Con cada iteración voy añadiendo al string de la consulta
        $sql .= "tiendas_productos.id_producto = '$value' AND tiendas_productos.nit_tienda = '$nit' OR ";
        $parametros[] = $value;
    }
    // Quito el último OR para que no suelte error
    $sql = rtrim($sql, ' OR ');
    // Preparo y ejecuto la consulta
    $sentencia = $connect->conexion->prepare($sql);
    $sentencia->execute();
    $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
} else {
    // En caso de que no se envíe nada vacío la variable auxiliar
    $registros = "";
}

if (isset($_SESSION['login'])) {
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
} else {
    require "view/layouts/header.php";
}

$connect->desconectar();

?>


<div class="container mt-5 bg-light rounded">
    <div class="row justify-content-center mb-3">
        <div class=" mt-3 col text-center">
            <h2>Comparar Productos</h2>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="row d-flex justify-content-center m-3">
                <!-- Si no existen registros suelto la alerta -->
                <?php if ($registros == "") { ?>
                    <div class="alert alert-success m-2" role="alert">
                        <?php echo "No hay productos para comparar" ?>
                    </div>
                <?php } else { ?>
                    <!-- Voy llenando las tarjetas conforme va iterando en los resultados -->
                    <?php foreach ($resultado as $row) { ?>
                        <div class="card me-3 mb-3" style="max-width: 300px;">
                            <!-- Nombre, imagen, Precio, CPU, GPU, Almacenamiento, RAM, Pantalla, Botón -->
                            <div class="card-header" style="height: 80px">
                                <h4 class="text-center text-success fw-bold fs-5 my-auto">
                                    <?php echo $row['marca'] . " " . $row['nombre_producto'] ?>
                                </h4>
                            </div>
                            <div class="card-body text-center">
                                <a href="#"><img class="card-img-top" src="<?php echo $row['imagen'] ?>" width="250" height="200"></a>
                                <span class="fw-semibold fs-5 text-success">$<?php echo number_format($row['precio']) ?></span>
                                <table class="table table-striped table-hover table-sm">
                                    <tr>
                                        <td class="text-center">
                                            <span style="color: #FF0000;"><i class="fa-solid fa-check me-2"></i></span>
                                            <?php echo $row['procesador'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span style="color: #FF0000;"><i class="fa-solid fa-check me-2"></i></span>
                                            <?php echo $row['grafica'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span style="color: #FF0000;"><i class="fa-solid fa-check me-2"></i></span>
                                            <?php echo $row['almacenamiento'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span style="color: #FF0000;"><i class="fa-solid fa-check me-2"></i></span>
                                            <?php echo $row['ram'] ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-center">
                                            <span style="color: #FF0000;"><i class="fa-solid fa-check me-2"></i></span>
                                            <?php echo $row['pantalla'] ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="card-footer text-center">
                                <div class="me-3">
                                    <?php if (isset($_SESSION['login'])) { ?>
                                        <a href='?page=cliente&opcion=addCart&email=<?php echo $user ?>&idProducto=<?php echo $row['id_producto'] ?>&nitTienda=<?php echo $row['nit_tienda'] ?>' class='btn btn-success addCart' onClick='alertaAddCart()'>
                                                <i class='fa-solid fa-cart-shopping me-2'></i>Añadir al Carrito
                                            </a>
                                    <?php } else { ?>
                                        <div class="me-3">
                                            <a class="btn btn-success" href="?page=login&msg=Debe Iniciar Sesión para activar su carrito de compras">Añadir al Carrito</a>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>