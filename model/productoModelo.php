<?php
require "connect/dbconnect.php";
class Producto {
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }
    public function añadirProducto($idmarca, $tipo, $nombre, $disco, $cpu, $gpu, $ram, $pantalla, $bateria, $precio, $ruta){
        $this->_dbcon->conectar();
        $consulta = $this->_dbcon->conexion->query("SELECT * FROM productos WHERE nombre_producto = '$nombre'");
        if($consulta->fetch(PDO::FETCH_NUM)){
            return false;
        } else {
            $query1 = $this->_dbcon->conexion->query("SELECT marcas.id_marca from marcas where marcas.marca = '$idmarca'");
            $arreglo = $query1->fetch();
            $marca = $arreglo['0'];
            if(isset($marca)) {
                $insert = $this->_dbcon->conexion->prepare("INSERT INTO productos(id_marca, nombre_producto, id_tipo, almacenamiento, procesador, ram, pantalla, grafica, bateria, precio, descuento, fecha_creacion, fecha_actualizacion, imagen, estado) VALUES ('$marca', '$nombre', '$tipo', '$disco', '$cpu', '$ram', '$pantalla', '$gpu', '$bateria', '$precio', '0', NOW(), NOW(), '$ruta', '1')");
                $resultado = $insert->execute();
                
                if($resultado) {
                return true;
            } else {
                return false;
            }
            } else {
                return false;
            }
        }
        $this->_dbcon->desconectar();
    }
}



?>