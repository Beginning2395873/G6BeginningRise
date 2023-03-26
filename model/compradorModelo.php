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
                "UPDATE persona
                SET persona.estado = '0',
                persona.fecha_actualizacion = NOW()
                WHERE persona.email_persona = '$email'"
            );
        } else {
            $toggle = $this->_dbcon->conexion->query(
                "UPDATE persona
                SET persona.estado = '1',
                persona.fecha_actualizacion = NOW()
                WHERE persona.email_persona = '$email'"
            );
        }
        $this->_dbcon->desconectar();
        if ($toggle) {
            return true;
        } else {
            return false;
        }
    }

    public function addCart($email, $idProd, $nit)
    {
        $this->_dbcon->conectar();
        // Consulta para ver si ya existe el carrito
        $sqlExisteCarrito = $this->_dbcon->conexion->query(
            "SELECT count(carrito.email_cliente) as existeCarrito FROM carrito WHERE carrito.email_cliente = '$email'"
        );
        $arregloExiste = $sqlExisteCarrito->fetch(PDO::FETCH_ASSOC);
        $existeCarrito = $arregloExiste['existeCarrito'];
        if ($existeCarrito != 0) {
            // Verifico existe el producto en el carrito
            $productoEnCarrito = $this->_dbcon->conexion->query(
                "SELECT * FROM carrito_productos
                WHERE carrito_productos.email_cliente = '$email'
                AND carrito_productos.id_producto = '$idProd'
                AND carrito_productos.nit_tienda = '$nit'"
            );
            $resultado1 = $productoEnCarrito->fetch(PDO::FETCH_ASSOC);
            if ($resultado1) {
                // Si existe, aumento cantidad
                $cantidad = $resultado1['cantidad'];
                $newCantidad = $cantidad + 1;
                $aumentarCantidad = $this->_dbcon->conexion->query(
                    "UPDATE carrito_productos
                    SET carrito_productos.cantidad = '$newCantidad'
                    WHERE carrito_productos.email_cliente = '$email'
                    AND carrito_productos.id_producto = '$idProd'
                    AND carrito_productos.nit_tienda = '$nit'"
                );
                if($aumentarCantidad) {
                    $actCarrito = $this->_dbcon->conexion->query(
                        "UPDATE carrito
                        SET carrito.fecha_actualizacion = NOW()
                        WHERE carrito.email_cliente = '$email'"
                    );
                    if ($actCarrito) {
                        return true;
                    }
                } else {
                    return false;
                }
            } else {
                // Si no existe, lo agrego
                $insertarProducto = $this->_dbcon->conexion->query(
                    "INSERT INTO carrito_productos(
                        email_cliente,
                        id_producto,
                        nit_tienda,
                        cantidad
                    ) VALUES (
                        '$email',
                        '$idProd',
                        '$nit',
                        1
                    )"
                );
                if ($insertarProducto) {
                    $actCarrito = $this->_dbcon->conexion->query(
                        "UPDATE carrito
                        SET carrito.fecha_actualizacion = NOW()
                        WHERE carrito.email_cliente = '$email'"
                    );
                    if ($actCarrito) {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        } else {
            // Si no existe el carrito, lo creo e inserto producto
            $crearCarrito = $this->_dbcon->conexion->query(
                "INSERT INTO carrito(
                    email_cliente,
                    fecha_creacion,
                    fecha_actualizacion
                ) VALUES (
                    '$email',
                    NOW(),
                    NOW()
                )"
            );
            if ($crearCarrito) {
                $insertarProducto = $this->_dbcon->conexion->query(
                    "INSERT INTO carrito_productos(
                        email_cliente,
                        id_producto,
                        nit_tienda,
                        cantidad
                    ) VALUES (
                        '$email',
                        '$idProd',
                        '$nit',
                        1
                    )"
                );
                if ($insertarProducto) {
                    $actCarrito = $this->_dbcon->conexion->query(
                        "UPDATE carrito
                        SET carrito.fecha_actualizacion = NOW()
                        WHERE carrito.email_cliente = '$email'"
                    );
                    if ($actCarrito) {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }
        $this->_dbcon->desconectar();
    }

    public function eliminarItem($email, $idProducto, $nitTienda)
    {
        $this->_dbcon->conectar();
        $existe = $this->_dbcon->conexion->query(
            "SELECT * FROM carrito_productos
            WHERE carrito_productos.id_producto = '$idProducto'"
        );
        if ($existe->fetch(PDO::FETCH_NUM)) {
            $query1 = $this->_dbcon->conexion->query(
                "DELETE FROM carrito_productos
                WHERE carrito_productos.id_producto = '$idProducto'"
            );
            if ($query1) {
                $actCarrito = $this->_dbcon->conexion->query(
                    "UPDATE carrito
                    SET carrito.fecha_actualizacion = NOW()
                    WHERE carrito.email_cliente = '$email'"
                );
                if ($actCarrito) {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }

    public function aumentarItem($email, $idProd, $nit)
    {
        $this->_dbcon->conectar();
        $existe = $this->_dbcon->conexion->query(
            "SELECT * FROM carrito_productos
            WHERE carrito_productos.email_cliente = '$email'
            and carrito_productos.id_producto = '$idProd'
            and carrito_productos.nit_tienda = '$nit'
            "
        );
        $arreglo = $existe->fetch();
        $cant = $arreglo[3];
        $nuevaCant = $cant + 1;
        $aumentar = $this->_dbcon->conexion->query(
            "UPDATE carrito_productos
            SET carrito_productos.cantidad = '$nuevaCant'
            WHERE carrito_productos.email_cliente = '$email'
            and carrito_productos.id_producto = '$idProd'
            and carrito_productos.nit_tienda = '$nit'"
        );
        if ($aumentar) {
            $actCarrito = $this->_dbcon->conexion->query(
                "UPDATE carrito
                SET carrito.fecha_actualizacion = NOW()
                WHERE carrito.email_cliente = '$email'"
            );
            if ($actCarrito) {
                return true;
            }
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }

    public function reducirItem($email, $idProd, $nit)
    {
        $this->_dbcon->conectar();
        $existe = $this->_dbcon->conexion->query(
            "SELECT * FROM carrito_productos
            WHERE carrito_productos.email_cliente = '$email'
            and carrito_productos.id_producto = '$idProd'
            and carrito_productos.nit_tienda = '$nit'
            "
        );
        $arreglo = $existe->fetch();
        $cant = $arreglo[3];
        $nuevaCant = $cant - 1;
        if ($nuevaCant <= 0) {
            $eliminar = $this->_dbcon->conexion->query(
                "DELETE FROM carrito_productos
                WHERE carrito_productos.email_cliente = '$email'
                and carrito_productos.id_producto = '$idProd'
                and carrito_productos.nit_tienda = '$nit'"
            );
            if ($eliminar) {
                $actCarrito = $this->_dbcon->conexion->query(
                    "UPDATE carrito
                    SET carrito.fecha_actualizacion = NOW()
                    WHERE carrito.email_cliente = '$email'"
                );
                if ($actCarrito) {
                    return true;
                }
            } else {
                return false;
            }
        } else {
            $reducir = $this->_dbcon->conexion->query(
                "UPDATE carrito_productos
                SET carrito_productos.cantidad = '$nuevaCant'
                WHERE carrito_productos.email_cliente = '$email'
                and carrito_productos.id_producto = '$idProd'
                and carrito_productos.nit_tienda = '$nit'"
            );
            if ($reducir) {
                $actCarrito = $this->_dbcon->conexion->query(
                    "UPDATE carrito
                    SET carrito.fecha_actualizacion = NOW()
                    WHERE carrito.email_cliente = '$email'"
                );
                if ($actCarrito) {
                    return true;
                }
            } else {
                return false;
            }
        }
        $this->_dbcon->desconectar();
    }

    public function votarProducto($id, $nit, $puntaje) 
    {
        $this->_dbcon->conectar();
        // Verificamos que exista el producto
        $existe = $this->_dbcon->conexion->query(
            "SELECT * FROM votaciones
            WHERE votaciones.id_producto = '$id'
            AND votaciones.nit_tienda = '$nit'"
        );
        // Si existe, actualizamos el registro
        if ($existe) {
            $arreglo = $existe->fetch(PDO::FETCH_ASSOC);
            // Recojo totales actuales
            $totalVotos = $arreglo['cantidad_votantes'];
            $puntos = $arreglo['puntuacion_total'];
            // Les sumo la nueva votación
            $nuevoTotal = $totalVotos + 1;
            $nuevoPuntaje = $puntos + $puntaje;
            $sumar = $this->_dbcon->conexion->query(
                "UPDATE votaciones
                SET votaciones.cantidad_votantes = '$nuevoTotal',
                votaciones.puntuacion_total = '$nuevoPuntaje'
                WHERE votaciones.id_producto = '$id'
                AND votaciones.nit_tienda = '$nit'"
            );
            if($sumar) {
                return true;
            } else {
                return false;
            }
        }
        $this->_dbcon->desconectar();
    }

    public function completarCompra($email)
    {
        $this->_dbcon->conectar();
        // Sacar total de ventas
        $venta = "21900";
        $sqltotalVentas = $this->_dbcon->conexion->query(
            "SELECT count(ventas.id_venta) as totalVentas
            FROM ventas"
        );
        $res1 = $sqltotalVentas->fetch(PDO::FETCH_ASSOC);
        $totalVentas = $res1['totalVentas'];
        $nuevaVenta = $totalVentas + 1;
        $venta .= $nuevaVenta;
        // Consulta carrito_productos
        $sqlCarritoProd = $this->_dbcon->conexion->query(
            "SELECT * FROM carrito_productos
            WHERE carrito_productos.email_cliente = '$email'"
        );
        $arregloCarritoProd = $sqlCarritoProd->fetch(PDO::FETCH_ASSOC);
        if($arregloCarritoProd != false) {
            // Ciclo para iterar en todos los productos
            do {
                $correo = $arregloCarritoProd['email_cliente'];
                $nit = $arregloCarritoProd['nit_tienda'];
                $idProd = $arregloCarritoProd['id_producto'];
                $cantidad = $arregloCarritoProd['cantidad'];
                // Reviso si ya está la venta
                $sqlRev = $this->_dbcon->conexion->query(
                    "SELECT count(ventas.id_venta) as totalrVentas FROM ventas
                    WHERE ventas.id_venta = $venta"
                );
                $resultadoRev = $sqlRev->fetch(PDO::FETCH_ASSOC);
                $totalrVentas = $resultadoRev['totalrVentas'];
                if($totalrVentas != 0) {
                    $insertVentasProd = $this->_dbcon->conexion->query(
                        "INSERT INTO ventas_productos(
                            id_venta,
                            nit_tienda,
                            id_producto,
                            cantidad
                        ) VALUES (
                            '$venta',
                            '$nit',
                            '$idProd',
                            '$cantidad'
                        )"
                    );
                    if(!$insertVentasProd) {
                        return false;
                    }
                } else {
                    $insertVentas = $this->_dbcon->conexion->query(
                        "INSERT INTO ventas(
                            id_venta,
                            email_cliente, 
                            fecha
                        ) VALUES (
                            '$venta',
                            '$correo',
                            NOW()
                        )"
                    );
                    if($insertVentas) {
                        $insertVentasProd = $this->_dbcon->conexion->query(
                            "INSERT INTO ventas_productos(
                                id_venta,
                                nit_tienda,
                                id_producto,
                                cantidad
                            ) VALUES (
                                '$venta',
                                '$nit',
                                '$idProd',
                                '$cantidad'
                            )"
                        );
                        if(!$insertVentasProd) {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            } while($arregloCarritoProd = $sqlCarritoProd->fetch(PDO::FETCH_ASSOC));
            $borrarCarritoProd = $this->_dbcon->conexion->query(
                "DELETE FROM carrito_productos
                WHERE carrito_productos.email_cliente = '$correo'"
            );
            if($borrarCarritoProd) {
                $borrarCarrito = $this->_dbcon->conexion->query(
                    "DELETE FROM carrito
                    WHERE carrito.email_cliente = '$correo'"
                );
                if($borrarCarrito) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
        $this->_dbcon->desconectar();
    }
}
