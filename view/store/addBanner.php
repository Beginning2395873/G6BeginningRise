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

// Consulta en Tiendas_productos para traer imagen
$db = new Conexion;
$db->conectar();
$queryid = $db->conexion->query(
    "SELECT * FROM tiendas WHERE email_tienda = '$user'"
);
$resid = $queryid->fetch();
// Almaceno NIT para futuras consultas
$nit = $resid[0];
$bannerProm = $resid[9];
?>

<?php require "view/layouts/headerT.php" ?>

<div class="container mt-5">
    <div class="row">
        <div class="col mx-auto" style="max-width: 90%;">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">
                        <i class="fa-solid fa-image me-2"></i>
                        Añadir Banner Promocional
                    </h3>
                </div>
                <div class="card-body">
                    <?php if ($bannerProm == '') { ?>
                        <div class="alert alert-info" role="alert">
                            No cuentan con Banner Promocional.
                        </div>
                    <?php } else { ?>
                        <div class="text-center">
                            <img height="500" width="953" src="<?php echo $bannerProm ?>" class="img-fluid border rounded" alt="Banner">
                        </div>
                    <?php } ?>
                    <div class="form-group px-5 mt-4">
                        <form action="?page=tienda&opcion=bannerAñadir" method="POST" enctype="multipart/form-data">
                            <!-- Imagen -->
                            <div class="mb-4">
                                <h4 class="text-center">
                                    Añadir/Actualizar Banner
                                </h4>
                                <label for="bannerProm" class="form-label">Subir imagen</label>
                                <input class="form-control form-control" type="file" id="bannerProm" accept=".jpg, .jpeg, .png, .webp" name="bannerProm">
                            </div>
                            <!-- Enviar -->
                            <div class="col mx-auto" style="max-width: 160px;">
                                <input type="hidden" name="añadirBanner">
                                <input type="hidden" name="nit" value="<?php echo $nit ?>" />
                                <input type="submit" class="btn btn-outline-success sbtn-block" value="Enviar" />
                                <a href="?page=tienda" class="btn btn-outline-danger">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<?php require "view/layouts/footer.php" ?>