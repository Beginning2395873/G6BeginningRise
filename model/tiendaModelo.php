<?php
require "connect/dbconnect.php";
class Tienda
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }
    

    public function añadirTienda($nit, $nombreTienda, $direccion, $telefono, $correoTienda, $pass, $ruta) {
        $this->_dbcon->conectar();
        $passCrypt = password_hash($pass, PASSWORD_DEFAULT);
        $consulta = $this->_dbcon->conexion->query("INSERT INTO tiendas(nit_tienda, nombre_tienda, direccion_tienda, telefono_tienda, email_tienda, contrasena_tienda, fecha_creacion, fecha_actualizacion, foto_tienda, estado) VALUES ('$nit', '$nombreTienda', '$direccion', '$telefono', '$correoTienda', '$passCrypt', NOW(), NOW(), '$ruta', '1')");
        $this->_dbcon->desconectar();
        if($consulta) {
            return true;
        } else {
            return false;
        }
    }

    public function modificarTienda($nit, $nombreTienda, $direccion, $telefono, $correoTienda, $ruta) 
    {
        $this->_dbcon->conectar();
        if($ruta=="") {
            $consulta = $this->_dbcon->conexion->query("UPDATE tiendas SET tiendas.nombre_tienda = '$nombreTienda', tiendas.direccion_tienda = '$direccion', tiendas.telefono_tienda = '$telefono', tiendas.email_tienda = '$correoTienda', tiendas.fecha_actualizacion = NOW() WHERE tiendas.nit_tienda = '$nit'");
        } else {
            $consulta = $this->_dbcon->conexion->query("UPDATE tiendas SET tiendas.nombre_tienda = '$nombreTienda', tiendas.direccion_tienda = '$direccion', tiendas.telefono_tienda = '$telefono', tiendas.email_tienda = '$correoTienda', tiendas.fecha_actualizacion = NOW(), tiendas.foto_tienda = '$ruta' WHERE tiendas.nit_tienda = '$nit'");
        }
        $this->_dbcon->desconectar();
        if($consulta) {
            return true;
        } else {
            return false;
        }
    }

    public function eliminarTienda($nit) {
        $this->_dbcon->conectar();
        $sql = $this->_dbcon->conexion->query("SELECT * FROM tiendas WHERE tiendas.nit_tienda = '$nit'");
        $array = $sql->fetch(PDO::FETCH_ASSOC);
        $status = $array['estado'];
        if($status=='1'){
            $update = $this->_dbcon->conexion->query("UPDATE tiendas SET tiendas.estado = 0 WHERE tiendas.nit_tienda = '$nit'");
        } else {
            $update = $this->_dbcon->conexion->query("UPDATE tiendas SET tiendas.estado = 1 WHERE tiendas.nit_tienda = '$nit'");
        }
        $this->_dbcon->desconectar();
        if($update) {
            return true;
        } else {
            return false;
        }
    }
}
