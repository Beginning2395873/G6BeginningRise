<?php
// Administradores CONTROLADOR
    include "../model/adminModelo.php";
    
    $obj = new Administrador();

    if ($_POST) {
        $obj->t_doc_admin = $_POST['t_doc_admin'];
        $obj->documento_admin = $_POST['documento_admin'];
        $obj->nombre_admin = $_POST['nombre_admin'];
        $obj->correo_admin = $_POST['correo_admin'];
        $obj->correo2_admin = $_POST['correo2_admin'];
        $obj->pass_admin = $_POST['pass_admin'];
        $obj->pass2_admin = $_POST['pass2_admin'];
        $obj->fotoPerfil_admin = $_FILES['fotoPerfil_admin']['tmp_name'];
        $obj->estado_admin = $_POST['estado_admin'];
    }

    if (isset($_POST['añadir'])) {
        $obj->añadirAdministrador();
    }
    if (isset($_POST['modificar'])) {
        $obj->modificarAdministrador();
    }
    if (isset($_POST['eliminar'])) {
        $obj->eliminarAdministrador();
    }

?>