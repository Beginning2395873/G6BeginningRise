<?php
session_start();

$user = $_SESSION['login'];
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

<?php require "view/layouts/headerT.php"; ?>

<div class="container rounded bg-white mt-5 mb-5">
    <div class="row">
        <!-- Columna de Foto -->
        <div class="col-md-4 border-end">
            <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                <img class="rounded-circle" width="225px" alt="Foto" src="<?php echo $arreglo['foto_tienda'] ?>">
                <span class="fw-bold fs-3">
                    Tienda <?php echo $arreglo['nombre_tienda']; ?>
                </span>
                <span class="text-black-50 fs-5">
                    <?php echo $arreglo['email_tienda']; ?>
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
                            N.I.T: <?php echo $nformat ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Dirección: <?php echo $arreglo['direccion_tienda']; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Teléfono: <?php echo $result; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Correo: <?php echo $arreglo['email_tienda']; ?>
                        </li>
                        <li class="mb-3 fs-5">
                            Ciudad: Bogotá
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Opciones -->
        <div class="col-md-4">
            <div class="p-3 py-5 mt-4">
                <div class="d-grid gap-3">
                    <a href="<?php echo urlsite ?>?page=tienda&opcion=añadirProducto" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-upload me-2"></i>
                        Subir Productos
                    </a>
                    <a href="<?php echo urlsite ?>?page=tienda&opcion=listaProductos" class="btn btn-primary btn-lg">
                        <i class="fa-solid fa-list me-2"></i>
                        Ver/Editar Productos
                    </a>
                    <a href="" class="btn btn-success btn-lg">
                        <i class="fa-sharp fa-solid fa-image-landscape me-2"></i>
                        <i class="fa-solid fa-image"></i>
                        Añadir Banner Promocional
                    </a>
                    <a href="estadisticas_venta.php" class="btn btn-success btn-lg">
                    <i class="fa-solid fa-table-columns me-2"></i>
                        Informe de Ventas
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>