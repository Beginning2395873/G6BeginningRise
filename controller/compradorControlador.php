<?php
require "model/compradorModelo.php";



class CompradorControlador
{

    public function homeCliente()
    {
        if (isset($_SESSION['login'])) {
            header("location:" . urlsite . "?page=cliente");
        }
        require "view/customer/homeCliente.php";
    }

    public function buscar()
    {
        require "view/customer/busqueda.php";
    }

    public function carrito()
    {
        require "view/customer/carrito.php";
    }

    public function detallesCompra()
    {
        require "view/customer/detallesCompra.php";
    }

    public function pedidos()
    {
        require "view/customer/pedidos.php";
    }

    public function compradorRegistro()
    {
        // Instanciar el Modelo
        $_modelo = new Comprador;
        // Validar que el método sea POST
        if (isset($_POST['añadir'])) {
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
                    // 1: Exito
                    header('Location: ' . urlsite . '?page=registroComprador&msj=1');
                } else {
                    // 2: Error
                    header('Location: ' . urlsite . '?page=registroComprador&msj=2');
                }
            } else {
                // 3: Verificar Datos
                header('Location: ' . urlsite . '?page=registroComprador&msj=3');
            }
        }
    }

    public function editarPerfilComprador() {
        require "view/customer/editarperfil.php";
    }

    public function compradorPerfilEditar()
    {
        
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
                session_start();
                $_SESSION['msj'] = '¡Datos Actualizados!';
                $_SESSION['icon'] = 'success';
            } else {
                session_start();
                $_SESSION['msj'] = 'Ha ocurrido un error, inténtelo nuevamente';
                $_SESSION['icon'] = 'error';
            }
            header('Location: ' . urlsite . '?page=cliente&opcion=editarPerfilComprador');
        }
    }

    public function toggleComprador()
    {
        $_modelo = new Comprador;
        if (isset($_POST)) {
            $email = $_POST['email'];
            $resultado = $_modelo->toggleComprador($email);
            if ($resultado) {
                echo "¡Registro Actualizado!";
            } else {
                echo 'Ha ocurrido un error, inténtelo nuevamente';
            }
        }
    }

    public function addCart()
    {
        require "view/customer/busqueda.php";
        $busqueda = "";
        $_modelo = new Comprador;
        $email = $_GET['email'];
        $idProducto = $_GET['idProducto'];
        $nitTienda = $_GET['nitTienda'];
        $resultado = $_modelo->addCart($email, $idProducto, $nitTienda);
        if ($resultado) {
            echo "
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Producto Agregado',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(() => {
                        window.location='?page=cliente&opcion=buscar'
                    }, 2000);
                </script>
                ";
        } else {
            echo "
                <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'Ha Ocurrido un error',
                        showConfirmButton: false,
                        timer: 2000
                    })
                    setTimeout(() => {
                        window.location='?page=cliente&opcion=buscar'
                    }, 2000);
                </script>
                ";
        }
    }

    public function dropCart()
    {
        require "view/customer/carrito.php";
        $_modelo = new Comprador;
        $email = $_POST['email'];
        $idProducto = $_POST['idProducto'];
        $nitTienda = $_POST['nitTienda'];
        $resultado = $_modelo->eliminarItem($email, $idProducto, $nitTienda);
        if ($resultado) {
            echo "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Producto Eliminado',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    window.location='?page=cliente&opcion=carrito'
                }, 1500);
            </script>
            ";
        } else {
            echo "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ha ocurrido un error',
                    showConfirmButton: false,
                    timer: 1500
                })
                setTimeout(() => {
                    window.location='?page=cliente&opcion=carrito'
                }, 2000);
            </script>
            ";
        }
    }

    public function aumentarItem()
    {
        $_modelo = new Comprador;
        $email = $_POST['email'];
        $idProducto = $_POST['idProducto'];
        $nitTienda = $_POST['nitTienda'];
        $resultado = $_modelo->aumentarItem($email, $idProducto, $nitTienda);
        if ($resultado) {
            header("Location: " . urlsite . "?page=cliente&opcion=carrito");
        } else {
            require "view/customer/carrito.php";
            echo "
            <script>
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ha ocurrido un error',
                    showConfirmButton: false,
                    timer: 2000
                })
                setTimeout(() => {
                    window.location='?page=cliente&opcion=carrito'
                }, 2500);
            </script>
            ";
        }
    }

    public function reducirItem()
    {
        $_modelo = new Comprador;
        $email = $_POST['email'];
        $idProducto = $_POST['idProducto'];
        $nitTienda = $_POST['nitTienda'];
        $resultado = $_modelo->reducirItem($email, $idProducto, $nitTienda);
        if ($resultado) {
            header("Location: " . urlsite . "?page=cliente&opcion=carrito");
        } else {
            echo "<script>
                            alert('No se pudo modificar el producto');

                    </script>";
        }
    }

    public function compararProductos()
    {
        require "view/customer/compararProductos.php";
    }

    public function votarProducto()
    {
        session_start();
        $_modelo = new Comprador;
        if (isset($_GET['votarElemento'])) {
            $puede_votar = true;
            $id = $_GET['votarElemento'];
            $nit = $_GET['n'];
            $puntaje = $_GET['puntaje'];
            $elementoVotado = "";
            $elementoVotado .= $id . "-" . $nit;
            // Comprobar si ya ha votado durante esta sesión
            if (isset($_SESSION['elementos_votados'])) {
                if (in_array($elementoVotado, $_SESSION['elementos_votados'])) {
                    // Para reiniciar el voto del producto
                    // unset($_SESSION['elementos_votados']);
                    echo 'Ya ha votado por este producto';
                    $puede_votar = false;
                } else {
                    // Agregar este elemento a la lista
                    $_SESSION['elementos_votados'][] = $elementoVotado;
                }
            } else {
                $_SESSION['elementos_votados'] = array($elementoVotado);
            }
            if ($puede_votar) {
                $resultado = $_modelo->votarProducto($id, $nit, $puntaje);
                if ($resultado) {
                    echo "Votación Correcta";
                } else {
                    echo "Ocurrió un error";
                }
            }
        }
    }

    public function completarCompra()
    {
        $_modelo = new Comprador;
        if(isset($_POST['email_cliente'])) {
            $email = $_POST['email_cliente'];
            $resultado = $_modelo->completarCompra($email);
            if ($resultado) {
                echo "Compra Realizada";
            } else {
                echo "Ocurrió un error, contacte al soporte";
            }
        }
    }
}
?>