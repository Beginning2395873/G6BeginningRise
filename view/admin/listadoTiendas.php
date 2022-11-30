<?php

session_start();
$user = $_SESSION['login'];

if ($_POST) {
    $busqueda = strtolower($_REQUEST['busqueda']);
}
$connect = new Conexion();
$connect->conectar();
$query = $connect->conexion->prepare("SELECT count(*) as totalRegistros from tiendas");
$query->execute();
$arreglo = $query->fetch();
$totalRegistros = $arreglo["totalRegistros"];

$maximoRegistros = 5;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if (!empty($_POST['search'])) {
    // Barra de Búsqueda Paginador
    $cuentaBusqueda = $connect->conexion->prepare("SELECT count(tiendas.nit_tienda) as totalBusqueda, tiendas.nombre_tienda, tiendas.direccion_tienda, tiendas.telefono_tienda, tiendas.email_tienda, tiendas.foto_tienda, tiendas.estado FROM tiendas where nit_tienda like '%$busqueda%' or nombre_tienda like '%$busqueda%'");
    $cuentaBusqueda->execute();
    $arregloBusqueda = $cuentaBusqueda->fetch();
    $totalBusqueda = $arregloBusqueda['totalBusqueda'];

    $maximoRegistrosBusqueda = 5;
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
    $totalPaginas = ceil($totalBusqueda / $maximoRegistrosBusqueda);

    // Barra de Búsqueda
    $query2 = $connect->conexion->prepare("SELECT tiendas.nit_tienda, tiendas.nombre_tienda, tiendas.direccion_tienda, tiendas.telefono_tienda, tiendas.email_tienda, tiendas.foto_tienda, tiendas.estado FROM tiendas where nit_tienda like '%$busqueda%' or nombre_tienda like '%$busqueda%' limit $desde,$maximoRegistros");
    $query2->execute();
    $arreglo2 = $query2->fetch();
} else {
    $query2 = $connect->conexion->prepare("SELECT tiendas.nit_tienda, tiendas.nombre_tienda, tiendas.direccion_tienda, tiendas.telefono_tienda, tiendas.email_tienda, tiendas.foto_tienda, tiendas.estado FROM tiendas where tiendas.estado = '1' limit $desde,$maximoRegistros");
    $query2->execute();
    $arreglo2 = $query2->fetch();
}


?>

<?php require "view/layouts/headerA.php" ?>

<script>
    var respuesta = confirm("¿Desea eliminar el registro?")
    if (respuesta==true) {
        return true;
    } else {
        return false;
    }
</script>

<div class="container mt-5">
    <div class="row">
        <div class="col-6">
            <div class="input-group d-flex" style="max-width: 400px;">
                <!-- Búsqueda -->
                <form action="<?php echo urlsite ?>?page=admin&opcion=listaTiendas" class="d-flex" role="search" method="POST">
                    <input type="search" id="buscar" class="form-control me-2" name="busqueda" placeholder="Buscar Tienda" aria-label="Search" />
                    <button type="submit" name="search" role="button" class="btn btn-outline-primary" value="Buscar"><i class="fas fa-search"></i></button>
                </form>
                <a href="<?php echo urlsite ?>?page=admin&opcion=listaTiendas" class="btn btn-outline-warning ms-2">
                    <i class="fa-solid fa-list"></i>
                    Listar
                </a>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4">
    <div class="row justify-content-center align-self-center ">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <tr>
                                <td colspan="6" class="p-3 mb-2">
                                    <h5>Lista de Tiendas</h5>
                                </td>
                            </tr>

                            </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary">
                                <!-- Títulos de las columnas -->
                                <td scope="col">NIT</td>
                                <td scope="col">Nombre</td>
                                <td scope="col">Dirección</td>
                                <td scope="col">Teléfono</td>
                                <td scope="col">Correo electrónico</td>
                                <td scope="col">Foto perfil</td>
                                <td scope="col">Estado</td>
                                <td scope="col">Activar/ <br>Desactivar</td>
                            </tr>
                            <?php
                            if ($arreglo2 == 0) {
                            ?>
                                <div class="alert alert-success" role="alert">
                                    <?php echo "No hay registros" ?>
                                </div>
                                <?php
                            } else {
                                do {
                                    // Estado
                                    $stauts = '';
                                    if ($arreglo2[6] == 0) {
                                        $status = 'Inactivo';
                                    } else if ($arreglo2[6] == 2) {
                                        $status = 'En Oferta';
                                    } else {
                                        $status = 'Activo';
                                    }
                                ?>
                                    <tr>
                                        <td><?php echo $arreglo2[0] ?></td>
                                        <td><?php echo $arreglo2[1] ?></td>
                                        <td><?php echo $arreglo2[2] ?></td>
                                        <td><?php echo $arreglo2[3] ?></td>
                                        <td><?php echo $arreglo2[4] ?></td>
                                        <td><img class="rounded-circle" src="<?php echo $arreglo2[5] ?>" alt="" height="80px" width="80px"></td>
                                        <td><?php echo $status ?></td>
                                        <?php if($status=='Activo'){?>
                                            <td><?php echo "<form id='desactivarTienda' action='".urlsite."?page=eliminarTienda' name='desactivarTienda' method='POST'>
                                                <input type='hidden' id='nit' name='nit' value='$arreglo2[0]' />
                                                <button type='submit' name='eliminar' class='btn btn-warning' onClick='alertaTiendaDesactivar()' ><i class='fa-solid fa-circle-xmark'></i></button>
                                            </form>" ?></td>
                                        <?php } else if($status=='Inactivo') {?>
                                            <td><?php echo "<form id='desactivarTienda' action='".urlsite."?page=eliminarTienda' name='desactivarTienda' method='POST'>
                                                <input type='hidden' id='nit' name='nit' value='$arreglo2[0]' />
                                                <button type='submit' name='eliminar' class='btn btn-success' onClick='alertaTiendaActivar()' ><i class='fa-solid fa-eye'></i></button>
                                            </form>" ?></td>
                                        <?php }?>
                                    </tr>
                            <?php
                                } while ($arreglo2 = $query2->fetch());
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <nav class="" aria-label="paginador">
                <ul class="pagination justify-content-center">
                    <?php
                    if ($pagina != 1) {
                    ?>
                        <li class="page-item ">
                            <a class="page-link" href="?pagina=<?php echo 1; ?>">
                                <i class="fa-solid fa-backward-fast"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina - 1; ?>">
                                <i class="fa-solid fa-backward-step"></i>
                            </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        if ($i == $pagina) {
                            echo '<li class="page-item active" aria-current="page"><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                        } else {
                            echo '<li class="page-item "><a class="page-link" href="?pagina=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                    if ($pagina != $totalPaginas) {
                    ?>

                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina + 1; ?>">
                                <i class="fa-solid fa-forward-step"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $totalPaginas; ?>">
                                <i class="fa-solid fa-forward-fast"></i>
                            </a>
                        </li>
                    <?php
                    }
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>