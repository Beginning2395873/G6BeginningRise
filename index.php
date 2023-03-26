<?php

require "settings.php";

// Probar Conexion
// require "connect/dbconnect.php";
// $db = new Conexion;
// $db->conectar();

$page = "index";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
switch ($page) {
    case 'faq':
        require "view/front/faq.php";
        break;
    case 'buscar':
        require "view/front/busqueda.php";
        break;
    case 'comparar':
        require "view/front/compararProductos.php";
        break;
    case 'registrarA':
        require "controller/adminControlador.php";
        $_modAdmin = new AdminControlador();
        $_modAdmin->adminRegistro();
        break;
    case 'registro':
        require "view/front/registro.php";
        break;
    case 'registroComprador':
        require "view/front/registroComprador.php";
        break;
    case 'registrarComprador':
        require "controller/compradorControlador.php";
        $_regComp = new CompradorControlador;
        $_regComp->compradorRegistro();
        break;
    case 'toggleComprador':
        require "controller/compradorControlador.php";
        $_modTienda = new CompradorControlador();
        $_modTienda->toggleComprador();
        break;
    case 'registroTienda':
        require "view/front/registroTienda.php";
        break;
    case 'registrarTienda':
        require "controller/tiendaControlador.php";
        $_regTienda = new TiendaControlador();
        $_regTienda->tiendaRegistro();
        break;
    case 'toggleTienda':
        require "controller/tiendaControlador.php";
        $_togProd = new TiendaControlador;
        $_togProd->toggleTienda();
        break;
    case 'toggleAdmin':
        require "controller/adminControlador.php";
        $_modAdmin = new AdminControlador();
        $_modAdmin->toggleAdmin();
        break;
    case 'productoAñadir':
        require "controller/productoControlador.php";
        $_addProd = new ProductoControlador;
        $_addProd->añadirProducto();
        break;
    case 'toggleProducto':
        require "controller/productoControlador.php";
        $_togProd = new ProductoControlador;
        $_togProd->toggleProducto();
        break;
    case 'productoEditar':
        require "controller/productoControlador.php";
        $_edProd = new ProductoControlador;
        $_edProd->editarProducto();
        break;
    case 'login':
        require "controller/loginControlador.php";
        $_login = new LoginControlador();
        $_login->index();
        break;
    case 'loginauth':
        require "controller/loginControlador.php";
        $_login = new LoginControlador();
        $_login->login();
        break;
    case 'logout':
        require "controller/loginControlador.php";
        $_login = new LoginControlador();
        $_login->logout();
        break;
    case 'admin':
        require "controller/adminControlador.php";
        if (isset($_GET['opcion'])) {
            $metodo = $_GET['opcion'];
            if (method_exists('adminControlador', $metodo)) {
                $_adminControlador = new AdminControlador();
                $_adminControlador->$metodo();
            }
        } else {
            $_adminControlador = new AdminControlador();
            $_adminControlador->home();
        }
        break;
    case 'passrecover':
        require "controller/passwordControlador.php";
        if (isset($_GET['opcion'])) {
            $metodo = $_GET['opcion'];
            if (method_exists('passwordControlador', $metodo)) {
                $_passwordControlador = new PasswordControlador();
                $_passwordControlador->$metodo();
            }
        } else {
            $_passwordControlador = new PasswordControlador();
            $_passwordControlador->index();
        }
        break;
    case 'cliente':
        require "controller/compradorControlador.php";
        if (isset($_GET['opcion'])) {
            $metodo = $_GET['opcion'];
            if (method_exists('compradorControlador', $metodo)) {
                $_compradorControlador = new CompradorControlador();
                $_compradorControlador->$metodo();
            }
        } else {
            $_compradorControlador = new CompradorControlador();
            $_compradorControlador->homeCliente();
        }
        break;
    case 'tienda':
        require "controller/tiendaControlador.php";
        if (isset($_GET['opcion'])) {
            $metodo = $_GET['opcion'];
            if (method_exists('tiendaControlador', $metodo)) {
                $_tiendaControlador = new TiendaControlador();
                $_tiendaControlador->$metodo();
            }
        } else {
            $_tiendaControlador = new TiendaControlador();
            $_tiendaControlador->homeTienda();
        }
        break;
    default:
        require "view/incio.php";
        break;
}
