<?php
require "model/adminModelo.php";

// Modificar los métodos con lo que reciba el POST de Admin uwu

class AdminControlador
{

    public function home()
    {
        if (isset($_SESSION['login'])) {
            header("location:" . urlsite);
        }
        require "view/admin/home.php";
    }

    public function listaCompradores()
    {
        require "view/admin/listadoCompradores.php";
    }

    public function listaTiendas()
    {
        require "view/admin/listadoTiendas.php";
    }

    public function informeTotal()
    {
        require "view/admin/informeTotal.php";
    }

    public function nuevoAdmin()
    {
        require "view/admin/newAdmin.php";
    }

    public function listaAdmin()
    {
        require "view/admin/listadoAdmin.php";
    }

    public function adminRegistro()
    {
        // Instanciar el Modelo
        $_modelo = new Admin;
        // Validar que el método sea POST
        if (isset($_POST['añadir'])) {
            // Recibir la información del Formulario
            $t_doc_admin = $_POST['t_doc_admin'];
            $documento_admin = $_POST['documento_admin'];
            $nombre_admin = $_POST['nombre_admin'];
            $correo_admin = $_POST['correo_admin'];
            $correo2_admin = $_POST['correo2_admin'];
            $pass_admin = $_POST['pass_admin'];
            $pass2_admin = $_POST['pass2_admin'];
            $fotoPerfil_admin = $_FILES['fotoPerfil_admin']['tmp_name'];

            // Cambiar el tipo de documento a como está en la BD
            $ti_doc = "";

            if ($t_doc_admin == "Cédula de Ciudadanía") {
                $ti_doc = "C.C.";
            } elseif ($t_doc_admin == "Cédula de Extranjería") {
                $ti_doc = "C.E.";
            } elseif ($t_doc_admin == "Tarjeta de Identidad") {
                $ti_doc = "T.I.";
            }


            //Subir Imagen
            $img = $_FILES['fotoPerfil_admin']['name'];
            $ruta = 'config/img/persona/' . $img;
            move_uploaded_file($fotoPerfil_admin, $ruta);

            // Llamado al modelo en caso de que los correos sean iguales y las contraseñas también
            if ($correo_admin === $correo2_admin and $pass_admin === $pass2_admin) {
                $resultado = $_modelo->añadirAdmin($ti_doc, $documento_admin, $nombre_admin, $correo_admin, $pass_admin, $ruta);
                if ($resultado) {
                    session_start();
                    $_SESSION['msj'] = '¡Registro Exitoso!';
                    $_SESSION['icon'] = 'success';
                } else {
                    session_start();
                    $_SESSION['msj'] = 'El usuario ya existe en el sistema';
                    $_SESSION['icon'] = 'warning';
                }
            } else {
                echo "";
                $_SESSION['msj'] = 'Los correos o contraseñas no coinciden, inténtelo nuevamente';
                $_SESSION['icon'] = 'error';
            }
            header('Location: ' . urlsite . '?page=admin&opcion=nuevoAdmin');
        }
    }

    public function editarPerfilAdmin()
    {
        require "view/admin/editarperfil.php";
    }

    public function adminPerfilEditar()
    {
        $_modelo = new Admin;

        if (isset($_POST['modificar'])) {
            $t_doc_admin = $_POST['t_doc_admin'];
            $documento_admin = $_POST['documento_admin'];
            $nombre_admin = $_POST['nombre_admin'];
            $correo_admin = $_POST['correo_admin'];
            $fotoPerfil_admin = $_FILES['fotoPerfil_admin']['tmp_name'];

            $ti_doc = "";

            if ($t_doc_admin == "Cédula de Ciudadanía") {
                $ti_doc = "C.C.";
            } elseif ($t_doc_admin == "Cédula de Extranjería") {
                $ti_doc = "C.E.";
            } elseif ($t_doc_admin == "Tarjeta de Identidad") {
                $ti_doc = "T.I.";
            }
            //Subir Imagen
            $img = $_FILES['fotoPerfil_admin']['name'];
            if ($img != "") {
                $ruta = 'config/img/persona/' . $img;
                move_uploaded_file($fotoPerfil_admin, $ruta);
            } else {
                $ruta = "";
            }
            $resultado = $_modelo->modificarAdmin($ti_doc, $documento_admin, $nombre_admin, $correo_admin, $ruta);
            if ($resultado) {
                session_start();
                $_SESSION['msj'] = '¡Datos Actualizados!';
                $_SESSION['icon'] = 'success';
            } else {
                session_start();
                $_SESSION['msj'] = 'Ha ocurrido un error, inténtelo nuevamente';
                $_SESSION['icon'] = 'error';
            }
            header('Location: ' . urlsite . '?page=admin&opcion=editarPerfilAdmin');
        }
    }

    public function toggleAdmin()
    {
        $_modelo = new Admin;
        if (isset($_POST)) {
            $email_admin = $_POST['email_admin'];
            $resultado = $_modelo->toggleAdmin($email_admin);
            if ($resultado) {
                echo "¡Registro actualizado!";
            } else {
                echo "Ha ocurrido un error, inténtelo nuevamente";
            }
        }
    }

    public function borrarAdmin()
    {
        $_modelo = new Admin;
        if (isset($_POST)) {
            $email_admin = $_POST['correo_admin'];
            $resultado = $_modelo->borrarAdmin($email_admin);
            if ($resultado) {
                echo "¡Administrador Eliminado!";
            } else {
                echo "Ha ocurrido un error, inténtelo nuevamente";
            }
        }
    }
}
