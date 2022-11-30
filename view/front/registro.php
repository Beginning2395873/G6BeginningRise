<?php require "view/layouts/header.php" ?>

<div class="container text-center mt-5 mb-5">
    <div class="row mb-5">
        <div class="col">
            <a href="<?php echo urlsite ?>?page=registroComprador">
                <button class="btn btn-outline-link">
                    <div class="card fs-5" style="width: 250px;">
                        <div class="card-header text-center text-black">
                            <i class="fa-solid fa-user fa-10x"></i>
                        </div>
                        <div class="card-body fs-2 fw-bold">
                            Comprador
                        </div>
                    </div>
                </button>
            </a>
        </div>
        <div class="col">
            <a href="<?php echo urlsite ?>?page=registroTienda">
                <button class="btn btn-outline-link">
                    <div class="card fs-5" style="width: 250px;">
                        <div class="card-header text-center text-black">
                            <i class="fa-solid fa-cart-shopping fa-10x"></i>
                        </div>
                        <div class="card-body fs-2 fw-bold">
                            Tienda
                        </div>
                    </div>
                </button>
            </a>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>