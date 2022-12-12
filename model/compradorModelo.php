<?php
require "connect/dbconnect.php";
class Comprador
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }

    public function añadirComprador($t_doc, $documento, $nombre, $correo, $direccion, $telefono, $pass, $ruta)
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
                    '$t_doc', 
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
                "INSERT INTO clientes(
                    email_cliente, 
                    direccion_cliente, 
                    telefono_cliente
                ) VALUES (
                    '$correo', 
                    '$direccion', 
                    '$telefono'
                )"
            );
            $this->_dbcon->desconectar();
            if ($consulta1 and $consulta2) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function modificarComprador($t_doc, $documento, $nombre, $correo, $ruta)
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
        } else {
            $consulta = $this->_dbcon->conexion->query(
                "UPDATE persona 
                SET persona.tipo_documento_persona = '$t_doc', 
                persona.num_doc_persona = '$documento', 
                persona.nombre_persona = '$nombre', 
                persona.fecha_actualizacion = NOW(), 
                persona.foto_perfil = '$ruta' 
                WHERE persona.email_persona = '$correo'"
            );
        }
        if ($consulta) {
            return true;
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }

    public function toggleComprador($email)
    {
        $this->_dbcon->conectar();
        $query = $this->_dbcon->conexion->query(
            "SELECT * FROM persona WHERE email_persona = '$email'"
        );
        $array = $query->fetch(PDO::FETCH_ASSOC);
        $status = $array['estado'];
        if ($status == 1) {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE persona SET persona.estado = '0' WHERE persona.email_persona = '$email'"
            );
        } else {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE persona SET persona.estado = '1' WHERE persona.email_persona = '$email'"
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