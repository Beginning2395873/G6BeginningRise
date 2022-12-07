<?php
$db = new Conexion;
$db->conectar();
$sql = $db->conexion->prepare("SELECT productos.id_producto, marcas.marca, productos.nombre_producto, tipo.tipo, productos.almacenamiento, productos.ram, productos.descuento, productos.imagen, productos.estado FROM productos INNER JOIN marcas ON productos.id_marca = marcas.id_marca INNER JOIN tipo ON productos.id_tipo = tipo.id_tipo WHERE id_producto = '$idProducto' ");
$sql->execute();
$arreglo = $sql->fetch();

$query = $db->conexion->query("SELECT * FROM marcas");
$resultado1 = $query->fetch(PDO::FETCH_ASSOC)

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
                    <!-- ID, Marca y Nombre -->
                    <input type="hidden" name="idProducto" value="<?php echo $arreglo[0] ?>">
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="marca">Marca<span class="ms-1" style="color: red;">(*)</span></label>
                            <input type="hidden" name="marca" value="<?php echo $arreglo[1]?>">
                            <select class="form-select" name="marca" disabled>
                                <option selected><?php echo $arreglo[1]?></option>
                                <option value="<?php echo $resultado1['marca'] ?>"><?php echo $resultado1['marca'] ?></option>
                                <?php foreach ($query as $opciones) { ?>
                                    <option value="<?php echo $opciones['marca'] ?>"><?php echo $opciones['marca'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nombreProducto">Nombre del Producto<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="nombreProducto" name="nombreProducto" value="<?php echo $arreglo['2'] ?>" required />
                        </div>
                        
                    </div>
                    <!-- Demás Info -->
                    <div class="row mt-3">

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>