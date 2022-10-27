<?php

session_start();
// LOGIN CONTROLADOR
include "../model/loginModelo.php";

$obj = new Login();

if ($_POST) {

    $obj->correo = $_POST['correo'];
    $obj->pass = $_POST['pass'];

    if(isset($_POST['correo']) && isset($_POST['pass'])) {
        $obj->login();
    }
}

?>