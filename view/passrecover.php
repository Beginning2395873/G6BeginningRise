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
                        <img src="<?php echo urlsite ?>/config/img/icon.png" height="48" width="48">
                        Beginning Rise
                    </h2>
                    <h3 class="text-center">
                        <i class="fa-solid fa-user-lock"></i>
                        Recuperar Contraseña
                    </h3>
                </div>
                <div class="card-body mt-2">
                    <div class="row">
                        <div class="col mx-auto" style="max-width: 250px;">
                            <form action="?page=passrecover&opcion=verificarUsuario" method="POST">
                                <!-- Email input -->
                                <div class="grupo">
                                    <input type="hidden" name="ingresar" value="">
                                    <input class="login" name="email" type="email" id="correo" required />
                                    <span class="highlight"></span>
                                    <span class="bar"></span>
                                    <label class="etiqueta" for="correo">Correo Electrónico</label>
                                    <div class="mt-2 text-start">
                                    <span class="fs-6 fst-italic">
                                        Se enviará un código a su correo.
                                    </span>
                                    </div>
                                </div>
                                <!-- Submit button -->
                                <div class="row d-flex justify-content-evenly mt-3">
                                    <div class="col mx-auto" style="max-width: 210px" >
                                        <input type="submit" class="btn btn-outline-light btn-block" value="Enviar" />
                                        <a href="?page=login" class="btn btn-outline-light btn-block me-2">Regresar</a>
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