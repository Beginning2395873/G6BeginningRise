<?php

include "../connect/config.php";
// CLIENTES MODELO
class Cliente
{

    public $t_doc;
    public $documento;
    public $nombre;
    public $correo;
    public $correo2;
    public $direccion;
    public $telefono;
    public $pass;
    public $pass2;
    public $fotoPerfil;
    public $estado;

    function añadirCliente()
    {

        // Conexión
        $connect = new Conexion();
        $c = $connect->conectando();
        // Verificar si ya existe con la consulta de la variable sqlverif
        $sqlverif = "SELECT * FROM persona WHERE email_persona = '$this->correo'";
        // Ejecución de la consulta para verificar la existencia del producto
        $verificacion = mysqli_query($c, $sqlverif);
        if (mysqli_fetch_array($verificacion)) {
            // Si existe suelta error
            // header("Location: ../view/subir_productos.php");
            // echo "<div class='alert alert-danger' role='alert'>El Producto ya existe en el sistema</div>";
            echo "
                <script>
                    alert('El usuario ya existe en el sistema');
                    window.location='../view/registroComprador.php';
                </script>";
        } else {
            // Si no existe, lo agrega
            // ----------------------------------
            // Para la Imagen
            // Variable para almacenar el nombre del archivo de imagen
            $img = $_FILES['fotoPerfil']['name'];
            // Concatenación con la carpeta de destino para obtener la ruta de la imagen en una variable
            $ruta = '../config/img/persona/' . $img;
            // Mover el archivo de imagen a la ruta - $this->fotoPerfil es lo mismo que $_FILES['fotoPerfil']['tmp_name']
            // -----------------------------------
            move_uploaded_file($this->fotoPerfil, $ruta);

            if ($this->correo == $this->correo2 and $this->pass == $this->pass2) {

                $telefono = mysqli_escape_string($c, $this->telefono);
                $correo = mysqli_escape_string($c, $this->correo);
                $pass = mysqli_escape_string($c, $this->pass);
                $documento = mysqli_escape_string($c, $this->documento);

                $ti_doc = "";

                if ($this->t_doc == 1) {
                    $ti_doc = "C.C.";
                } elseif ($this->t_doc == 2) {
                    $ti_doc = "C.E.";
                } elseif ($this->t_doc == 3) {
                    $ti_doc = "T.I.";
                }

                $query2 = "INSERT INTO persona(tipo_documento_persona, num_doc_persona, nombre_persona, email_persona, contraseña_persona, fecha_creacion, fecha_actualizacion, foto_perfil, estado) VALUES ('$ti_doc', '$documento', '$this->nombre', '$correo', '$pass', NOW(), NOW(), '$ruta', '1')";
                $query3 = "INSERT INTO clientes(email_cliente, direccion_cliente, telefono_cliente) VALUES ('$correo', '$this->direccion', '$telefono')";

                $resultado2 = mysqli_query($c, $query2);
                $resultado3 = mysqli_query($c, $query3);

                if ($resultado2 and $resultado3) {
                    // Confirmación de Persona registrada y redirección al login
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
                    window.location='../view/registroComprador.php';
                </script>";
            }
        }
    }

    function modificarCliente()
    {
        $connect = new Conexion();
        $c = $connect->conectando();
        // Para la Imagen
        $img = $_FILES['fotoPerfil']['name'];
        $ruta = '../config/img/persona/' . $img;
        move_uploaded_file($this->fotoPerfil, $ruta);

        $telefono = mysqli_escape_string($c, $this->telefono);
        $correo = mysqli_escape_string($c, $this->correo);
        $documento = mysqli_escape_string($c, $this->documento);

        $ti_doc = "";

        if ($this->t_doc == 1) {
            $ti_doc = "C.C.";
        } elseif ($this->t_doc == 2) {
            $ti_doc = "C.E.";
        } elseif ($this->t_doc == 3) {
            $ti_doc = "T.I.";
        }

        // Consulta de actualización
        $update = "UPDATE persona SET num_doc_persona = '$documento', nombre_persona = '$this->nombre', fecha_actualizacion = NOW(), foto_perfil = '$ruta' WHERE email_persona = '$correo'";
        $update2 = "UPDATE clientes SET direccion_cliente = '$this->direccion', telefono_cliente = '$telefono' WHERE email_cliente = '$correo'";

        $res = mysqli_query($c, $update);
        $res2 = mysqli_query($c, $update2);
        if ($res and $res2) {
            // Confirmación de Actualizacion de datos y redirección
            echo "<script>
                    alert('Datos Actualizados');
                    window.location='../view/busqueda.php';
                </script>";
        } else {
            // Mensaje de error y redirección al formulario
            "<script>
                    alert('Ha ocurrido un error, intente nuevamente');
                    window.location='../view/editar_perfil_comprador.php';
                </script>";
        }
    }

    function eliminarCliente()
    {
        $connection = new Conexion();
        $c = $connection->conectando();

        $correo = mysqli_escape_string($c, $this->correo);
        // Cambiar el estado a 0 para "inactivo"
        $sql = "UPDATE persona SET estado = 0 WHERE email_persona = '$correo'";
        if (mysqli_query($c, $sql)) {
            echo "<script>
                alert('El usuario fue eliminado');
                window.location='../view/userlist.php';
            </script>";
        } else {
            echo "<script>
                alert('No fue posible eliminar el usuario');
                window.location='../view/userlist.php';
            </script>";
        }
    }
}
