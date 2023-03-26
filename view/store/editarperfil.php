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
$sql = $db->conexion->prepare("SELECT * FROM tiendas WHERE email_tienda = '$user'");
$sql->execute();
$arreglo = $sql->fetch(PDO::FETCH_ASSOC);

$tel = $arreglo['telefono_tienda'];
$result = $format = substr($tel, 0, 3) . " " . substr($tel, 3, 3) . " " . substr($tel, 6, 4);
$format = $arreglo['nit_tienda'];
$nformat = substr($format, 0, 3) . "." . substr($format, 3, 3) . "." . substr($format, 6, 3) . "-" . substr($format, 9, 1)

?>

<?php require "view/layouts/headerT.php" ?>

<div class="container rounded bg-white mt-5 mb-5 mx-auto" style="max-width: 700px;">
    <div class="row">
        <!-- Demás Info -->
        <div class="col-md-12">
            <div class="p-3 py-2">
                <!-- Datos Básicos -->
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle" width="150px" alt="Foto" src="<?php echo $arreglo['foto_tienda'] ?>">
                </div>
                <div class="justify-content-between mb-3">
                    <h4 class="text-left fs-2 fw-bold">Editar Perfil</h4>
                </div>
                <?php
                if (isset($_SESSION['msj']) and isset($_SESSION['icon'])) {
                    $respuesta = $_SESSION['msj'];
                    $icono = $_SESSION['icon'];
                ?>
                    <script>
                        Swal.fire(
                            'Editar Perfil',
                            '<?php echo $respuesta ?>',
                            '<?php echo $icono ?>'
                        )
                    </script>
                <?php
                    unset($_SESSION['msj']);
                    unset($_SESSION['icon']);
                }
                ?>
                <p class="text-left">
                    Los campos marcados con<span class="ms-1" style="color: red;">(*)</span> son obligatorios.
                </p>
                <!-- Formulario -->
                <form action="<?php echo urlsite ?>?page=tienda&opcion=tiendaPerfilEditar" method="POST" enctype="multipart/form-data" id="editarTienda">
                    <!-- NIT y Nombre -->
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nit">Número de Identificación Tributaria (NIT)<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" inputmode="numeric" id="documento" name="nit" value="<?php echo $arreglo['nit_tienda'] ?>" readonly />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nombreTienda">Nombre de la tienda<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="nombreTienda" name="nombreTienda" value="<?php echo $arreglo['nombre_tienda'] ?>" required />
                        </div>
                    </div>
                    <!-- Demás Info -->
                    <div class="row mt-3">
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="direccion">Dirección<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="text" id="direccion" name="direccion" value="<?php echo $arreglo['direccion_tienda'] ?>" required />
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="telefono">Teléfono<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" inputmode="numeric" type="text" id="telefono" name="telefono" value="<?php echo $arreglo['telefono_tienda'] ?>" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="form-label" for="correoTienda">Correo Electrónico<span class="ms-1" style="color: red;">(*)</span></label>
                            <input class="form-control" type="email" id="correoTienda" name="correoTienda" value="<?php echo $arreglo['email_tienda'] ?>" />
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="fotoTienda" class="form-label">Foto de Perfil</label>
                            <input class="form-control" type="file" id="fotoTienda" accept=".jpg, .png, .webp" name="fotoTienda">
                        </div>
                    </div>
                    <!-- Enviar -->
                    <!-- Enviar -->
                    <div class="col mx-auto  mt-3 mb-5" style="max-width: 250px;">
                        <input type="hidden" name="modificar" />
                        <input type="submit" onclick="alertaModificarTienda()" class="btn btn-outline-success btn-block" value="Guardar Cambios" />
                        <a href="?page=tienda" class="btn btn-outline-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>