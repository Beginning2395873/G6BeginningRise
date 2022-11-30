<?php require "layouts/header.php" ?>
<div class="container">
    <div class="row">
        <div class="col-12 mx-auto" style="max-width: 500px;">
            <div id="col-login" class="card mt-5" style="background-color: #0A1E35; color: #fff;">
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
                                <!-- <div class="row mb-4">
                                    <div class="col">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                                            <label class="form-check-label" for="flexCheckChecked">Recordar</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <a href="passrecover.php" style="color: #fff; text-decoration: none;">¿Olvidó su
                                            contraseña?</a>
                                    </div>
                                </div> -->

                                <!-- Submit button -->
                                <div class="container">
                                    <div class="row">
                                        <div class="col mx-auto" style="max-width: 150px;">
                                            <input type="submit" class="btn btn-outline-light btn-block" value="Iniciar Sesión" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="text-danger"><?php echo (isset($_GET['msg'])) ? $_GET['msg'] : "" ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require "layouts/footer.php" ?>