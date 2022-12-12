<?php

require "model/productoModelo.php";

class ProductoControlador
{
    public function añadirProducto()
    {
        // Instancia Modelo
        $_model = new Producto;
        // Valida POST
        if (isset($_POST)) {
            $idmarca = $_POST['marca'];
            $tipo = $_POST['tipo'];
            $nombre = $_POST['nombreProducto'];
            $disco = $_POST['disco'];
            $cpu = $_POST['cpu'];
            $gpu = $_POST['gpu'];
            $ram = $_POST['ram'];
            $pantalla = $_POST['pantalla'];
            $bateria = $_POST['bateria'];
            $precio = $_POST['precio'];
            $imagen = $_FILES['imgProducto']['tmp_name'];
            $user = $_POST['user'];
            //Subir Imagen
            $img = $_FILES['imgProducto']['name'];
            $ruta = 'config/img/productos/' . $img;
            move_uploaded_file($imagen, $ruta);
            $resultado = $_model->añadirProducto($idmarca, $tipo, $nombre, $disco, $cpu, $gpu, $ram, $pantalla, $bateria, $precio, $ruta, $user);
            if (is_integer($resultado)) {
                echo "<script>
                            alert('El producto ya existe en el sistema');
                            window.location='" . urlsite . "?page=tienda'
                    </script>";
            } else {
                if ($resultado) {
                    if ($resultado) {
                        echo "<script>
                                alert('Producto Registrado');
                                window.location='" . urlsite . "?page=tienda'
                        </script>";
                    } else {
                        echo "<script>
                                alert('El producto ya existe en el sistema');
                                window.location='" . urlsite . "?page=tienda'
                        </script>";
                    }
                }
            }
        }
    }
    public function toggleProducto()
    {
        // Instancia Modelo
        $_modelo = new Producto;
        if (isset($_POST)) {
            $nit = $_POST['nit'];
            $idProducto = $_POST['idProducto'];
            $resultado = $_modelo->toggleProducto($nit, $idProducto);
            if ($resultado) {
                echo "<script>
                    window.location='?page=tienda&opcion=listaProductos'
                </script>";
            } else {
                echo "<script>
                        alert('Ha ocurrido un error, inténtelo nuevamente');
                    </script>";
            }
        }
    }
    public function editarProducto()
    {
        // Modelo
        $_modelo = new Producto;
        if(isset($_POST['modificar']))
        {
            $nit = $_POST['nit'];
            $idProducto = $_POST['idProducto'];
            $disco = $_POST['disco'];
            $ram = $_POST['ram'];
            $descuento = $_POST['descuento'];
            $imgProducto = $_FILES['imgProducto']['tmp_name'];
            //Subir Imagen
            $img = $_FILES['imgProducto']['name'];
            if ($img != "") {
                $ruta = 'config/img/productos/' . $img;
                move_uploaded_file($imgProducto, $ruta);
            } else {
                $ruta = "";
            }
            $resultado = $_modelo->modificarProducto($nit, $idProducto, $disco, $ram, $descuento, $ruta);
            if ($resultado) {
                echo "<script>
                            alert('Datos actualizados');
                            window.location='?page=tienda&opcion=listaProductos'
                    </script>";
            } else {
                echo "<script>
                            alert('Ha ocurrido un error, inténtelo nuevamente');
                            window.location='?page=tienda&opcion=listaProductos'
                    </script>";
            }
        }
    }
}
