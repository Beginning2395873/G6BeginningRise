<?php
session_start();
$user = $_SESSION['login'];
$connect = new Conexion();
$connect->conectar();
// Todas los registros de la tabla
$query = $connect->conexion->query("SELECT * FROM marcas");
// Primer Registro
$resultado1 = $query->fetch(PDO::FETCH_ASSOC)

?>

<?php require "view/layouts/headerT.php" ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mx-auto" style="max-width: 600px;">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                        Subir Producto
                    </h3>
                </div>
                <div class="card-body mt-2">
                    <form action="<?php echo urlsite ?>?page=productoAñadir" method="POST" enctype="multipart/form-data">
                        <!-- Marca y Tipo -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <select class="form-select" name="marca">
                                        <option selected>Seleccione...</option>
                                        <!-- Primer Registro -->
                                        <option value="<?php echo $resultado1['marca']?>"><?php echo $resultado1['marca']?></option>
                                        <!-- Ciclo para los demás registros -->
                                        <?php foreach ($query as $opciones) { ?>
                                            <option value="<?php echo $opciones['marca']?>" ><?php echo $opciones['marca']?></option>
                                        <?php } ?>
                                    </select>
                                    <label class="form-label" for="marca">Marca</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <select class="form-select" name="tipo">
                                        <option selected>Seleccione...</option>
                                        <option value="1">Ofimática</option>
                                        <option value="2">Gamer</option>
                                    </select>
                                    <label class="form-label" for="tipo">Tipo de Computador</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="nombreProducto" class="form-control" name="nombreProducto">
                                    <label class="form-label" for="nombreProducto">Nombre del producto</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="disco" class="form-control" name="disco" />
                                    <label class="form-label" for="disco">Almacenamiento</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="cpu" class="form-control" name="cpu" />
                                    <label class="form-label" for="cpu">Procesador</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="grafica" class="form-control" name="gpu" />
                                    <label class="form-label" for="grafica">Grafica</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="ram" class="form-control" name="ram" />
                                    <label class="form-label" for="ram">Memoria Ram</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="pantalla" class="form-control" name="pantalla" />
                                    <label class="form-label" for="pantalla">Pantalla</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="bateria" class="form-control" name="bateria" />
                                    <label class="form-label" for="bateria">Bateria</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" id="precio" class="form-control" name="precio" />
                                    <label class="form-label" for="precio">Precio</label>
                                </div>
                            </div>
                        </div>
                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="imgProducto" class="form-label">Insertar imagen del Computador</label>
                            <input class="form-control form-control-sm" type="file" id="imgProducto" accept=".jpg, .png, .webp" name="imgProducto">
                        </div>
                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 130px;">
                            <input type="hidden" name="añadir" />
                            <input type="hidden" name="user" value="<?php echo $user ?>" />
                            <input type="submit" class="btn btn-outline-success sbtn-block mb-4" value="Subir Producto" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>