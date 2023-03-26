<?php require "layouts/header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto" style="max-width: 475px;">
            <?php if (isset($_GET['msg'])) { ?>
                <div class="alert alert-danger text-center align-items-middle" style="max-width: 475px;">
                    <i class="fa-solid fa-circle-xmark me-2"></i>
                    <?php echo $_GET['msg'] ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['msj'])) { ?>
                <div class="alert alert-success text-center align-items-middle" style="max-width: 475px;">
                    <i class="fa-solid fa-circle-check me-2"></i>
                    <?php echo $_GET['msj'] ?>
                </div>
            <?php } ?>
            <div id="col-login" class="card mt-2" style="background-color: #0A1E35; color: #fff;">
                <div class="card-header">
                    <h2 class="text-center">
                        <i class="fa-solid fa-user-lock"></i>
                        Iniciar Sesión
                    </h2>
                </div>
                <div class="card-body mt-2">
                    <div class="row">
                        <div class="col mx-auto" style="max-width: 250px;">
                            <form action="<?php echo urlsite ?>?page=loginauth" method="POST">
                                <!-- Email input -->
                                <div class="grupo">
                                    <input type="hidden" name="ingresar" value="">
                                    <input class="login" name="correo" type="email" id="correo" required />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="etiqueta" for="correo">Correo Electrónico</label>
                                </div>

                                <!-- Password input -->
                                <div class="grupo">
                                    <input class="login" name="pass" type="password" id="pass" required />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="etiqueta" for="pass">Contraseña</label>
                                </div>

                                <!-- Recordar / Olvidar Contraseña  -->
                                <div class="row mb-4">
                                    <div class="col mx-auto" style="max-width: 200px;">
                                        <a class="" href="?page=passrecover" style="color: #fff;">¿Olvidó su
                                            contraseña?</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col mx-auto" style="max-width: 150px;">
                                            <input type="submit" class="btn btn-outline-light btn-block" value="Iniciar Sesión" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "layouts/footer.php" ?>