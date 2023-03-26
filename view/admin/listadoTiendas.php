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

// Conexión
$connect = new Conexion();
$connect->conectar();
// Consulta
$query2 = $connect->conexion->prepare(
    "SELECT tiendas.nit_tienda, 
    tiendas.nombre_tienda, 
    tiendas.direccion_tienda, 
    tiendas.telefono_tienda, 
    tiendas.email_tienda, 
    tiendas.foto_tienda, 
    tiendas.estado 
    FROM tiendas"
);
$query2->execute();
$arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
?>
<?php require "view/layouts/headerA.php" ?>
<div class="container-fluid my-4">
    <div class="row d-flex justify-content-center">
        <div class="rounded col-sm-11 col-md-11 col-lg-11 col-xl-11 bg-white">
            <!-- nit, nombre, dirección, telefono, correo, foto, estado, activar/desactivar -->
            <div class="my-2">
                <h3 class="text-center my-3">Lista de Empresas</h3>
                <!-- Botones -->
                <div class="row d-flex justify-content-start">
                    <!-- Regresar -->
                    <div class="col" style="max-width: 140px;">
                        <a onclick="window.history.back();" class="btn btn-dark my-2">
                            <i class="fa-solid fa-arrow-left me-2"></i>
                            Regresar
                        </a>
                    </div>
                    <!-- Listar -->
                    <div class="col" style="max-width: 120px;">
                        <a href="" class="btn btn-secondary my-2">
                            <i class="fa-solid fa-list me-2"></i>
                            Listar
                        </a>
                    </div>
                </div>
            </div>
            <div class="table-responsive px-2 mb-4">
                <table class="table table-hover align-middle" id="myTable">
                    <thead class="table-secondary">
                        <tr>
                            <th>NIT</th>
                            <th>Nombre de la Empresa</th>
                            <th>Dirección</th>
                            <th>Teléfono</th>
                            <th>Correo Electrónico</th>
                            <th>Foto de perfil</th>
                            <th>Estado</th>
                            <th class="no-exportar">Activar/Desactivar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($arreglo2 === false) { ?>
                            <div class="alert alert-info" role="alert">
                                <?php echo "No hay registros" ?>
                            </div>
                            <?php } else {
                            do {
                                // Estado
                                $stauts = '';
                                if ($arreglo2['estado'] == 0) {
                                    $clase = 'text-center py-auto my-1 p-2 rounded bg-danger text-light fw-semibold';
                                    $status = 'Inactivo';
                                } else if ($arreglo2['estado'] == 1) {
                                    $status = 'Activo';
                                    $clase = 'text-center py-auto my-1 p-2 rounded bg-success text-light fw-semibold';
                                }
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $arreglo2['nit_tienda'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nombre_tienda'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['direccion_tienda'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['telefono_tienda'] ?>
                                    </td>
                                    <td><?php echo $arreglo2['email_tienda'] ?></td>
                                    <td class="text-center">
                                        <?php if ($arreglo2['foto_tienda'] === "config/img/persona/") { ?>
                                            <img src="<?php echo urlsite ?>/config/img/persona/foto_gen.png" alt="Foto" width="50" height="50">
                                        <?php } else { ?>
                                            <img src="<?php echo $arreglo2['foto_tienda'] ?>" alt="Foto" class="rounded-circle" width="45" height="45">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span class="<?php echo $clase ?>">
                                            <?php echo $status ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($status == 'Activo') {
                                            echo '
                                                <button onclick="confirmarDesactivarTienda(`' . $arreglo2['nit_tienda'] . '`)" class="btn btn-outline-danger">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                ';
                                        } elseif ($status == "Inactivo") {
                                            echo '
                                                <button onclick="confirmarActivarTienda(`' . $arreglo2['nit_tienda'] . '`)" class="btn btn-outline-success">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </button>
                                                ';
                                        }
                                        ?>
                                    </td>
                                </tr>
                        <?php } while ($arreglo2 = $query2->fetch(PDO::FETCH_ASSOC));
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require "view/layouts/footer.php" ?>