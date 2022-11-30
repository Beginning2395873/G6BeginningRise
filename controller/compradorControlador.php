<?php
require "model/compradorModelo.php";


class CompradorControlador
{

    public function home()
    {
        if (isset($_SESSION['login'])) {
            header("location:" . urlsite);
        }
        require "view/customer/home.php";
    }

    public function compradorRegistro()
    {   
        // Instanciar el Modelo
        $_modelo = new Comprador;
        // Validar que el método sea POST
        if (isset($_POST['añadir'])) 
        {   
            // Recibir la información del Formulario
            $t_doc = $_POST['t_doc'];
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $correo2 = $_POST['correo2'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            $fotoPerfil = $_FILES['fotoPerfil']['tmp_name'];

            // Cambiar el tipo de documento a como está en la BD
            $ti_doc = "";

            if ($t_doc == "Cédula de Ciudadanía") {
                $ti_doc = "C.C.";
            } elseif ($t_doc == "Cédula de Extranjería") {
                $ti_doc = "C.E.";
            } elseif ($t_doc == "Tarjeta de Identidad") {
                $ti_doc = "T.I.";
            }


            //Subir Imagen
            $img = $_FILES['fotoPerfil']['name'];
            $ruta = 'config/img/persona/' . $img;
            move_uploaded_file($fotoPerfil, $ruta);

            // Llamado al modelo en caso de que los correos sean iguales y las contraseñas también
            if ($correo === $correo2 and $pass === $pass2) {
                $resultado = $_modelo->añadirComprador($ti_doc, $documento, $nombre, $correo, $direccion, $telefono, $pass, $ruta);
                if ($resultado) {
                    echo "<script>
                            alert('Registro Exitoso');
                            window.location='?page=login'
                    </script>";
                } else {
                    echo "<script>
                            alert('El usuario ya existe en el sistema');
                            window.location='".urlsite."'
                    </script>";
                }
            } else {
                echo "<script>
                        alert('Los correos o contraseñas no coinciden, inténtelo nuevamente');
                        window.location='?page=registroComprador'
                </script>";
            }
        }
    }

    public function editarPerfilComprador()
    {
        require "view/customer/editarperfil.php";
        $_modelo = new Comprador;

        if (isset($_POST['modificar'])) {
            $t_doc = $_POST['t_doc'];
            $documento = $_POST['documento'];
            $nombre = $_POST['nombre'];
            $correo = $_POST['correo'];
            $fotoPerfil = $_FILES['fotoPerfil']['tmp_name'];

            $ti_doc = "";

            if ($t_doc == "Cédula de Ciudadanía") {
                $ti_doc = "C.C.";
            } elseif ($t_doc == "Cédula de Extranjería") {
                $ti_doc = "C.E.";
            } elseif ($t_doc == "Tarjeta de Identidad") {
                $ti_doc = "T.I.";
            }
            //Subir Imagen
            $img = $_FILES['fotoPerfil']['name'];
            if ($img != "") {
                $ruta = 'config/img/persona/' . $img;
                move_uploaded_file($fotoPerfil, $ruta);
            } else {
                $ruta = "";
            }
            $resultado = $_modelo->modificarComprador($ti_doc, $documento, $nombre, $correo, $ruta);
            if ($resultado) {
                echo "<script>
                            alert('Datos actualizados');
                            window.location='?page=cliente'
                    </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente 1');
                            window.location='?page=cliente'
                    </script>";
            }
        }
    }

    public function toggleComprador()
    {
        $_modelo = new Comprador;
        if (isset($_POST)){
            $email = $_POST['email'];
            $resultado = $_modelo->toggleComprador($email);
            if($resultado) {
                echo "<script>
                    window.location='?page=admin&opcion=listaCompradores'
                </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }
}