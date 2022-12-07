<?php
require "model/tiendaModelo.php";

class TiendaControlador
{

    public function home()
    {
        if (isset($_SESSION['login'])) {
            header("location:" . urlsite);
        }
        require "view/store/home.php";
    }

    public function añadirProducto(){
        require "view/store/añadirProducto.php";
    }

    public function listaProductos(){
        require "view/store/listaProductos.php";
    }

    public function modificarProducto(){
        if($_POST)
        {
            $idProducto = $_POST['idProducto'];
            require "view/store/editarProducto.php";
        }
    }

    public function tiendaRegistro()
    {
        // Instancia del modelo Tienda
        $_modelo = new Tienda;
        // Llamado a la vista
        require "view/front/registroTienda.php";
        // Validación método POST en formulario
        if (isset($_POST['añadir'])) {

            // Recibir datos del formulario
            $nit = $_POST['nit'];
            $nombreTienda = $_POST['nombreTienda'];
            $correoTienda = $_POST['correoTienda'];
            $correo2Tienda = $_POST['correo2Tienda'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $pass = $_POST['pass'];
            $pass2 = $_POST['pass2'];
            $fotoTienda = $_FILES['fotoTienda']['tmp_name'];

            //Subir Imagen
            $img = $_FILES['fotoTienda']['name'];
            $ruta = 'config/img/tiendas/' . $img;
            move_uploaded_file($fotoTienda, $ruta);

            // Validar equivalencia entre correos y contraseñas
            if ($correoTienda === $correo2Tienda and $pass === $pass2) {
                // Llamado al modelo con los datos recibidos
                $resultado = $_modelo->añadirTienda($nit, $nombreTienda, $direccion, $telefono, $correoTienda, $pass, $ruta);
                if ($resultado) {
                    echo "<script>
                            alert('Registro Exitoso');
                            window.location='?page=login';
                    </script>";
                } else {
                    echo "<script>
                            alert('La tienda ya existe en el sistema');
                            window.location='?page=tienda'
                    </script>";
                }
            } else {
                echo "<script>
                        alert('Los correos o contraseñas no coinciden, inténtelo nuevamente');
                        window.location='?page=tiendaRegistro'
                </script>";
            }
        }
    }

    public function editarPerfilTienda()
    {
        require "view/store/editarperfil.php";
        $_modelo = new Tienda;

        if (isset($_POST['modificar'])) {
            $nit = $_POST['nit'];
            $nombreTienda = $_POST['nombreTienda'];
            $correoTienda = $_POST['correoTienda'];
            $direccion = $_POST['direccion'];
            $telefono = $_POST['telefono'];
            $fotoTienda = $_FILES['fotoTienda']['tmp_name'];

            //Subir Imagen
            $img = $_FILES['fotoTienda']['name'];
            if ($img!=""){
                $ruta = 'config/img/tiendas/' . $img;
                move_uploaded_file($fotoTienda, $ruta);
            }
            $ruta = "";
            $resultado = $_modelo->modificarTienda($nit, $nombreTienda, $direccion, $telefono, $correoTienda, $ruta);
            if ($resultado) {
                echo "<script>
                    alert('Datos actualizados');
                    window.location='?page=tienda'
                </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }

    public function eliminarTienda()
    {
        $_modelo = new Tienda;
        if (isset($_POST)){
            $nit = $_POST['nit'];
            $resultado = $_modelo->eliminarTienda($nit);
            if($resultado) {
                echo "<script>
                    window.location='?page=admin&opcion=listaTiendas'
                </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }
}
