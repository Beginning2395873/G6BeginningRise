<?php
require "connect/dbconnect.php";
class Password
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }

    public function verificarUsuario($email)
    {
        $this->_dbcon->conectar();
        // Verifico en Persona
        $sql = $this->_dbcon->conexion->query(
            "SELECT * FROM persona
            WHERE persona.email_persona = '$email'"
        );
        $resultado = $sql->fetch(PDO::FETCH_NUM);
        if ($resultado) {
            $this->_dbcon->desconectar();
            return 1;
        } else {
            // Si no es persona, verifico en tienda
            $sql2 = $sql = $this->_dbcon->conexion->query(
                "SELECT * FROM tiendas
                WHERE tiendas.email_tienda = '$email'"
            );
            $resultado2 = $sql2->fetch(PDO::FETCH_NUM);
            if ($resultado2) {
                $this->_dbcon->desconectar();
                return 2;
            } else {
                // Si no es tienda, no existe
                $this->_dbcon->desconectar();
                return 0;
            }
        }
    }

    public function actualizarPass($email, $codigo)
    {
        $this->_dbcon->conectar();
        // Verifico en Persona
        $sql = $this->_dbcon->conexion->query(
            "SELECT * FROM persona
            WHERE persona.email_persona = '$email'"
        );
        $resultado = $sql->fetch(PDO::FETCH_NUM);
        if ($resultado) {
            $cambioPass = $this->_dbcon->conexion->prepare(
                "UPDATE persona
                SET persona.contrasena_persona = '$codigo',
                persona.fecha_actualizacion = NOW()
                WHERE persona.email_persona = '$email'"
            );
            $cambiada = $cambioPass->execute();
            if ($cambiada) {
                $this->_dbcon->desconectar();
                return 1;
            } else {
                return 0;
            }
        } else {
            // Si no es persona, verifico en tienda
            $sql2 = $this->_dbcon->conexion->query(
                "SELECT * FROM tiendas
                WHERE tiendas.email_tienda = '$email'"
            );
            $resultado2 = $sql2->fetch(PDO::FETCH_NUM);
            if ($resultado2) {
                $cambioPass = $this->_dbcon->conexion->prepare(
                    "UPDATE tiendas
                    SET tiendas.contrasena_tienda = '$codigo',
                    tiendas.fecha_actualizacion = NOW()
                    WHERE tiendas.email_tienda = '$email'"
                );
                $cambiada = $cambioPass->execute();
                if ($cambiada) {
                    $this->_dbcon->desconectar();
                    return 2;
                } else {
                    return 0;
                }
            }
        }
    }

    public function passReset($codigo, $newPass)
    {
        $this->_dbcon->conectar();
        // Primero Persona
        $sql = $this->_dbcon->conexion->query(
            "SELECT * FROM persona
            WHERE persona.contrasena_persona = '$codigo'"
        );
        $resultado = $sql->fetch(PDO::FETCH_NUM);
        if ($resultado) {
            $securepass = password_hash($newPass, PASSWORD_DEFAULT);
            $passreset = $this->_dbcon->conexion->prepare(
                "UPDATE persona
                SET persona.contrasena_persona = '$securepass',
                persona.fecha_actualizacion = NOW()
                WHERE persona.contrasena_persona = '$codigo'"
            );
            $passreiniciada = $passreset->execute();
            if ($passreiniciada) {
                $this->_dbcon->desconectar();
                return true;
            } else {
                $this->_dbcon->desconectar();
                return false;
            }
        } else {
            // Ahora Empresa
            $sql2 = $this->_dbcon->conexion->query(
                "SELECT * FROM tiendas
                WHERE tiendas.contrasena_tienda = '$codigo'"
            );
            $resultado2 = $sql2->fetch(PDO::FETCH_NUM);
            if ($resultado2) {
                $securepass2 = password_hash($newPass, PASSWORD_DEFAULT);
                $passreset2 = $this->_dbcon->conexion->prepare(
                    "UPDATE tiendas
                    SET tiendas.contrasena_tienda = '$securepass2',
                    tiendas.fecha_actualizacion = NOW()
                    WHERE tiendas.contrasena_tienda = '$codigo'"
                );
                $passreiniciada2 = $passreset2->execute();
                if ($passreiniciada2) {
                    $this->_dbcon->desconectar();
                    return true;
                } else {
                    $this->_dbcon->desconectar();
                    return false;
                }
            } else {
                $this->_dbcon->desconectar();
                return false;
            }
        }
    }
}
