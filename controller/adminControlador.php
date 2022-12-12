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
        if (isset($_POST['añadir'])) 
        {   
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
                    echo "<script>
                            alert('Registro Exitoso');
                            window.location='?page=admin'
                    </script>";
                } else {
                    echo "<script>
                            alert('El usuario ya existe en el sistema');
                            window.location='?page=admin'
                    </script>";
                }
            } else {
                echo "<script>
                        alert('Los correos o contraseñas no coinciden, inténtelo nuevamente');
                        window.location='?page=admin'
                </script>";
            }
        }
    }

    public function editarPerfilAdmin()
    {
        require "view/admin/editarperfil.php";
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
                echo "<script>
                            alert('Datos actualizados');
                            window.location='?page=admin'
                    </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                            window.location='?page=admin'
                    </script>";
            }
        }
    }

    public function toggleAdmin()
    {
        $_modelo = new Admin;
        if (isset($_POST)){
            $email_admin = $_POST['email_admin'];
            $resultado = $_modelo->toggleAdmin($email_admin);
            if($resultado) {
                echo "<script>
                    window.location='?page=admin'
                </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }

    public function borrarAdmin(){
        $_modelo = new Admin;
        if (isset($_POST)){
            $email_admin = $_POST['correo_admin'];
            $resultado = $_modelo->borrarAdmin($email_admin);
            if($resultado) {
                echo "<script>
                    window.location='?page=admin&opcion=listaAdmin'
                </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }

}
