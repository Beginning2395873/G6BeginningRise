<?php
require "connect/dbconnect.php";
class Login
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }
    public function login($email, $pass)
    {
        $this->_dbcon->conectar();
        $query = $this->_dbcon->conexion->query(
            "SELECT * FROM persona WHERE email_persona ='$email'"
        );
        $row = $query->fetch(PDO::FETCH_ASSOC);
        if ($row != 0) {
            $_pass1 = $row['contrasena_persona'];
            $estado = $row['estado'];
            if (password_verify($pass, $_pass1)) {
                $query2 = $this->_dbcon->conexion->prepare(
                    "SELECT * from administradores WHERE email_administrador = '$email'"
                );
                $query2->execute();
                if ($query2->fetch(PDO::FETCH_OBJ)) {
                    if ($estado === 0) {
                        $rol = '4';
                    } else {
                        $rol = "1";
                    }
                    return $rol;
                } else {
                    $query3 = $this->_dbcon->conexion->prepare(
                        "SELECT * from clientes WHERE email_cliente = '$email'"
                    );
                    $query3->execute();
                    if ($query3->fetch(PDO::FETCH_OBJ)) {
                        if ($estado === 0) {
                            $rol = "4";
                        } else {
                            $rol = "2";
                        }
                        return $rol;
                    } else {
                        $rol = "0";
                        return $rol;
                    }
                }
            }
        } else {
            $query4 = $this->_dbcon->conexion->query(
                "SELECT * from tiendas WHERE email_tienda = '$email'"
            );
            $arreglo2 = $query4->fetch(PDO::FETCH_ASSOC);
            if ($arreglo2 != 0) {
                $_pass = $arreglo2['contrasena_tienda'];
                $estadoT = $arreglo2['estado'];
                if (password_verify($pass, $_pass)) {
                    if ($estadoT === 0) {
                        $rol = "4";
                    } else {
                        $rol = "3";
                    }
                    return $rol;
                } else {
                    $rol = "0";
                    return $rol;
                }
            } else {
                $rol = 0;
                return $rol;
            }
        }
        $this->_dbcon->desconectar();
    }

    public function checkrole($email)
    {
        $this->_dbcon->conectar();
        $query = $this->_dbcon->conexion->query(
            "SELECT * FROM clientes WHERE email_cliente = '$email'"
        );
        if ($query->fetch(PDO::FETCH_NUM)) {
            $rol = "2";
            return $rol;
        } else {
            $query2 = $this->_dbcon->conexion->query(
                "SELECT * FROM tiendas WHERE email_tienda = '$email'"
            );
            if ($query2->fetch(PDO::FETCH_NUM)) {
                $rol = "3";
                return $rol;
            } else {
                $query3 = $this->_dbcon->conexion->query(
                    "SELECT * FROM administradores WHERE email_administrador = '$email'"
                );
                if ($query3->fetch(PDO::FETCH_NUM)) {
                    $rol = "1";
                    return $rol;
                } else {
                    $rol = 0;
                    return $rol;
                }
            }
        }
        $this->_dbcon->desconectar();
    }
}
