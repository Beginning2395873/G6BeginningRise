<?php
// TIENDAS CONTROLADOR
    include "../model/tiendasModelo.php";
    
    $obj = new Tienda();

    if ($_POST) {
        $obj->nit = $_POST['nit'];
        $obj->nombreTienda = $_POST['nombreTienda'];
        $obj->correoTienda = $_POST['correoTienda'];
        $obj->correo2Tienda = $_POST['correo2Tienda'];
        $obj->direccion = $_POST['direccion'];
        $obj->telefono = $_POST['telefono'];
        $obj->pass = $_POST['pass'];
        $obj->pass2 = $_POST['pass2'];
        $obj->fotoTienda = $_FILES['fotoTienda']['tmp_name'];
        $obj->estado = $_POST['estado'];

    }

    if (isset($_POST['añadir'])) {
        $obj->añadirTienda();
    }
    if (isset($_POST['modificar'])) {
        $obj->modificarTienda();
    }
    if (isset($_POST['eliminar'])) {
        $obj->eliminarTienda();
    }

?>