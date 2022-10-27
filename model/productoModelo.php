<?php

include "../connect/config.php";
// PRODUCTO MODELO
class Producto
{

    public $idProducto;
    public $nombreProducto;
    public $tipo;
    public $disco;
    public $cpu;
    public $ram;
    public $pantalla;
    public $grafica;
    public $bateria;
    public $precio;
    public $marca;
    public $imagen;
    public $estado;

    function añadirProducto()
    {

        // Conexión
        $connect = new Conexion();
        $c = $connect->conectando();
        // Verificar si ya existe con la consulta de la variable sqlverif
        $sqlverif = "SELECT * FROM productos WHERE nombre_producto = '$this->nombreProducto'";
        // Ejecución de la consulta para verificar la existencia del producto
        $verificacion = mysqli_query($c, $sqlverif);
        if (mysqli_fetch_array($verificacion)) {
            // Si existe suelta error
            // header("Location: ../view/subir_productos.php");
            // echo "<div class='alert alert-danger' role='alert'>El Producto ya existe en el sistema</div>";
            echo "
                <script>
                    alert('El Producto ya existe en el sistema');
                    window.location='../view/subir_productos.php';
                </script>";
        } else {
            // Si no existe, lo agrega
            // ----------------------------------
            // Para la Imagen
            // Variable para almacenar el nombre del archivo de imagen
            $img = $_FILES['imagen']['name'];
            // Concatenación con la carpeta de destino para obtener la ruta de la imagen en una variable
            $ruta = '../config/img/productos/' . $img;
            // Mover el archivo de imagen a la ruta - $this->imagen es lo mismo que $_FILES['imagen']['tmp_name']
            // -----------------------------------
            move_uploaded_file($this->imagen, $ruta);
            // Para que me traiga el id de la marca
            $query1 = "SELECT marcas.id_marca from marcas where marcas.marca = '$this->marca'";
            $resultado = mysqli_query($c, $query1);
            $fila = mysqli_fetch_row($resultado);
            $this->marca = $fila[0];
            // Al tener estos 2 datos (imagen y marca) si procede a la consulta de insertar datos
            if ($resultado) {
                $query2 = "INSERT INTO productos(id_marca, nombre_producto, id_tipo, almacenamiento, procesador, ram, pantalla, grafica, bateria, precio, fecha_creacion, fecha_actualizacion, imagen, estado) VALUES ('$this->marca', '$this->nombreProducto', '$this->tipo', '$this->disco', '$this->cpu', '$this->ram', '$this->pantalla', '$this->grafica', '$this->bateria', '$this->precio', NOW(), NOW(), '$ruta', '1')";
                $resultado2 = mysqli_query($c, $query2);
            }
            if ($resultado2) {
                // Confirmación de producto registrado y redirección al perfil de la tienda
                echo "<script>
                    alert('Producto Registrado');
                    window.location='../view/perfiltienda.php';
                </script>";
            } else {
                die("Ha ocurrido un error, verifique nuevamente: " . mysqli_error($c));
            }
        }
    }

    function modificarProducto()
    {
        $connect = new Conexion();
        $c = $connect->conectando();
        // Para la Imagen
        $img = $_FILES['imagen']['name'];
        $ruta = '../config/img/productos/' . $img;
        move_uploaded_file($this->imagen, $ruta);
        // Consulta de actualización
        $update = "UPDATE productos SET nombre_producto = '$this->nombreProducto', almacenamiento = '$this->disco', ram = '$this->ram', precio = '$this->precio', fecha_actualizacion = NOW(), imagen = '$ruta', estado = '$this->estado' WHERE id_producto = '$this->idProducto'";
        $res = mysqli_query($c, $update);
        if ($res) {
            // Confirmación de producto registrado y redirección a la tabla de productos
            echo "<script>
                    alert('El producto fue modificado');
                    window.location='../view/verproductos.php';
                </script>";
        } else {
            // Mensaje de error y redirección a la tabla de productos
            "<script>
                    alert('Ha ocurrido un error, intente nuevamente');
                    window.location='../view/verproductos.php';
                </script>";
        }
    }

    function eliminarProducto()
    {
        $connection = new Conexion();
        $c = $connection->conectando();
        // Cambiar el estado a 0 para "inactivo"
        $sql = "UPDATE productos SET estado = 0 WHERE id_producto = '$this->idProducto'";
        if (mysqli_query($c, $sql)) {
            echo "<script>
                alert('El producto fue eliminado');
                window.location='../view/verproductos.php';
            </script>";
        } else {
            echo "<script>
                alert('No fue posible eliminar el producto');
                window.location='../view/verproductos.php';
            </script>";
        }
    }
}
?>