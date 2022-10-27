<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="config/img/favicon.ico">
  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
  <!-- Bootstrap CSS-->
  <link rel="stylesheet" href="./config/css/bootstrap.min.css">
  <link rel="stylesheet" href="./config/css/cositas.css">
  <title>Beginning Rise</title>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

<body>
  <header>
    <!-- menu -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <div class="col-3">
          <a class="navbar-brand" href="./index.php">
            <img src="config/img/icon.png" height="30" width="30"> BeginningRise</a>
        </div>
        <div class="col-7 mx-auto" style="max-width: 600px;">
          <form class="d-flex" role="search">
            <input class="form-control me-2" type="search" placeholder="Buscar productos..." aria-label="Search">
            <a href="view/busqueda.php" class="btn btn-outline-primary" type="submit"><i class="fa-solid fa-magnifying-glass"></i></a>
          </form>
        </div>
        <div class="col-2 px-2">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <!-- <div class="collapse navbar-collapse align-self-end" id="navbarTogglerDemo02">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="btn text-light btn-outline-link px-2 me-2" href="view/registro.php">Registrarse</a>
              </li>
              <li class="nav-item">
                <a class="btn text-light btn-outline-link px-2 me-2" href="view/login.php">Acceder</a>
              </li>
            </ul>
          </div> -->
        </div>
      </div>
    </nav>
  </header>

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
              <img src="config/img/1.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="1" focusable="true" width="800" height="400">
            </div>
            <div class="carousel-item">
              <img src="config/img/2.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="2" focusable="false" width="800" height="400">
            </div>
            <div class="carousel-item">
              <img src="config/img/3.png" class="bd-placeholder-img bd-placeholder-img-lg d-block w-100" aria-label="3" focusable="false" width="800" height="400">
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
          <a href="#"><img class="card-img-top" src="config/img/portatil 1.jpg" width="250" height="200"></a>
          <div class="card-body">
            <p style="color:rgb(35, 4, 59);">
              Precio en oferta = $1.400.000
            </p>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="card">
          <a class="navbar-brand align-items-center" href="#"><img class="card-img-top" src="config/img/portatil 2.png" width="250" height="200"></a>
          <div class="card-body">

            <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.950.000 </p>
          </div>
        </div>

      </div>
      <div class="col">
        <div class="card">
          <a class="navbar-brand" href="#"><img class="card-img-top" src="config/img/portatil 3.jpg" width="250" height="200"></a>
          <div class="card-body">

            <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.200.000</p>
          </div>
        </div>

      </div>
      <div class="col">
        <div class="card">
          <a class="navbar-brand" href="#"><img class="card-img-top" src="config/img/portatil 4.jpg" width="250" height="200"></a>
          <div class="card-body">

            <p style="color:rgb(35, 4, 59);">Precio en oferta = $1.900.000 </p>
          </div>
        </div>

      </div>
      <input type="submit" name="registrar" class="d-grid gap-2 col-2 mx-auto btn btn-light btn-block mb " value="VER MAS ⬇" />
    </div>
  </div>
  <!-- Footer -->
  <footer class="bg-dark text-center text-lg-start text-white mt-5">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Links -->
      <section class="">
        <!--Grid row-->
        <div class="row">
          <!-- Grid column -->
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">
              Beginning Rise
            </h6>
            <p>
              Sistema de Información para la compra y venta de equipos portátiles, enfocado a nuevos
              emprendedores y personas que no poseen mucho conocimiento en computadores.
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Productos</h6>
            <p>
              <a class="text-white">www.beginningrise.com</a>
            </p>
          </div>
          <!-- Grid column -->

          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <hr class="w-100 clearfix d-md-none" />

          <!-- Grid column -->
          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Contacto</h6>
            <p><i class="fas fa-home mr-3"></i> Bogotá, Colombia</p>
            <p><i class="fas fa-envelope mr-3"></i> beginningrise@gmail.com</p>
            <p><i class="fas fa-phone mr-3"></i>601 604 6088</p>
            <p><i class="fas fa-phone mr-3"></i>601 566 1469</p>
          </div>
          <!-- Grid column -->

          <!-- Grid column -->
          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mt-3">
            <h6 class="text-uppercase mb-4 font-weight-bold">Redes</h6>

            <!-- Facebook -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #3b5998" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

            <!-- Twitter -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #55acee" href="#!" role="button"><i class="fab fa-twitter"></i></a>

            <!-- Google -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #dd4b39" href="#!" role="button"><i class="fab fa-google"></i></a>

            <!-- Instagram -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #ac2bac" href="#!" role="button"><i class="fab fa-instagram"></i></a>

            <!-- Linkedin -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #0082ca" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>
            <!-- Github -->
            <a class="btn btn-primary btn-floating m-1" style="background-color: #333333" href="#!" role="button"><i class="fab fa-github"></i></a>
          </div>
        </div>
        <!--Grid row-->
      </section>
      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
      © 2022 Copyright:
      <a class="text-white" href="#">Beginning Rise</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!-- Footer -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>

</html>