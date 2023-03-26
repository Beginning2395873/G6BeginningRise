<?php
if (isset($_GET['msj'])) {
    $msjid = $_GET['msj'];
}
?>

<?php require "view/layouts/header.php"; ?>

<div class="container">
    <p class="text-danger"></p>
    <div class="row justify-content-center align-self-center mt-5">
        <div class="col-12">
            <div class="card mx-auto" style="max-width: 750px;">
                <div class="card-header">
                    <!-- botón de regreso -->
                    <div class="row">
                        <div class="col-3">
                            <a href="<?php echo urlsite ?>?page=registro" class="btn btn-dark"> <i class="fa-solid fa-arrow-left"></i> Volver</a>
                        </div>
                        <div class="col-6">
                            <h3 class="text-center">
                            <i class="fa-solid fa-building me-2"></i>
                                Registro Empresas
                            </h3>
                            <?php if (isset($msjid)) {
                                if ($msjid == 1) { ?>
                                    <!-- 1: Exito -->
                                    <script>
                                        Swal.fire(
                                            'Registro Empresa',
                                            '¡Registro Exitoso!',
                                            'success'
                                        )
                                    </script>
                            <?php } elseif ($msjid == 2) { ?>
                                    <!-- 2: error -->
                                    <script>
                                        Swal.fire(
                                            'Registro Empresa',
                                            'Ocurrió un error, inténtelo nuevamente',
                                            'error'
                                        )
                                    </script>
                                <?php } elseif ($msjid == 3) { ?>
                                    <!-- 3: verificar -->
                                    <script>
                                        Swal.fire(
                                            'Registro Empresa',
                                            'Los datos ingresados no coinciden',
                                            'warning'
                                        )
                                    </script>
                                <?php } else { ?>
                                    <script>
                                        window.location = "?page=registroTienda";
                                    </script>
                                <?php }
                            } ?>
                        </div>
                    </div>
                    <p class="text-center">
                        Ingrese los datos solicitados para registrarse, recuerde que los campos marcados con <span style="color: red;">(*)</span> son obligatorios.
                    </p>
                </div>
                <div class="card-body">
                    <form action="<?php echo urlsite ?>?page=registrarTienda" method="POST" enctype="multipart/form-data" id="newTienda">
                        <!-- NIT -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="text" class="form-control" name="nit" id="documento" maxlength="10" inputmode="numeric" required />
                                    <label class="form-label" for="nit">Número de Identificación Tributaria<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-outline mb-4">
                            <input type="text" id="nombreTienda" class="form-control" name="nombreTienda" required />
                            <label class="form-label" for="nombreTienda">Nombre de la Empresa<span style="color: red;">(*)</span></label>
                        </div>

                        <!-- Correo -->
                        <div class="form-outline mb-4">
                            <input type="email" id="correoTienda" class="form-control" name="correoTienda" required />
                            <label class="form-label" for="correoTienda">Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>
                        <div class="form-outline mb-4">
                            <input type="email" id="correo2Tienda" class="form-control" name="correo2Tienda" required />
                            <label class="form-label" for="correo2Tienda">Vuelva a ingresar el Correo Electrónico<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Dirección-->
                        <div class="form-outline mb-4">
                            <input type="text" id="direccion" class="form-control" name="direccion" required />
                            <label class="form-label" for="direccion">Dirección<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Telefóno-->
                        <div class="form-outline mb-4">
                            <input required type="text" id="telefono" maxlength="10" class="form-control" name="telefono" inputmode="numeric" />
                            <label class="form-label" for="nombre">Telefono<span style="color: red;" class="ms-1">(*)</span></label>
                        </div>

                        <!--Contraseña -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input minlength="8" maxlength="20" type="password" id="pass" class="form-control" name="pass" required />
                                    <label class="form-label" for="pass">Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input minlength="8" maxlength="20" type="password" id="pass2" class="form-control" name="pass2" required />
                                    <label class="form-label" for="pass2">Vuelva a ingresar la Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div id="passwordHelpBlock" class="form-text">
                                Su contraseña debe tener entre 8 y 20 caracteres.
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="fotoTienda" class="form-label">Foto Perfil</label>
                            <input class="form-control" type="file" id="fotoTienda" accept=".jpg, .png, .webp" name="fotoTienda">
                        </div>

                        <!-- Enviar -->
                        <div class="col mx-auto mb-4" style="max-width: 200px;">
                            <input type="hidden" name="añadir" id="añadir">
                            <input onclick="alertaAñadirTienda()" type="submit" class="btn btn-outline-primary btn-block" value="Registrarse" />
                            <a href="?page=registro" class="btn btn-outline-danger btn-block">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>