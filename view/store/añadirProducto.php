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

$connect = new Conexion();
$connect->conectar();
// Todas los registros de la tabla para el Select
$query = $connect->conexion->query("SELECT marcas.marca FROM marcas");
$resultado1 = $query->fetchAll(PDO::FETCH_ASSOC);

?>

<?php require "view/layouts/headerT.php" ?>
<div class="container">
    <div class="row mt-5">
        <div class="col-12 mx-auto" style="max-width: 750px;">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                        Subir Producto
                    </h3>
                    <?php
                    if (isset($_SESSION['msj']) and isset($_SESSION['icon'])) {
                        $respuesta = $_SESSION['msj'];
                        $icono = $_SESSION['icon'];
                    ?>
                        <script>
                            Swal.fire(
                                'Añadir Producto',
                                '<?php echo $respuesta ?>',
                                '<?php echo $icono ?>'
                            )
                        </script>
                    <?php
                        unset($_SESSION['msj']);
                        unset($_SESSION['icon']);
                    }
                    ?>
                </div>
                <div class="card-body mt-2">
                    <form action="<?php echo urlsite ?>?page=productoAñadir" method="POST" enctype="multipart/form-data" id="newProducto" >
                        <!-- Marca y Tipo -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <select class="form-select" name="marca">
                                        <option selected>Seleccione...</option>
                                        <!-- Ciclo para llenar el Select -->
                                        <?php foreach ($resultado1 as $opciones) { ?>
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
                                        <option value="1">Gamer</option>
                                        <option value="2">Ofimática</option>
                                    </select>
                                    <label class="form-label" for="tipo">Tipo de Computador</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="nombreProducto" class="form-control" name="nombreProducto">
                                    <label class="form-label" for="nombreProducto">Nombre del producto</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="disco" class="form-control" name="disco" />
                                    <label class="form-label" for="disco">Almacenamiento</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="cpu" class="form-control" name="cpu" />
                                    <label class="form-label" for="cpu">Procesador</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="grafica" class="form-control" name="gpu" />
                                    <label class="form-label" for="grafica">Grafica</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="ram" class="form-control" name="ram" />
                                    <label class="form-label" for="ram">Memoria Ram</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="pantalla" class="form-control" name="pantalla" />
                                    <label class="form-label" for="pantalla">Pantalla</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" id="bateria" class="form-control" name="bateria" />
                                    <label class="form-label" for="bateria">Bateria</label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="text" inputmode="numeric" id="documento" class="form-control" name="precio" />
                                    <label class="form-label" for="precio">Precio</label>
                                </div>
                            </div>
                        </div>
                        <!-- Imagen -->
                        <div class="mb-4">
                            <label for="imgProducto" class="form-label">Insertar imagen del Computador</label>
                            <input required class="form-control form-control-sm" type="file" id="imgProducto" accept=".jpg, .png, .webp" name="imgProducto">
                        </div>
                        <!-- Enviar -->
                        <div class="col mx-auto mb-4" style="max-width: 230px;">
                            <input type="hidden" name="añadir" />
                            <input type="hidden" name="user" value="<?php echo $user ?>" />
                            <input type="submit" onclick="alertaAñadirProducto()" class="btn btn-outline-success sbtn-block" value="Subir Producto" />
                            <a href="?page=tienda" class="btn btn-outline-danger">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>