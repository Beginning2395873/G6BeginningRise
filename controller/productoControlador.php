<?php

require_once "model/productoModelo.php";

class ProductoControlador
{
    public function añadirProducto()
    {
        // Instancia Modelo
        $model = new Producto;
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
            $name = basename($_FILES['imgProducto']['name']);
            list($base, $extension) = explode('.', $name);
            $newname = implode('.', [$base, $user, $extension]);
            $ruta = 'config/img/productos/' . $newname;
            move_uploaded_file($imagen, $ruta);
            $resultado = $model->añadirProducto(
                $idmarca,
                $tipo,
                $nombre,
                $disco,
                $cpu,
                $gpu,
                $ram,
                $pantalla,
                $bateria,
                $precio,
                $ruta,
                $user
            );
            if ($resultado) {
                if ($resultado) {
                    session_start();
                    $_SESSION['msj'] = '¡Registro Exitoso!';
                    $_SESSION['icon'] = 'success';
                } else {
                    session_start();
                    $_SESSION['msj'] = 'El producto ya existe en el sistema';
                    $_SESSION['icon'] = 'warning';
                }
            }
            header('Location: ' . urlsite . '?page=tienda&opcion=añadirProducto');
        }
    }
    public function toggleProducto()
    {
        // Instancia Modelo
        $modelo = new Producto;
        if (isset($_POST)) {
            $nit = $_POST['nit'];
            $idProducto = $_POST['idProducto'];
            $resultado = $modelo->toggleProducto($nit, $idProducto);
            if ($resultado) {
                echo "Registro Actualizado";
            } else {
                echo "Ha ocurrido un error, inténtelo nuevamente";
            }
        }
    }
    public function editarProducto()
    {
        // Modelo
        $modelo = new Producto;
        if (isset($_POST['modificar'])) {
            $nit = $_POST['nit'];
            $idProducto = $_POST['idProducto'];
            $disco = $_POST['disco'];
            $ram = $_POST['ram'];
            $descuento = $_POST['descuento'];
            $precio = $_POST['precio'];
            $imgProducto = $_FILES['imgProducto']['tmp_name'];
            //Subir Imagen
            $img = $_FILES['imgProducto']['name'];
            if ($img != "") {
                $ruta = 'config/img/productos/' . $img;
                move_uploaded_file($imgProducto, $ruta);
            } else {
                $ruta = "";
            }
            $resultado = $modelo->modificarProducto($nit, $idProducto, $disco, $ram, $descuento, $precio, $ruta);
            if ($resultado) {
                if ($resultado) {
                    session_start();
                    $_SESSION['msj'] = '¡Datos Actualizados!';
                    $_SESSION['icon'] = 'success';
                } else {
                    session_start();
                    $_SESSION['msj'] = 'Ha ocurrido un error, inténtelo nuevamente';
                    $_SESSION['icon'] = 'warning';
                }
            }
            header('Location: ' . urlsite . '?page=tienda&opcion=listaProductos');
        }
    }
}
