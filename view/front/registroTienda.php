<?php require "view/layouts/header.php"; ?>

<div class="container">
<p class="text-danger"><?php echo (isset($_GET['msg'])) ? $_GET['msg'] : "" ?></p>
<div class="row justify-content-center align-self-center mt-5">
        <div class="col-12">
            <div class="card top-50 start-50 translate-middle w-50 h-auto" style="max-width: 600px;">
                <div class="card-header">
                    <h3 class="text-center">
                        Registro Tiendas
                    </h3>
                    <p class="text-center">
                        Ingrese los datos solicitados para registrarse, recuerde que los campos marcados con <span style="color: red;">(*)</span> son obligatorios.
                    </p>
                </div>
                <div class="card-body">
                    <form action="<?php echo urlsite?>?page=registrarTienda" method="POST" enctype="multipart/form-data">
                        <!-- NIT -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="number" id="nit" class="form-control" name="nit" required />
                                    <label class="form-label" for="nit">Número de Identificación Tributaria<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                        </div>

                        <!-- Nombre -->
                        <div class="form-outline mb-4">
                            <input type="text" id="nombreTienda" class="form-control" name="nombreTienda" required />
                            <label class="form-label" for="nombreTienda">Nombre de la Tienda<span style="color: red;">(*)</span></label>
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
                            <input type="number" id="telefono" class="form-control" name="telefono" required />
                            <label class="form-label" for="telefono">Teléfono<span style="color: red;">(*)</span></label>
                        </div>

                        <!--Contraseña -->
                        <div class="row mb-4">
                            <div class="col">
                                <div class="form-outline">
                                    <input type="password" id="pass" class="form-control" name="pass" required />
                                    <label class="form-label" for="pass">Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-outline">
                                    <input type="password" id="pass2" class="form-control" name="pass2" required />
                                    <label class="form-label" for="pass2">Vuelva a ingresar la Contraseña<span style="color: red;">(*)</span></label>
                                </div>
                            </div>
                            <div id="passwordHelpBlock" class="form-text">
                                Su contraseña debe tener entre 8 y 20 caracteres, contener letras, números, y no
                                debe contener espacios, caracteres especiales o emojis.
                            </div>
                        </div>

                        <!-- Imagen -->
                        <div class="mb-3">
                            <label for="fotoTienda" class="form-label" >Foto Perfil</label>
                            <input class="form-control" type="file" id="fotoTienda" accept=".jpg, .png, .webp" name="fotoTienda">
                        </div>

                        <!-- Enviar -->
                        <div class="col mx-auto" style="max-width: 150px;">
                            <input type="hidden" name="añadir" id="añadir">
                            <input type="submit" class="btn btn-outline-primary btn-block mb-4" value="Registrarse" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>