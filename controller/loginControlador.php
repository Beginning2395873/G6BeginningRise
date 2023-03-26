<?php
    session_start();
    require "model/loginModelo.php";
    class LoginControlador
    {
        public function index()
        {
            if(isset($_SESSION['login']))
            {
                $email = $_SESSION['login'];
                $_rol = new Login();
                $resultado1 = $_rol->checkrole($email);
                switch($resultado1) {
                    case 0: // No Existe
                        header("Location:".urlsite."?page=logout");
                        break;
                    case 1: // Admin
                        $_SESSION['login'] = $email;
                        header("Location:".urlsite."?page=admin");
                        break;
                    case 2: // CLiente
                        $_SESSION['login'] = $email;
                        header("Location:".urlsite."?page=cliente");
                        break;
                    case 3: // Tienda
                        $_SESSION['login'] = $email;
                        header("Location:".urlsite."?page=tienda");
                        break;
                }
            }
            require "view/login.php";
        }
        
        public function login()
        {
            $_modelo = new Login();
            $_email = $_POST['correo'];
            $_pass = $_POST['pass'];
            $_resultado = $_modelo->login($_email, $_pass);
            switch($_resultado) {
                case 0: // No Existe
                    header("Location:".urlsite."?page=login&msg=Usuario o Contraseña Incorrectos");
                    break;
                case 1: // Admin
                    $_SESSION['login'] = $_email;
                    header("Location:".urlsite."?page=admin");
                    break;
                case 2: // Cliente
                    $_SESSION['login'] = $_email;
                    header("Location:".urlsite."?page=cliente");
                    break;
                case 3: // Tienda
                    $_SESSION['login'] = $_email;
                    header("Location:".urlsite."?page=tienda");
                    break;
                case 4: // Inactivo
                    header("Location:".urlsite."?page=login&msg=Usuario Inactivo, comuniquese con el soporte");
                    break;
            }
        }

        public function logout() 
        {
            if(!isset($_SESSION['login']))
            {
                header("location:".urlsite);
            } else {
                session_unset();
                session_destroy();
                header("location:".urlsite);
            }
            
        }
    }

?>