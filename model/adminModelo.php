<?php
require "connect/dbconnect.php";
class Admin
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }

    public function añadirAdmin($t_doc_admin, $documento, $nombre, $correo, $pass, $ruta)
    {
        $this->_dbcon->conectar();
        $passCrypt = password_hash($pass, PASSWORD_DEFAULT);
        $consulta = $this->_dbcon->conexion->query(
            "SELECT * FROM administradores WHERE email_administrador = '$correo'"
        );
        if ($consulta->fetch(PDO::FETCH_NUM)) {
            return false;
        } else {
            $consulta1 = $this->_dbcon->conexion->query(
                "INSERT INTO persona(
                    tipo_documento_persona, 
                    num_doc_persona, 
                    nombre_persona, 
                    email_persona, 
                    contrasena_persona, 
                    fecha_creacion, 
                    fecha_actualizacion, 
                    foto_perfil, 
                    estado
                ) VALUES (
                    '$t_doc_admin', 
                    '$documento', 
                    '$nombre', 
                    '$correo', 
                    '$passCrypt', 
                    NOW(), 
                    NOW(), 
                    '$ruta', 
                    '1'
                )"
            );
            $consulta2 = $this->_dbcon->conexion->query(
                "INSERT INTO administradores(email_administrador) VALUES ('$correo')"
            );
            $this->_dbcon->desconectar();
            if ($consulta1 and $consulta2) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function modificarAdmin($t_doc, $documento, $nombre, $correo, $ruta)
    {
        $this->_dbcon->conectar();
        if ($ruta == "") {
            $consulta = $this->_dbcon->conexion->query(
                "UPDATE persona 
                SET persona.tipo_documento_persona = '$t_doc', 
                persona.num_doc_persona = '$documento', 
                persona.nombre_persona = '$nombre', 
                persona.fecha_actualizacion = NOW() 
                WHERE persona.email_persona = '$correo'"
            );
            // $consulta = false;
        } else {
            $consulta = $this->_dbcon->conexion->query(
                "UPDATE persona 
                SET persona.tipo_documento_persona = '$t_doc', 
                persona.num_doc_persona = '$documento', 
                persona.nombre_persona = '$nombre', 
                persona.fecha_actualizacion = NOW(), 
                persona.foto_perfil = '$ruta' 
                WHERE persona.email_persona = '$correo'");
            // $consulta = false;
        }
        if ($consulta) {
            return true;
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }

    public function borrarAdmin($correo)
    {
        $this->_dbcon->conectar();
        $consulta = $this->_dbcon->conexion->query(
            "DELETE FROM administradores WHERE email_administrador = '$correo'"
        );
        $consulta2 = $this->_dbcon->conexion->query(
            "DELETE FROM persona WHERE email_persona = '$correo'"
        );
        $this->_dbcon->desconectar();
        if ($consulta and $consulta2) {
            return true;
        } else {
            return false;
        }
    }

    public function toggleAdmin($email_admin)
    {
        $this->_dbcon->conectar();
        $query = $this->_dbcon->conexion->query(
            "SELECT * FROM persona WHERE email_persona = '$email_admin'"
        );
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $status = $array['estado'];
        if ($status == 1) {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE persona SET persona.estado = '0' WHERE persona.email_persona = '$email_admin'"
            );
        } else {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE persona SET persona.estado = '1' WHERE persona.email_persona = '$email_admin'"
            );
        }
        $this->_dbcon->desconectar();
        if ($toggle) {
            return true;
        } else {
            return false;
        }
    }
}
