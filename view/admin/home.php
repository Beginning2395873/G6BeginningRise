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

$sql2 = $db->conexion->prepare("SELECT * FROM administradores WHERE email_administrador = '$user'");
$sql2->execute();
if ($sql2->fetch(PDO::FETCH_NUM)) {
    $sql = $db->conexion->prepare("SELECT * FROM persona WHERE email_persona = '$user'");
    $sql->execute();
    $arreglo = $sql->fetch(PDO::FETCH_ASSOC);
    $format = $arreglo['num_doc_persona'];
    if (strlen($format) == 8) {
        $nformat = substr($format, 0, 2) . "." . substr($format, 2, 3) . "." . substr($format, 5, 3);
    } elseif (strlen($format) == 10) {
        $nformat = substr($format, 0, 1) . "." . substr($format, 1, 3) . "." . substr($format, 4, 3) . "." . substr($format, 7, 3);
    }
} else {
    echo "";
}

?>

<?php require "view/layouts/headerA.php" ?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <!-- Columna de Foto -->
        <div class="col-md-4 border-end">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle" width="225px" height="225px" alt="Foto" src="<?php echo $arreglo['foto_perfil'] ?>">
                <span class="fw-bold fs-3">
                    ¡Bienvenido <?php echo $arreglo['nombre_persona']; ?>!
                </span>
                <span class="text-black-50 fs-5">
                    <?php echo $arreglo['email_persona']; ?>
                </span>
            </div>
        </div>
        <!-- Demás Info -->
        <div class="col-md-4 border-end">
            <div class="p-3 py-5">
                <!-- Datos Básicos -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-end ">Información Básica</h3>
                </div>
                <div class="row mt-2">
                    <ul class="list-unstyled">
                        <li class="mb-3 fs-5">
                            Tipo de Documento: <?php echo $arreglo['tipo_documento_persona'] ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Número de Documento: <?php echo $nformat; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Nombre: <?php echo $arreglo['nombre_persona']; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Correo Electrónico: <?php echo $arreglo['email_persona']; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Ciudad: Bogotá.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Opciones -->
        <div class="col-md-4">
            <div class="p-3 py-5">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h3 class="text-center ">Opciones</h3>
                </div>
                <div class="d-grid gap-3">
                    <a href="<?php echo urlsite ?>?page=admin&opcion=listaTiendas" class="btn btn-success btn-lg">
                        <i class="fa-solid fa-building"></i></i>
                        Lista de Empresas
                    </a>
                    <a href="<?php echo urlsite ?>?page=admin&opcion=informeTotal" class="btn btn-success btn-lg">
                        <i class="fa-solid fa-cart-shopping me-2"></i>
                        Informe Total de Ventas
                    </a>
                    <a href="<?php echo urlsite ?>?page=admin&opcion=listaCompradores" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-users me-2"></i>
                        Lista de Compradores
                    </a>
                    <a href="<?php echo urlsite ?>?page=admin&opcion=listaAdmin" class="btn btn-dark btn-lg">
                        <i class="fa-solid fa-user-gear me-2"></i>
                        Lista de Administradores
                    </a>
                    <a href="<?php echo urlsite ?>?page=admin&opcion=nuevoAdmin" class="btn btn-dark btn-lg">
                        <i class="fa-solid fa-user-plus me-2"></i>
                        Añadir Nuevo Administrador
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


<?php require "view/layouts/footer.php" ?>