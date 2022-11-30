<?php
if(isset($_SESSION['login'])) {
    require "view/layouts/headerC.php";
} else {
    require "view/layouts/header.php";
}



?>



<?php require "view/layouts/footer.php" ?>