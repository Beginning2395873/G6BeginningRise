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
$sql = $db->conexion->prepare("SELECT * FROM persona WHERE email_persona = '$user'");
$sql->execute();
$arreglo = $sql->fetch(PDO::FETCH_ASSOC);
$t_doc = $arreglo['tipo_documento_persona'];
if ($t_doc == "C.C.") {
    $t_doc = "Cédula de Ciudadanía";
} else if ($t_doc == "C.E.") {
    $t_doc = "Cédula de Extranjería";
} else if ($t_doc == "T.I.") {
    $t_doc = "Tarjeta de Identidad";
}

// if (isset($_SESSION['msj']) and isset($_SESSION['icon'])) {
//     echo $_SESSION['msj'];
//     echo $_SESSION['icon'];
// }

?>

<?php require "view/layouts/headerA.php" ?>


<div class="container rounded bg-white mt-5 mb-5 mx-auto" style="max-width: 700px;">
    <div class="row">
        <!-- Demás Info -->
        <div class="col-md-12">
            <div class="p-3 py-2">
                <!-- Datos Básicos -->
                <div class="d-flex flex-column align-items-center text-center pt-4 p-3 py-3">
                    <img class="rounded-circle" width="200px" height="200px" alt="Foto" src="<?php echo $arreglo['foto_perfil'] ?>">
                </div>
                <div class="justify-content-between mb-3">
                    <h4 class="text-left fs-2 fw-bold text-center">Editar Perfil</h4>
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
                </div>
                <p class="text-left">
                    Los campos marcados con<span class="ms-1" style="color: red;">(*)</span> son obligatorios.
                </p>
                <!-- Formulario -->
                <form action="<?php echo urlsite ?>?page=admin&opcion=adminPerfilEditar" method="POST" enctype="multipart/form-data" id="editarAdmin">
                    <!-- Correo y Nombre -->
                    <div class="row mt-2">
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="correo_admin">Correo Electrónico<span style="color: red;">(*)</span></label>
                            <input type="email" id="correo_admin" class="form-control" name="correo_admin" readonly value="<?php echo $arreglo['email_persona'] ?>" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="nombre_admin">Nombre Completo<span style="color: red;">(*)</span></label>
                            <input type="text" id="nombre_admin" class="form-control" name="nombre_admin" value="<?php echo $arreglo['nombre_persona'] ?>" />
                        </div>
                    </div>
                    <!-- Demás Info -->
                    <div class="row mt-3">
                        <!-- Tipo Documento -->
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="t_doc_admin">Tipo de documento<span style="color: red;">(*)</span></label>
                            <select class="form-select" aria-label="Default select example" name="t_doc_admin" id="t_doc_admin">
                                <option selected value="<?php echo $t_doc ?>"><?php echo $t_doc ?></option>
                                <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                            </select>
                        </div>
                        <!-- Número Documento -->
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="documento_admin">Número de documento<span style="color: red;">(*)</span></label>
                            <input type="number" id="documento_admin" class="form-control" name="documento_admin" inputmode="numeric" value="<?php echo $arreglo['num_doc_persona'] ?>" />
                        </div>
                        <!-- <div class="col-md-6 mb-2">
                            <label class="form-label" for="pass_admin">Nueva Contraseña<span style="color: red;">(*)</span></label>
                            <input type="password" id="pass_admin" class="form-control" name="pass_admin" />
                        </div>
                        <div class="col-md-6 mb-2">
                            <label class="form-label" for="pass2_admin">Vuelva a ingresar la Contraseña<span style="color: red;">(*)</span></label>
                            <input type="password" id="pass2_admin" class="form-control" name="pass2_admin" />
                        </div> -->
                        <div class="col-md-12 mb-3">
                            <label for="fotoPerfil_admin" class="form-label">Foto Perfil</label>
                            <input class="form-control" type="file" id="fotoPerfil_admin" accept=".jpg, .png, .webp" name="fotoPerfil_admin">
                        </div>
                    </div>
                    <!-- Enviar -->
                    <div class="col mx-auto mt-3 mb-5" style="max-width: 250px;">
                        <input type="hidden" name="modificar" />
                        <input type="submit" onclick="alertaModificarAdmin()" class="btn btn-outline-success btn-block" value="Guardar Cambios" />
                        <a href="?page=admin" class="btn btn-outline-danger">Cancelar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>