<?php
session_start();
$user = $_SESSION['login'];
$db = new Conexion;
$db->conectar();
$queryid = $db->conexion->prepare(
    "SELECT * FROM tiendas WHERE email_tienda = '$user'"
);
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
        tiendas_productos.descuento, 
        tiendas_productos.imagen
        FROM tiendas_productos 
        INNER JOIN productos ON tiendas_productos.id_producto = productos.id_producto
        INNER JOIN marcas ON productos.id_marca = marcas.id_marca 
        INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo 
        WHERE tiendas_productos.id_producto = '$idProducto'"
);
$sql->execute();
$arreglo = $sql->fetch();
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
                    <img class="border" height="200px" alt="Foto" src="<?php echo $arreglo['7'] ?>">
                    <p class="fs-5 fw-bold text-success"><?php echo $arreglo[1] ?> <?php echo $arreglo[2] ?></p>
                </div>
                <div class="justify-content-between mb-3">
                    <h4 class="text-center fs-2 fw-bold">Editar Producto</h4>
                </div>
                <p class="text-left">
                    Los campos marcados con<span class="ms-1" style="color: red;">(*)</span> son obligatorios.
                </p>
                <!-- Formulario -->
                <form action="<?php echo urlsite ?>?page=productoEditar" method="POST" enctype="multipart/form-data">
                    <!-- Marca y Nombre -->
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="marcas">Marca</label>
                            <input type="hidden" name="marcasel" value="<?php echo $arreglo[1] ?>">
                            <select class="form-select" name="marcas" disabled>
                                <option selected><?php echo $arreglo[1] ?></option>
                                <option value="<?php echo $resultado1['marca'] ?>"><?php echo $resultado1['marca'] ?></option>
                                <?php foreach ($query as $opciones) { ?>
                                    <option value="<?php echo $opciones['marca'] ?>"><?php echo $opciones['marca'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nombreProducto">Nombre del Producto</label>
                            <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $arreglo['2'] ?>" disabled />
                        </div>
                    </div>
                    <!-- Demás Info -->
                    <div class="row mt-3">
                        <!-- Tipo y Almacenamiento -->
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="tipos">Tipo</label>
                            <input type="hidden" name="tiposel" value="<?php echo $arreglo[3] ?>">
                            <select class="form-select" name="tipos" disabled>
                                <option selected><?php echo $arreglo[3] ?></option>
                                <option value="<?php echo $resultado2['tipo'] ?>"><?php echo $resultado2['tipo'] ?></option>
                                <?php foreach ($query2 as $opciones) { ?>
                                    <option value="<?php echo $opciones['tipo'] ?>"><?php echo $opciones['tipo'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="disco">Almacenamiento<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="disco" name="disco" value="<?php echo $arreglo['4'] ?>" required />
                        </div>
                    </div>
                    <!-- RAM y Descuento -->
                    <div class="row mt3">
                        <div class="col-md-6 md-2">
                            <label class="form-label" for="ram">Memoria RAM<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="ram" name="ram" value="<?php echo $arreglo['5'] ?>" required />
                        </div>
                        <div class="col-md-6 md-2">
                            <label class="form-label" for="descuento">Porcentaje de descuento<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="descuento" name="descuento" value="<?php echo $arreglo['6'] ?>" required />
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="mb-4">
                            <label for="imgProducto" class="form-label">Insertar imagen del Computador</label>
                            <input class="form-control form-control" type="file" id="imgProducto" accept=".jpg, .png, .webp" name="imgProducto">
                        </div>
                    </div>
                    <!-- Enviar -->
                    <div class="col mx-auto" style="max-width: 148px;">
                        <input type="hidden" name="modificar" />
                        <!-- Input de ID y NIT -->
                        <input type="hidden" name="idProducto" value="<?php echo $arreglo[0] ?>">
                        <input type="hidden" name="nit" value="<?php echo $nit ?>" />
                        <input type="submit" class="btn btn-outline-success sbtn-block mb-4" value="Guardar Cambios" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>