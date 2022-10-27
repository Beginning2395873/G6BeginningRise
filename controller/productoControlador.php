<?php
// PRODUCTO CONTROLADOR
    include "../model/productoModelo.php";
    
    $obj = new Producto();

    if ($_POST) {
        $obj->idProducto = $_POST['idProducto'];
        $obj->nombreProducto = $_POST['nombreProducto']; 
        $obj->tipo = $_POST['tipo']; 
        $obj->disco = $_POST['disco']; 
        $obj->cpu = $_POST['cpu']; 
        $obj->ram = $_POST['ram']; 
        $obj->pantalla = $_POST['pantalla']; 
        $obj->grafica = $_POST['grafica']; 
        $obj->bateria = $_POST['bateria']; 
        $obj->precio = $_POST['precio']; 
        $obj->marca = $_POST['marca'];
        $obj->estado = $_POST['estado'];
        $obj->imagen = $_FILES['imagen']['tmp_name'];
    }

    if (isset($_POST['añadir'])) {
        $obj->añadirProducto();
    }
    if (isset($_POST['modificar'])) {
        $obj->modificarProducto();
    }
    if (isset($_POST['eliminar'])) {
        $obj->eliminarProducto();
    }

?>