<?php

require "model/productoModelo.php";

class ProductoControlador
{
    public function añadirProducto()
    {
        // Instancia Modelo
        $_model = new Producto;
        // Valida POST
        if(isset($_POST))
        {
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

            //Subir Imagen
            $img = $_FILES['imgProducto']['name'];
            $ruta = 'config/img/productos/' . $img;
            move_uploaded_file($imagen, $ruta);

            $resultado = $_model->añadirProducto($idmarca, $tipo, $nombre, $disco, $cpu, $gpu, $ram, $pantalla, $bateria, $precio, $ruta);
            if($resultado){
                if ($resultado) {
                    echo "<script>
                            alert('Producto Registrado');
                            window.location='".urlsite."?page=tienda'
                    </script>";
                } else {
                    echo "<script>
                            alert('El producto ya existe en el sistema');
                            window.location='".urlsite."?page=tienda'
                    </script>";
                }
            }
        }
    }
}


?>