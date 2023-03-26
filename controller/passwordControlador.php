<?php
session_start();

require "model/passwordModelo.php";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

//Load Composer's autoloader
require 'vendor/autoload.php';

class PasswordControlador
{
    public function index()
    {
        require "view/passrecover.php";
    }

    public function verificarUsuario()
    {
        $_modelo = new Password;
        $email = $_POST['email'];
        $resultado = $_modelo->verificarUsuario($email);
        if ($resultado == 0) {
            // No existe
            header("Location: ?page=passrecover&msg=El usuario no existe en el sistema");
        } elseif ($resultado == 1) {
            // Es Persona
            $codigo = $this->generarCodigo(10);
            $cambioPass = $_modelo->actualizarPass($email, $codigo);
            if ($cambioPass) {
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Username   = 'beginningrise@outlook.com';                     //SMTP username
                $mail->Password   = 'beginning65';                               //SMTP password
                // Desactiva el modo depuración
                $mail->SMTPDebug = 0;

                //Recipients
                $mail->setFrom('beginningrise@outlook.com', 'Beginning Rise');
                $mail->addAddress($email);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperar Contraseña';
                $mail->Body    = '<p>
                                <h3>Beginning Rise</h3>
                                Estimado usuario, el código de verificación para cambio de contraseña es: <b>' . $codigo . '</b>
                                </p>
                                <p>
                                Para cambiar su contraseña, haga click en el botón
                                </p>
                                <a href="' . urlsite . '?page=passrecover&opcion=resetPass" style="color: white; background-color: #008CBA; padding: 4px 8px; border-radius: 6px; text-decoration: none;">Click Aquí</a>';
                // Activo condificacción utf-8
                $mail->CharSet = 'UTF-8';
                $mail->send();
                echo "<script>
                        window.location.href='?page=passrecover&msj=Se ha enviado un código de confirmación a su correo';
                    </script>";
            } else {
                echo "<script>
                        window.location.href='?page=passrecover&msg=Ocurrió un error al cambiar su contraseña';
                    </script>";
            }
        } elseif ($resultado == 2) {
            // Es Empresa
            $codigo = $this->generarCodigo(8);
            $cambioPass = $_modelo->actualizarPass($email, $codigo);
            if ($cambioPass) {
                //Create an instance; passing `true` enables exceptions
                $mail = new PHPMailer(true);
                //Server settings
                $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                $mail->Username   = 'beginningrise@outlook.com';                     //SMTP username
                $mail->Password   = 'beginning65';                               //SMTP password
                // Desactiva el modo depuración
                $mail->SMTPDebug = 0;
                //Recipients
                $mail->setFrom('beginningrise@outlook.com', 'Beginning Rise');
                $mail->addAddress($email);     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Recuperar Contraseña';
                $mail->Body    = '<p>
                                <h3>Beginning Rise</h3>
                                Estimado usuario, el código de verificación para cambio de contraseña es: <span style="color: #008CBA; font-weight: bold;">' . $codigo . '</span>
                                </p>
                                <p>
                                Para cambiar su contraseña, haga click en el botón
                                </p>
                                <a href="' . urlsite . '?page=passrecover&opcion=resetPass" style="color: white; background-color: #008CBA; padding: 4px 8px; border-radius: 6px; text-decoration: none;">Click Aquí</a>';

                // Activo condificacción utf-8
                $mail->CharSet = 'UTF-8';

                $mail->send();
                echo "<script>
                        window.location.href='?page=passrecover&msj=Se ha enviado un código de confirmación a su correo';
                    </script>";
            } else {
                echo "<script>
                        window.location.href='?page=passrecover&msg=Ocurrió un error al cambiar su contraseña';
                    </script>";
            }
        }
    }

    public function generarCodigo($longitud)
    {
        $key = '';
        $patron = '0123456789abcdefghijklmnopqrstuvwxyz';
        $max = strlen($patron) - 1;
        for ($i = 0; $i < $longitud; $i++) {
            $key .= $patron[mt_rand(0, $max)];
        }
        return $key;
    }

    public function resetPass()
    {
        require "view/resetPass.php";
    }

    public function passReset()
    {
        $_modelo = new Password;
        $codigo = $_POST['codigo'];
        $newPass = $_POST['pass'];
        $newPass2 = $_POST['pass2'];
        if ($newPass == $newPass2) {
            $resultado = $_modelo->passReset($codigo, $newPass);
            if ($resultado) {
                session_unset();
                session_destroy();
                header("Location: ?page=login&msj=Contraseña Reestablecida, ya puede iniciar sesión");
            } else {
                session_unset();
                session_destroy();
                header("Location: ?page=passrecover&opcion=resetPass&msg=Ha ocurrido un error, inténtelo nuevamente");
            }
        } else {
            session_unset();
            session_destroy();
            header("Location: ?page=passrecover&opcion=resetPass&msg=Las contraseñas no coinciden");
        }
    }
}
