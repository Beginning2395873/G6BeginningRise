<?php require "view/layouts/header.php" ?>

<div class="container">
<div class="row justify-content-center align-self-center mt-5 ">
    <div class="col-12">
        <div class="card top-50 start-50 translate-middle w-50 h-auto" style="max-width: 600px;">
            <div class="card-header">
                <h3 class="text-center">
                    <i class="fa-solid fa-user"></i>
                    Registro Comprador
                </h3>
                <p class="text-center">
                    Ingrese los datos solicitados para registrarse, recuerde que los campos marcados con<span style="color: red;" class="ms-1">(*)</span> son obligatorios.</p>
            </div>
            <div class="card-body">

                <form method="POST" action="<?php echo urlsite ?>?page=registrarComprador" enctype="multipart/form-data">
                    <!-- Tipo y Número de Documento -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <select class="form-select" aria-label="Default select example" name="t_doc" id="t_doc">
                                    <option selected></option>
                                    <option value="Cédula de Ciudadanía">Cédula de Ciudadanía</option>
                                    <option value="Cédula de Extranjería">Cédula de Extranjería</option>
                                    <option value="Tarjeta de Identidad">Tarjeta de Identidad</option>
                                </select>
                                <label class="form-label" for="t_doc">Tipo de documento<span style="color: red;" class="ms-1">(*)</span></label>

                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input required type="number" id="documento" class="form-control" name="documento" inputmode="numeric" />
                                <label class="form-label" for="documento">Número de documento<span style="color: red;" class="ms-1">(*)</span></label>
                            </div>
                        </div>
                    </div>

                    <!-- Nombre -->
                    <div class="form-outline mb-4">
                        <input required type="text" id="nombre" class="form-control" name="nombre" />
                        <label class="form-label" for="nombre">Nombre Completo<span style="color: red;" class="ms-1">(*)</span></label>
                    </div>

                    <!-- Correo -->
                    <div class="form-outline mb-4">
                        <input required type="email" id="correo" class="form-control" name="correo" />
                        <label class="form-label" for="correo">Correo Electrónico<span style="color: red;" class="ms-1">(*)</span></label>
                    </div>
                    <div class="form-outline mb-4">
                        <input required type="email" id="correo2" class="form-control" name="correo2" />
                        <label class="form-label" for="correo2">Vuelva a ingresar el Correo Electrónico<span style="color: red;" class="ms-1">(*)</span></label>
                    </div>

                    <!--Dirección-->
                    <div class="form-outline mb-4">
                        <input required type="text" id="direccion" class="form-control" name="direccion" />
                        <label class="form-label" for="nombre">Dirección<span style="color: red;" class="ms-1">(*)</span></label>
                    </div>

                    <!--Telefóno-->
                    <div class="form-outline mb-4">
                        <input required type="number" id="telefono" class="form-control" name="telefono" inputmode="numeric" />
                        <label class="form-label" for="nombre">Telefono<span style="color: red;" class="ms-1">(*)</span></label>
                    </div>

                    <!--Contraseña -->
                    <div class="row mb-4">
                        <div class="col">
                            <div class="form-outline">
                                <input required type="password" id="pass" class="form-control" name="pass" />
                                <label class="form-label" for="pass">Contraseña<span style="color: red;" class="ms-1">(*)</span></label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-outline">
                                <input required type="password" id="pass2" class="form-control" name="pass2" />
                                <label class="form-label" for="pass2">Vuelva a ingresar la Contraseña<span style="color: red;" class="ms-1">(*)</span></label>
                            </div>
                        </div>
                        <div id="passwordHelpBlock" class="form-text">
                            Su contraseña debe tener entre 8 y 20 caracteres, contener letras, números, y no debe
                            contener espacios, caracteres especiales o emojis.
                        </div>
                    </div>

                    <!-- Imagen -->
                    <div class="mb-3">
                        <label for="fotoPerfil" class="form-label">Foto Perfil</label>
                        <input class="form-control" type="file" id="fotoPerfil" accept=".jpg, .png, .webp" name="fotoPerfil">
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