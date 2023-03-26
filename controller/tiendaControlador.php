<?php

require "model/tiendaModelo.php";

class TiendaControlador
{

    public function homeTienda()
    {
        if (isset($_SESSION['login'])) {
            header("location:" . urlsite . "?page=tienda");
        }
        require "view/store/homeTienda.php";
    }

    public function añadirProducto()
    {
        require "view/store/añadirProducto.php";
    }

    public function listaProductos()
    {
        require "view/store/listaProductos.php";
    }

    public function modificarProducto()
    {
        require "view/store/editarProducto.php";
    }

    public function añadirBanner()
    {
        require "view/store/addBanner.php";
    }

    public function bannerAñadir()
    {
        require "view/store/addBanner.php";
        $_modelo = new Tienda;
        if(isset($_POST['añadirBanner'])) {
            $nit = $_POST['nit'];
            $bannerProm = $_FILES['bannerProm']['tmp_name'];
            //Subir Imagen
            $img = $_FILES['bannerProm']['name'];
            if ($img != "") {
                $ruta = 'config/img/banners/' . $img;
                move_uploaded_file($bannerProm, $ruta);
            } else {
                $ruta = "";
            }
            move_uploaded_file($bannerProm, $ruta);
            $resultado = $_modelo->añadirBanner($nit, $ruta);
            if ($resultado) {
                echo "
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Banner Agregado',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(() => {
                            window.location='?page=tienda'
                        }, 1500);
                    </script>
                    ";
                
            } else {
                echo "
                    <script>
                        Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'No se actualizó el banner',
                            showConfirmButton: false,
                            timer: 1500
                        })
                        setTimeout(() => {
                            window.location='?page=tienda'
                        }, 1500);
                    </script>
                    ";
            }
        }
    }

    public function informeVentas()
    {
        require "view/store/informeVentas.php";
    }


    public function tiendaRegistro()
    {
        // Llamado a la vista
        // Instancia del modelo Tienda
        $_modelo = new Tienda;
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
                    // 1: Exito
                    header('Location: ' . urlsite . '?page=registroTienda&msj=1');
                } else {
                    // 2: Error
                    header('Location: ' . urlsite . '?page=registroTienda&msj=2');
                }
            } else {
                // 3: Verificar Datos
                header('Location: ' . urlsite . '?page=registroTienda&msj=3');
            }
        }
    }

    public function editarPerfilTienda()
    {
        require "view/store/editarperfil.php";
    }

    public function tiendaPerfilEditar()
    {
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
            if ($img != "") {
                $ruta = 'config/img/tiendas/' . $img;
                move_uploaded_file($fotoTienda, $ruta);
            } else {
                $ruta = "";
            }
            $resultado = $_modelo->modificarTienda($nit, $nombreTienda, $direccion, $telefono, $correoTienda, $ruta);
            if ($resultado) {
                session_start();
                $_SESSION['msj'] = '¡Datos Actualizados!';
                $_SESSION['icon'] = 'success';
            } else {
                session_start();
                $_SESSION['msj'] = 'Ha ocurrido un error, inténtelo nuevamente';
                $_SESSION['icon'] = 'error';
            }
            header('Location: ' . urlsite . '?page=tienda&opcion=editarPerfilTienda');
        }
    }
    public function toggleTienda()
    {
        $_modelo = new Tienda;
        if (isset($_POST)) {
            $nit = $_POST['nit'];
            $resultado = $_modelo->toggleTienda($nit);
            if ($resultado) {
                echo "¡Registro Actualizado!";
            } else {
                echo "¡Ha ocurrido un error!, inténtelo nuevamente";
            }
        }
    }
}
?>