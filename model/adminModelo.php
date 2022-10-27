<?php

include "../connect/config.php";
// CLIENTES MODELO
class Administrador
{

    public $t_doc_admin;
    public $documento_admin;
    public $nombre_admin;
    public $correo_admin;
    public $correo2_admin;
    public $pass_admin;
    public $pass2_admin;
    public $fotoPerfil_admin;
    public $estado_admin;

    function añadirAdministrador()
    {

        // Conexión
        $connect = new Conexion();
        $c = $connect->conectando();
        $correo = mysqli_escape_string($c, $this->correo_admin);
        // Verificar si ya existe con la consulta de la variable sqlverif
        $sqlverif = "SELECT * FROM persona WHERE email_persona = '$correo'";
        // Ejecución de la consulta para verificar la existencia del producto
        $verificacion = mysqli_query($c, $sqlverif);
        if (mysqli_fetch_array($verificacion)) {
            // Si existe suelta error
            // header("Location: ../view/subir_productos.php");
            // echo "<div class='alert alert-danger' role='alert'>El Producto ya existe en el sistema</div>";
            echo "
                <script>
                    alert('El usuario ya existe en el sistema');
                    window.location='../view/add_admin.php';
                </script>";
        } else {
            // Si no existe, lo agrega
            // ----------------------------------
            // Para la Imagen
            // Variable para almacenar el nombre del archivo de imagen
            $img = $_FILES['fotoPerfil_admin']['name'];
            // Concatenación con la carpeta de destino para obtener la ruta de la imagen en una variable
            $ruta = '../config/img/persona/' . $img;
            // Mover el archivo de imagen a la ruta - $this->fotoPerfil es lo mismo que $_FILES['fotoPerfil']['tmp_name']
            // -----------------------------------
            move_uploaded_file($this->fotoPerfil_admin, $ruta);

            if ($this->correo_admin == $this->correo2_admin and $this->pass_admin == $this->pass2_admin) {

                $correo = mysqli_escape_string($c, $this->correo_admin);
                $pass = mysqli_escape_string($c, $this->pass_admin);
                $documento = mysqli_escape_string($c, $this->documento_admin);

                $ti_doc = "";

                if ($this->t_doc_admin == 1) {
                    $ti_doc = "C.C.";
                } elseif ($this->t_doc_admin == 2) {
                    $ti_doc = "C.E.";
                } elseif ($this->t_doc_admin == 3) {
                    $ti_doc = "T.I.";
                }

                $query2 = "INSERT INTO persona(tipo_documento_persona, num_doc_persona, nombre_persona, email_persona, contraseña_persona, fecha_creacion, fecha_actualizacion, foto_perfil, estado) VALUES ('$ti_doc', '$documento', '$this->nombre_admin', '$correo', '$pass', NOW(), NOW(), '$ruta', '1')";
                $query3 = "INSERT INTO administradores(email_administrador) VALUES ('$correo')";

                $resultado2 = mysqli_query($c, $query2);
                $resultado3 = mysqli_query($c, $query3);

                if ($resultado2 and $resultado3) {
                    // Confirmación de Persona registrada y redirección al login
                    echo "<script>
                        alert('Registro Exitoso');
                        window.location='../view/adminlist.php';
                    </script>";
                } else {
                    die("Ha ocurrido un error, verifique nuevamente: " . mysqli_error($c));
                }
            } else {
                echo "<script>
                    alert('Los correos o contraseñas no coinciden, inténtelo nuevamente');
                    window.location='../view/add_admin.php';
                </script>";
            }
        }
    }

    function modificarAdministrador()
    {
        $connect = new Conexion();
        $c = $connect->conectando();
        // Para la Imagen
        $img = $_FILES['fotoPerfil_admin']['name'];
        $ruta = '../config/img/persona/' . $img;
        move_uploaded_file($this->fotoPerfil_admin, $ruta);

        $correo = mysqli_escape_string($c, $this->correo_admin);
        $documento = mysqli_escape_string($c, $this->documento_admin);

        // Consulta de actualización
        $update = "UPDATE persona SET num_doc_persona = '$documento', nombre_persona = '$this->nombre_admin', fecha_actualizacion = NOW(), foto_perfil = '$ruta' WHERE email_persona = '$correo'";

        $res = mysqli_query($c, $update);
        if ($res) {
            // Confirmación de Actualizacion de datos y redirección
            echo "<script>
                    alert('Datos Actualizados');
                    window.location='../view/adminlist.php';
                </script>";
        } else {
            // Mensaje de error y redirección al formulario
            "<script>
                    alert('Ha ocurrido un error, intente nuevamente');
                    window.location='../view/editar_admin.php';
                </script>";
        }
    }

    function eliminarAdministrador()
    {
        $connection = new Conexion();
        $c = $connection->conectando();

        $correo = mysqli_escape_string($c, $this->correo_admin);
        // Cambiar el estado a 0 para "inactivo"
        $sql = "UPDATE persona SET estado = 0 WHERE email_persona = '$correo'";
        if (mysqli_query($c, $sql)) {
            echo "<script>
                alert('El usuario fue eliminado');
                window.location='../view/adminlist.php';
            </script>";
        } else {
            echo "<script>
                alert('No fue posible eliminar el usuario');
                window.location='../view/adminlist.php';
            </script>";
        }
    }
}
