<?php
// CLIENTES CONTROLADOR
    include "../model/clientesModelo.php";
    
    $obj = new Cliente();

    if ($_POST) {
        $obj->t_doc = $_POST['t_doc'];
        $obj->documento = $_POST['documento'];
        $obj->nombre = $_POST['nombre'];
        $obj->correo = $_POST['correo'];
        $obj->correo2 = $_POST['correo2'];
        $obj->direccion = $_POST['direccion'];
        $obj->telefono = $_POST['telefono'];
        $obj->pass = $_POST['pass'];
        $obj->pass2 = $_POST['pass2'];
        $obj->fotoPerfil = $_FILES['fotoPerfil']['tmp_name'];
        $obj->estado = $_POST['estado'];
    }

    if (isset($_POST['añadir'])) {
        $obj->añadirCliente();
    }
    if (isset($_POST['modificar'])) {
        $obj->modificarCliente();
    }
    if (isset($_POST['eliminar'])) {
        $obj->eliminarCliente();
    }

?>