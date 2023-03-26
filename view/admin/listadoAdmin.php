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
    "SELECT persona.tipo_documento_persona, 
    persona.num_doc_persona, 
    persona.nombre_persona, 
    administradores.email_administrador, 
    persona.foto_perfil,
    persona.estado 
    from administradores 
    INNER JOIN persona ON administradores.email_administrador = persona.email_persona"
);
$query2->execute();
$arreglo2 = $query2->fetch(PDO::FETCH_ASSOC);
?>
<?php require "view/layouts/headerA.php" ?>
<div class="container-fluid my-4">
    <div class="row d-flex justify-content-center">
        <div class="rounded col-sm-11 col-md-11 col-lg-11 col-xl-11 bg-white">
            <!-- T_doc, num_doc, nombre, correo, foto, estado, activar/desactivar, eliminar -->
            <div class="my-2">
                <h3 class="text-center my-3">Lista de Administradores</h3>
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
                            <th>Tipo de Documento</th>
                            <th>Número de Documento</th>
                            <th>Nombre Completo</th>
                            <th>Correo Electrónico</th>
                            <th class="no-exportar">Foto de Perfil</th>
                            <th>Estado</th>
                            <th class="no-exportar">Activar/Desactivar</th>
                            <th class="no-exportar">Eliminar</th>
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
                                        <?php echo $arreglo2['tipo_documento_persona'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['num_doc_persona'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['nombre_persona'] ?>
                                    </td>
                                    <td>
                                        <?php echo $arreglo2['email_administrador'] ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($arreglo2['foto_perfil'] === "config/img/persona/") { ?>
                                            <img src="<?php echo urlsite ?>/config/img/persona/foto_gen.png" alt="Foto" width="75" height="75">
                                        <?php } else { ?>
                                            <img src="<?php echo $arreglo2['foto_perfil'] ?>" alt="Foto" class="rounded-circle" width="75" height="75">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <span class="<?php echo $clase ?>">
                                            <?php echo $status ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($arreglo2['email_administrador'] == $user) { ?>
                                            <!-- Nada -->
                                        <?php } else { ?>
                                            <?php if ($status == 'Activo') {
                                                echo '
                                                <button onclick="confirmarDesactivarAdmin(`' . $arreglo2['email_administrador'] . '`)" class="btn btn-outline-danger">
                                                    <i class="fa-regular fa-circle-xmark"></i>
                                                </button>
                                                ';
                                            } elseif ($status == "Inactivo") {
                                                echo '
                                                <button onclick="confirmarActivarAdmin(`' . $arreglo2['email_administrador'] . '`)" class="btn btn-outline-success">
                                                    <i class="fa-regular fa-circle-check"></i>
                                                </button>
                                                ';
                                            }
                                            ?>

                                        <?php } ?>
                                    </td>
                                    <td class="text-center">
                                        <?php if ($arreglo2['email_administrador'] == $user) {
                                            // Nada
                                        } else {
                                            echo '
                                            <button onclick="confirmarEliminarAdmin(`' . $arreglo2['email_administrador'] . '`)" class="btn btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            ';
                                        } ?>
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