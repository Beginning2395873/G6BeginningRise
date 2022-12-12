<?php
require "connect/dbconnect.php";
class Producto
{
    private $_dbcon; // Refiere a la conexion
    public function __construct()
    {
        $this->_dbcon = new Conexion();
    }
    public function añadirProducto($idmarca, $tipo, $nombre, $disco, $cpu, $gpu, $ram, $pantalla, $bateria, $precio, $ruta, $user)
    {
        $this->_dbcon->conectar();
        $consulta = $this->_dbcon->conexion->query(
            "SELECT * FROM productos WHERE nombre_producto = '$nombre'"
        );
        if ($consulta->fetch(PDO::FETCH_NUM)) {
            $sqlid1 = $this->_dbcon->conexion->query(
                "SELECT * FROM productos WHERE nombre_producto = '$nombre'"
            );
            $res1 = $sqlid1->fetch();
            $idProd1 = $res1[0];
            $sqltien1 = $this->_dbcon->conexion->query(
                "SELECT * FROM tiendas WHERE email_tienda = '$user'"
            );
            $res3 = $sqltien1->fetch();
            $nit1 = $res3[0];
            $insert3 = $this->_dbcon->conexion->prepare(
                "INSERT INTO tiendas_productos(
                    nit_tienda, 
                    id_producto, 
                    almacenamiento, 
                    ram, 
                    precio, 
                    descuento, 
                    fecha_creacion, 
                    fecha_actualizacion, 
                    imagen, 
                    estado
                ) VALUES (
                        '$nit1', 
                        '$idProd1', 
                        '$disco', 
                        '$ram', 
                        '$precio', 
                        '0', 
                        NOW(), 
                        NOW(), 
                        '$ruta', 
                        '1'
                    )"
            );
            if (intval($insert3->errorCode()) === 0) {
                return intval($insert3->errorCode());
            } else {
                $insert3->execute();
                return true;
            }
        } else {
            $query1 = $this->_dbcon->conexion->query(
                "SELECT marcas.id_marca from marcas where marcas.marca = '$idmarca'"
            );
            $arreglo = $query1->fetch();
            $marca = $arreglo['0'];
            if (isset($marca)) {
                $insert = $this->_dbcon->conexion->prepare(
                    "INSERT INTO productos(
                        id_marca, 
                        nombre_producto, 
                        id_tipo, 
                        procesador, 
                        pantalla, 
                        grafica, 
                        bateria
                    ) VALUES (
                        '$marca', 
                        '$nombre', 
                        '$tipo', 
                        '$cpu', 
                        '$pantalla', 
                        '$gpu', 
                        '$bateria'
                    )"
                );
                $resultado = $insert->execute();
                if ($resultado) {
                    $sqlid = $this->_dbcon->conexion->query(
                        "SELECT * FROM productos WHERE nombre_producto = '$nombre'"
                    );
                    $res = $sqlid->fetch();
                    $idProd = $res[0];
                    $sqltien = $this->_dbcon->conexion->query(
                        "SELECT * FROM tiendas WHERE email_tienda = '$user'"
                    );
                    $res2 = $sqltien->fetch();
                    $nit = $res2[0];
                    $insert2 = $this->_dbcon->conexion->prepare(
                        "INSERT INTO tiendas_productos(
                            nit_tienda, 
                            id_producto, 
                            almacenamiento, 
                            ram, precio, 
                            descuento, 
                            fecha_creacion, 
                            fecha_actualizacion, 
                            imagen, 
                            estado
                            ) VALUES (
                                '$nit', 
                                '$idProd', 
                                '$disco', 
                                '$ram', 
                                '$precio', 
                                '0', 
                                NOW(), 
                                NOW(), 
                                '$ruta', 
                                '1'
                            )"
                    );
                    $resultado2 = $insert2->execute();
                    if ($resultado2) {
                        return true;
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        }
        $this->_dbcon->desconectar();
    }
    public function toggleProducto($nit, $id)
    {
        $this->_dbcon->conectar();
        $query = $this->_dbcon->conexion->query(
            "SELECT * FROM tiendas_productos WHERE nit_tienda = '$nit' and id_producto = '$id'"
        );
        $array = $query->fetch();
        $status = $array[4];
        if ($status == 1) {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE tiendas_productos SET tiendas_productos.estado = '0' WHERE nit_tienda = '$nit' and id_producto = '$id'"
            );
        } else {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE tiendas_productos SET tiendas_productos.estado = '1' WHERE nit_tienda = '$nit' and id_producto = '$id'"
            );
        }
        $this->_dbcon->desconectar();
        if ($toggle) {
            return true;
        } else {
            return false;
        }
    }
    public function modificarProducto($nit, $id, $disco, $ram, $descuento, $ruta)
    {
        $this->_dbcon->conectar();
        if ($ruta == "") {
            if ($descuento != 0) {
                // Sin imagen cambiada y con descuento
                $update = $this->_dbcon->conexion->query(
                    "UPDATE tiendas_productos 
                    SET tiendas_productos.almacenamiento = '$disco',
                    tiendas_productos.ram = '$ram',
                    tiendas_productos.descuento = '$descuento',
                    tiendas_productos.fecha_actualizacion = NOW(),
                    tiendas_productos.estado = '2'
                    WHERE tiendas_productos.nit_tienda = '$nit'
                    AND tiendas_productos.id_producto = '$id'"
                );
            } else {
                // Sin imagen ni descuento
                $update = $this->_dbcon->conexion->query(
                    "UPDATE tiendas_productos 
                    SET tiendas_productos.almacenamiento = '$disco',
                    tiendas_productos.ram = '$ram',
                    tiendas_productos.descuento = '$descuento',
                    tiendas_productos.fecha_actualizacion = NOW(),
                    tiendas_productos.estado = '1'
                    WHERE tiendas_productos.nit_tienda = '$nit'
                    AND tiendas_productos.id_producto = '$id'"
                );
            }
        } else {
            if ($descuento != 0) {
                // Con imagen cambiada y con descuento
                $update = $this->_dbcon->conexion->query(
                    "UPDATE tiendas_productos 
                    SET tiendas_productos.almacenamiento = '$disco',
                    tiendas_productos.ram = '$ram',
                    tiendas_productos.descuento = '$descuento',
                    tiendas_productos.fecha_actualizacion = NOW(),
                    tiendas_productos.imagen = '$ruta',
                    tiendas_productos.estado = '2'
                    WHERE tiendas_productos.nit_tienda = '$nit'
                    AND tiendas_productos.id_producto = '$id'"
                );
            } else {
                // Con imagen y sin descuento
                $update = $this->_dbcon->conexion->query(
                    "UPDATE tiendas_productos 
                    SET tiendas_productos.almacenamiento = '$disco',
                    tiendas_productos.ram = '$ram',
                    tiendas_productos.descuento = '$descuento',
                    tiendas_productos.fecha_actualizacion = NOW(),
                    tiendas_productos.imagen = '$ruta',
                    tiendas_productos.estado = '1'
                    WHERE tiendas_productos.nit_tienda = '$nit'
                    AND tiendas_productos.id_producto = '$id'"
                );
            }
        }
        if ($update) {
            return true;
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }
}
