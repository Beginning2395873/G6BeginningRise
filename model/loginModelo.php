<?php

include "../connect/config.php";

class Login {
    public $correo;
    public $pass;

    function login() {
        $connect = new Conexion();
        $c = $connect->conectando();
        // Quito espacios en blanco y verifico que no esten vacios
        if(!empty(trim($this->correo)) && !empty(trim($this->pass))){

            // Escapo caracteres especiales en el email ingresado para evitar hacking SQL injection
            $form_email = mysqli_real_escape_string($c, htmlspecialchars(trim($this->correo)));
            // realizo la consulta para ver si existe el email ingresado	
            $sql = "SELECT * FROM persona WHERE email_persona = '$this->correo'";
            $resultado = mysqli_query($c, $sql);

            //si la consulta tiene valores, existe ese email, entonces procedo a consultar por la clave
            if(mysqli_num_rows($resultado) > 0){

                // Verifico que el usuario esté como administrador
                $sql2 = "SELECT * from administradores WHERE email_administrador = '$this->correo'";
                $resultado2 = mysqli_query($c, $sql2);
                if(mysqli_num_rows($resultado2) > 0) {
                    $row = mysqli_fetch_row($resultado);
                    
                    //asigno el valor de la clave ingresada en el formulario de login a un variable para mejor vista
                    $usuario_db_pass = $row[4];
                    if ($this->pass === $usuario_db_pass) {
                        session_regenerate_id(true);

                        //coloco el email del usuario en una variable de sesión para poder acceder en otras páginas				
                        $_SESSION['correo'] = $form_email;

                        // direcciono al panel de administración o pagina del logueo exitoso.
                        header('Location: ../view/admin.php');
                    } else{
                        // Si el email no existe, no esta registrado, mando error
                        echo "<script>
                            alert('Los datos de ingreso son incorrectos');
                            window.location='../view/login.php';
                        </script>";
                    }
                } else {
                    $sqluser = "SELECT * from persona WHERE email_persona = '$this->correo'";
                    $res_user = mysqli_query($c, $sqluser);
                    if(mysqli_num_rows($res_user) > 0) {
                        $row = mysqli_fetch_row($res_user);
                    
                        //asigno el valor de la clave ingresada en el formulario de login a un variable para mejor vista
                        $usuario_db_pass = $row[4];
                        if ($this->pass === $usuario_db_pass) {
                            session_regenerate_id(true);

                            //coloco el email del usuario en una variable de sesión para poder acceder en otras páginas				
                            $_SESSION['correo'] = $form_email;

                            // direcciono al panel de administración o pagina del logueo exitoso.
                            header('Location: ../inicio.php');
                        } else {
                            echo "<script>
                                        alert('Los datos de ingreso son incorrectos c');
                                        window.location='../view/login.php';
                                    </script>";
                        }
                    } else {
                        // Si el email no existe, no esta registrado, mando error
                        echo "<script>
                            alert('Los datos de ingreso son incorrectos o');
                            window.location='../view/login.php';
                        </script>";
                    }
                }
            } else {
                $sqltienda = "SELECT * from tiendas WHERE email_tienda = '$this->correo'";
                $res_tienda = mysqli_query($c, $sqltienda);
                if(mysqli_num_rows($res_tienda) > 0) {
                    $row = mysqli_fetch_row($res_tienda);
        
                    //asigno el valor de la clave ingresada en el formulario de login a un variable para mejor vista
                    $usuario_db_pass = $row[5];
                    if ($this->pass === $usuario_db_pass) {
                        session_regenerate_id(true);

                        //coloco el email del usuario en una variable de sesión para poder acceder en otras páginas				
                        $_SESSION['correo'] = $form_email;

                        // direcciono al panel de administración o pagina del logueo exitoso.
                        header('Location: ../view/perfiltienda.php');
                    } else {
                        // Si el email no existe, no esta registrado, mando error
                        echo "<script>
                            alert('Correo o contraseña incorrectos');
                            window.location='../view/login.php';
                        </script>";
                    }
                } else {
                    echo "<script>
                            alert('Los datos de ingreso son incorrectos');
                            window.location='../view/login.php';
                        </script>";
                }
            }
        }
            else{
                // En caso que no haya completado los campos del formulario
                echo "<script>
                    alert('Por favor ingrese los datos solicitados');
                    window.location='../view/login.php';
                </script>";
            }
        
    }

    function salir() {
        session_start();

        // Me aseguro de tomar todas las variables de sesion a un array.
        $_SESSION = array();

        // Al eliminar la sesión, elimimos también las cookie de sesión.
        // Ojo: ¡Esto destruirá la sesión y no solo los datos de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        // Antes de salir elimino las variables de sesion para que no vuelva a ingresar
        session_destroy();
        header("Location: ../index.php");
    }
}
