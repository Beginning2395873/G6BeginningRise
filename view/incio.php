<?php require "view/layouts/header.php" ?>

<!-- carrusel -->
<div class="container text-dark rounded-4 ">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <span class="border-dark">
            <div id="carouselBasicExample" class="carousel slide carousel-fade " data-mdb-ride="carousel">
                <!-- indicadores -->
                <div class="carousel-indicators">
                    <button type="" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="1"></button>
                    <button type="" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="2"></button>
                    <button type="" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="3"></button>
                </div>
                <!-- carrusel cuerpo -->
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="<?php echo urlsite ?>/config/img/1.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="1" focusable="true" width="800" height="400">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo urlsite ?>/config/img/2.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="2" focusable="false" width="800" height="400">
                    </div>
                    <div class="carousel-item">
                        <img src="<?php echo urlsite ?>/config/img/3.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="3" focusable="false" width="800" height="400">
                    </div>
                    <!-- botones -->
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"> </span>
                </button>
            </div>
    </div>
</div>
</span>
<br>
<div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        <div class="col">
            <div class="card">
                <a href="#"><img class="card-img-top" src="<?php echo urlsite ?>/config/img/portatil 1.jpg" width="250" height="200"></a>
                <div class="card-body">
                    <p style="color:rgb(35, 4, 59);">
                        Precio en oferta = $1.400.000
                    </p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <a class="navbar-brand align-items-center" href="#"><img class="card-img-top" src="<?php echo urlsite ?>/config/img/portatil 2.png" width="250" height="200"></a>
                <div class="card-body">

                    <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.950.000 </p>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <a class="navbar-brand" href="#"><img class="card-img-top" src="<?php echo urlsite ?>/config/img/portatil 3.jpg" width="250" height="200"></a>
                <div class="card-body">

                    <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.200.000</p>
                </div>
            </div>

        </div>
        <div class="col">
            <div class="card">
                <a class="navbar-brand" href="#"><img class="card-img-top" src="<?php echo urlsite ?>config/img/portatil 4.jpg" width="250" height="200"></a>
                <div class="card-body">

                    <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.900.000 </p>
                </div>
            </div>

        </div>
        <input type="submit" name="registrar" class="d-grid gap-2 col-2 mx-auto btn btn-light btn-block mb " value="VER MAS ⬇" />
    </div>
</div>

<?php require "view/layouts/footer.php" ?>