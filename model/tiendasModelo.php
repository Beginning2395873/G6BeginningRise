<?php

include "../connect/config.php";
// TIENDA MODELO
class Tienda
{

    public $nit;
    public $nombreTienda;
    public $correoTienda;
    public $correo2Tienda;
    public $direccion;
    public $telefono;
    public $pass;
    public $pass2;
    public $fotoTienda;
    public $estado;

    function añadirTienda()
    {

        // Conexión
        $connect = new Conexion();
        $c = $connect->conectando();
        // Verificar si ya existe con la consulta de la variable sqlverif
        $sqlverif = "SELECT * FROM tiendas WHERE nit_tienda = '$this->nit'";
        // Ejecución de la consulta para verificar la existencia del producto
        $verificacion = mysqli_query($c, $sqlverif);
        if (mysqli_fetch_array($verificacion)) {
            // Si existe suelta error
            // header("Location: ../view/subir_productos.php");
            // echo "<div class='alert alert-danger' role='alert'>El Producto ya existe en el sistema</div>";
            echo "
                <script>
                    alert('La Tienda ya existe en el sistema');
                    window.location='../view/registroTienda.php';
                </script>";
        } else {
            // Si no existe, lo agrega
            // ----------------------------------
            // Para la Imagen
            // Variable para almacenar el nombre del archivo de imagen
            $img = $_FILES['fotoTienda']['name'];
            // Concatenación con la carpeta de destino para obtener la ruta de la imagen en una variable
            $ruta = '../config/img/tiendas/' . $img;
            // Mover el archivo de imagen a la ruta - $this->fotoTienda es lo mismo que $_FILES['fotoTienda']['tmp_name']
            // -----------------------------------
            move_uploaded_file($this->fotoTienda, $ruta);

            if ($this->correoTienda == $this->correo2Tienda and $this->pass == $this->pass2) {

                $telefono = mysqli_escape_string($c, $this->telefono);
                $correoTienda = mysqli_escape_string($c, $this->correoTienda);
                $pass = mysqli_escape_string($c, $this->pass);
                $direccion = mysqli_escape_string($c, $this->direccion);

                $query2 = "INSERT INTO tiendas(nit_tienda, nombre_tienda, direccion_tienda, telefono_tienda, email_tienda, contraseña_tienda, fecha_creacion, fecha_actualizacion, foto_tienda, estado) VALUES ('$this->nit', '$this->nombreTienda', '$direccion', '$telefono', '$correoTienda', '$pass', NOW(), NOW(), '$ruta', '1')";
                $resultado2 = mysqli_query($c, $query2);

                if ($resultado2) {
                    // Confirmación de Tienda registrada y redirección al login
                    echo "<script>
                        alert('Registro Exitoso');
                        window.location='../view/login.php';
                    </script>";
                } else {
                    die("Ha ocurrido un error, verifique nuevamente: " . mysqli_error($c));
                }
            } else {
                echo "<script>
                    alert('Los correos o contraseñas no coinciden, inténtelo nuevamente');
                    window.location='../view/registroTienda.php';
                </script>";
            }
        }
    }

    function modificarTienda()
    {
        $connect = new Conexion();
        $c = $connect->conectando();
        // Para la Imagen
        $img = $_FILES['fotoTienda']['name'];
        // Concatenación con la carpeta de destino para obtener la ruta de la imagen en una variable
        $ruta = '../config/img/tiendas/' . $img;
        // Mover el archivo de imagen a la ruta - $this->fotoTienda es lo mismo que $_FILES['fotoTienda']['tmp_name']
        // -----------------------------------
        move_uploaded_file($this->fotoTienda, $ruta);
        // Consulta de actualización
        $update = "UPDATE tiendas SET nombre_tienda = '$this->nombreTienda', direccion_tienda = '$this->direccion', telefono_tienda = '$this->telefono', email_tienda = '$this->correoTienda', fecha_actualizacion = NOW(), foto_tienda = '$ruta' WHERE nit_tienda = '$this->nit'";
        $res = mysqli_query($c, $update);
        if ($res) {
            // Confirmación de producto registrado y redirección a perfil tienda
            echo "<script>
                    alert('Perfil Actualizado');
                    window.location='../view/perfiltienda.php';
                </script>";
            
        } else {
            // Mensaje de error y redirección al formulario
            "<script>
                    alert('Ha ocurrido un error, intente nuevamente');
                    window.location='../view/editar_perfil_tienda.php?nit_tienda=901101602-8';
                </script>";
        }
    }

    function eliminarTienda()
    {
        $connection = new Conexion();
        $c = $connection->conectando();
        // Cambiar el estado a 0 para "inactivo"
        $sql = "UPDATE tiendas SET estado = 0 WHERE nit_tienda = '$this->nit'";
        if (mysqli_query($c, $sql)) {
            echo "<script>
                alert('La tienda fue eliminada');
                window.location='../view/storelist.php';
            </script>";
        } else {
            echo "<script>
                alert('No fue posible eliminar la tienda');
                window.location='../view/storelist.php';
            </script>";
        }
    }
}
