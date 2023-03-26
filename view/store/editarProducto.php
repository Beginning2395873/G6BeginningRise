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

$db = new Conexion;
$db->conectar();
$queryid = $db->conexion->prepare(
    "SELECT * FROM tiendas WHERE email_tienda = '$user'"
);
$idProd = $_GET['idProd'];
$queryid->execute();
$resid = $queryid->fetch();
// Almaceno NIT para futuras consultas
$nit = $resid[0];
// Para traer los datos a editar
$sql = $db->conexion->prepare(
    "SELECT tiendas_productos.id_producto, 
    marcas.marca, 
    productos.nombre_producto, 
    tipo.tipo, 
    tiendas_productos.almacenamiento, 
    tiendas_productos.ram,
    tiendas_productos.precio,
    tiendas_productos.descuento, 
    tiendas_productos.imagen
    FROM tiendas_productos 
    INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto
    INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
    INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
    WHERE tiendas_productos.id_producto = '$idProd' AND tiendas_productos.nit_tienda = '$nit'"
);
$sql->execute();
$arreglo = $sql->fetch(PDO::FETCH_ASSOC);
$query = $db->conexion->query("SELECT * FROM marcas");
$resultado1 = $query->fetch(PDO::FETCH_ASSOC);
$query2 = $db->conexion->query("SELECT * FROM tipo");
$resultado2 = $query2->fetch(PDO::FETCH_ASSOC);
?>
<?php require "view/layouts/headerT.php" ?>
<div class="container rounded bg-white mt-5 mb-5 mx-auto" style="max-width: 700px;">
    <div class="row">
        <!-- Demás Info -->
        <div class="col-md-12">
            <a href="<?php echo urlsite ?>?page=tienda&opcion=listaProductos" class="btn btn-success mt-2"><i class="fa-solid fa-arrow-left me-1"></i>Volver</a>
            <div class="p-3 py-2">
                <!-- Datos Básicos -->
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="border" height="200px" alt="Foto" src="<?php echo $arreglo['imagen'] ?>">
                    <p class="fs-5 fw-bold text-success"><?php echo $arreglo['marca'] ?> <?php echo $arreglo['nombre_producto'] ?></p>
                </div>
                <div class="justify-content-between mb-3">
                    <h4 class="text-center fs-2 fw-bold">Editar Producto</h4>
                </div>
                <p class="text-left">
                    Los campos marcados con<span class="ms-1" style="color: red;">(*)</span> son obligatorios.
                </p>
                <!-- Formulario -->
                <form action="<?php echo urlsite ?>?page=productoEditar" method="POST" enctype="multipart/form-data" id="editarProducto" >
                    <!-- Marca y Nombre -->
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="marcas">Marca</label>
                            <input type="hidden" name="marcasel" value="<?php echo $arreglo['marca'] ?>">
                            <select class="form-select" name="marcas" disabled>
                                <option selected><?php echo $arreglo['marca'] ?></option>
                                <option value="<?php echo $resultado1['marca'] ?>"><?php echo $resultado1['marca'] ?></option>
                                <?php foreach ($query as $opciones) { ?>
                                    <option value="<?php echo $opciones['marca'] ?>"><?php echo $opciones['marca'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nombreProducto">Nombre del Producto</label>
                            <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $arreglo['nombre_producto'] ?>" disabled />
                        </div>
                    </div>
                    <!-- Demás Info -->
                    <div class="row mt-3">
                        <!-- Tipo y Almacenamiento -->
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="tipos">Tipo</label>
                            <input type="hidden" name="tiposel" value="<?php echo $arreglo['tipo'] ?>">
                            <select class="form-select" name="tipos" disabled>
                                <option selected><?php echo $arreglo['tipo'] ?></option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="disco">Almacenamiento<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="disco" name="disco" value="<?php echo $arreglo['almacenamiento'] ?>" required />
                        </div>
                    </div>
                    <!-- RAM y Descuento -->
                    <div class="row mt-3">
                        <div class="col-md-6 md-2">
                            <label class="form-label" for="ram">Memoria RAM<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="ram" name="ram" value="<?php echo $arreglo['ram'] ?>" required />
                        </div>
                        <div class="col-md-6 md-2">
                            <label class="form-label" for="descuento">Porcentaje de descuento<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="descuento" name="descuento" value="<?php echo $arreglo['descuento'] ?>" required />
                        </div>
                    </div>
                    <!-- Precio -->
                    <div class="row mt-3">
                        <div class="mb-4">
                            <label for="precio" class="form-label" >Precio<span class="ms-1" style="color: red;">(*)</span></label>
                            <input type="number" name="precio" id="precio" class="form-control" value="<?php echo $arreglo['precio'] ?>" >
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="mb-4">
                            <label for="imgProducto" class="form-label">Insertar imagen del Computador</label>
                            <input class="form-control form-control" type="file" id="imgProducto" accept=".jpg, .png, .webp" name="imgProducto">
                        </div>
                    </div>

                    <!-- Enviar -->
                    <div class="col mx-auto mb-5" style="max-width: 250px;">
                        <input type="hidden" name="modificar" />
                        <!-- Input de ID y NIT -->
                        <input type="hidden" name="idProducto" value="<?php echo $arreglo['id_producto'] ?>">
                        <input type="hidden" name="nit" value="<?php echo $nit ?>" />
                        <input type="submit" onclick="alertaModificarProducto()" class="btn btn-outline-success sbtn-block" value="Guardar Cambios" />
                        <a href="?page=tienda" class="btn btn-outline-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>