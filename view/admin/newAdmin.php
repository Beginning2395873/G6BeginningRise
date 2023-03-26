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

?>

<?php require "view/layouts/headerA.php" ?>

<div class="container">
    <div class="row justify-content-center align-self-center ">
        <div class="col-12 mx-auto" style="max-width: 600px;">
            <div class="card mt-5">
                <div class="card-header">
                    <h3 class="text-center">
                        Registrar Administrador
                    </h3>
                    <?php
                    if (isset($_SESSION['msj']) and isset($_SESSION['icon'])) {
                        $respuesta = $_SESSION['msj'];
                        $icono = $_SESSION['icon'];
                    ?>
                        <script>
                            Swal.fire(
                                'Registro Administrador',
                                '<?php echo $respuesta ?>',
                                '<?php echo $icono ?>'
                            )
                        </script>
                    <?php
                        unset($_SESSION['msj']);
                        unset($_SESSION['icon']);
                    }
                    ?>
                    <p class="text-center">
                        Ingrese los datos solicitados para registrar a un nuevo administrador, recuerde que los campos
                        marcados con <span style="color: red;">(*)</span> son obligatorios y el número de documento va
                        sin puntos, comas o algún otro caracter.
                    </p>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo urlsite?>?page=registrarA" enctype="multipart/form-data" id="newAdmin">
                        <!-- Tipo y Número de Documento -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <select class="form-select" id="t_doc_admin" aria-label="Default select example" name="t_doc_admin">
                                        <option selected></option>
                                        <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                        <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                        <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                    </select>
                                    <label class="form-label" for="t_doc_admin">Tipo de documento<span style="color: red;">(*)</span></label>

                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="number" id="documento_admin" class="form-control" name="documento_admin" />
                                    <label class="form-label" for="documento_admin">Número de documento<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-outline mb-4">
                            <input required type="text" id="nombre_admin" class="form-control" name="nombre_admin" />
                            <label class="form-label" for="nombre_admin">Nombre Completo<span style="color: red;">(*)</span></label>
                        </div>

                        <!-- Correo -->
                        <div class="form-outline mb-4">
                            <input required type="email" id="correo_admin" class="form-control" name="correo_admin" />
                            <label class="form-label" for="correo_admin">Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>
                        <div class="form-outline mb-4">
                            <input required type="email" id="correo2_admin" class="form-control" name="correo2_admin" />
                            <label class="form-label" for="correo2_admin">Vuelva a ingresar el Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Contraseña -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="password" minlength="8" maxlength="20" id="pass_admin" class="form-control" name="pass_admin" />
                                    <label class="form-label" for="pass_admin">Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input required type="password" minlength="8" maxlength="20" id="pass2_admin" class="form-control" name="pass2_admin" />
                                    <label class="form-label" for="pass2_admin">Vuelva a ingresar la Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div id="passwordHelpBlock" class="form-text">
                                La contraseña debe tener entre 8 y 20 caracteres.
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="fotoPerfil_admin" class="form-label">Foto Perfil</label>
                            <input class="form-control" type="file" id="fotoPerfil_admin" accept=".jpg, .png, .webp" name="fotoPerfil_admin">
                        </div>

                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 90px;">
                            <input type="hidden" name="añadir" id="añadir">
                            <input type="submit" onclick="alertaAñadirAdmin()" class="btn btn-outline-primary btn-block mb-4" value="Registrar" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>