<?php
session_start();
$user = $_SESSION['login'];

// Capturar lo que se escribió en la barra de búsqueda
if ($_POST) {
    $busqueda = strtolower($_REQUEST['busqueda']);
}

// Conexión y consulta para total de registros
$connect = new Conexion();
$connect->conectar();
$query = $connect->conexion->prepare("SELECT count(*) as totalRegistros from clientes");
$query->execute();
$arreglo = $query->fetch();
$totalRegistros = $arreglo["totalRegistros"];

// Máximo de registros para el paginador
$maximoRegistros = 5;
if (empty($_GET['pagina'])) {
    $pagina = 1;
} else {
    $pagina = $_GET['pagina'];
}
$desde = ($pagina - 1) * $maximoRegistros;
$totalPaginas = ceil($totalRegistros / $maximoRegistros);

if (!empty($_POST['search'])) {

    // Para el paginador luego de buscar
    $sqlcuentaBusqueda = $connect->conexion->prepare("SELECT count(persona.tipo_documento_persona) as totalBusqueda, persona.num_doc_persona, persona.nombre_persona, clientes.email_cliente, clientes.direccion_cliente, clientes.telefono_cliente, persona.foto_perfil, persona.estado FROM clientes INNER JOIN persona ON persona.email_persona = clientes.email_cliente where tipo_documento_persona like '%$busqueda%' or num_doc_persona like '%$busqueda%' or nombre_persona like '%$busqueda%'");
    $sqlcuentaBusqueda->execute();
    $arregloBusqueda = $sqlcuentaBusqueda->fetch();
    $totalBusqueda = $arregloBusqueda['totalBusqueda'];

    $maximoRegistrosBusqueda = 5;
    if (empty($_GET['pagina'])) {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
    $totalPaginas = ceil($totalBusqueda / $maximoRegistrosBusqueda);

    $query2 = $connect->conexion->prepare("SELECT persona.tipo_documento_persona, persona.num_doc_persona, persona.nombre_persona, clientes.email_cliente, clientes.direccion_cliente, clientes.telefono_cliente, persona.foto_perfil, persona.estado FROM clientes INNER JOIN persona ON persona.email_persona = clientes.email_cliente where tipo_documento_persona like '%$busqueda%' or num_doc_persona like '%$busqueda%' or nombre_persona like '%$busqueda%' limit $desde,$maximoRegistros");
    $query2->execute();
    $arreglo2 = $query2->fetch();
} else {
    // Consulta
    $query2 = $connect->conexion->prepare("SELECT persona.tipo_documento_persona, persona.num_doc_persona, persona.nombre_persona, clientes.email_cliente, clientes.direccion_cliente, clientes.telefono_cliente, persona.foto_perfil, persona.estado FROM clientes INNER JOIN persona WHERE persona.email_persona = clientes.email_cliente  and estado != 0 limit $desde,$maximoRegistros");
    $query2->execute();
    $arreglo2 = $query2->fetch();
}

?>

<?php require "view/layouts/headerA.php" ?>

<div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <div class="input-group d-flex" style="max-width: 400px;">
                    <!-- Búsqueda -->
                    <form action="<?php echo urlsite ?>?page=admin&opcion=listaCompradores" class="d-flex" role="search" method="POST">
                        <input type="search" id="buscar" class="form-control me-2" name="busqueda" placeholder="Buscar Usuario" aria-label="Search" />
                        <button type="submit" name="search" role="button" class="btn btn-outline-primary" value="Buscar"><i class="fas fa-search"></i></button>
                    </form>
                    <a href="<?php echo urlsite ?>?page=admin&opcion=listaCompradores" class="btn btn-outline-warning ms-2">
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
                                        <h5>Lista de Clientes</h5>
                                    </td>
                                </tr>

                                </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-secondary">
                                    <!-- Títulos de las columnas -->
                                    <td scope="col">Tipo Documento</td>
                                    <td scope="col">Número Documento</td>
                                    <td scope="col">Nombre</td>
                                    <td scope="col">Correo electrónico</td>
                                    <td scope="col">Dirección</td>
                                    <td scope="col">Teléfono</td>
                                    <td scope="col">Foto de perfil</td>
                                    <td scope="col">Estado</td>
                                    <td scope="col">Eliminar</td>
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
                                        if ($arreglo2[7] == 0) {
                                            $status = 'Inactivo';
                                        } else if ($arreglo2[7] == 2) {
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
                                            <td><?php echo $arreglo2[5] ?></td>
                                            <td><img src="<?php echo $arreglo2[6] ?>" alt="" width="80px"></td>
                                            <td><?php echo $status ?></td>
                                            <!-- Activar / Desactivar Usuario -->
                                            <?php if ($status == 'Activo') { ?>
                                                <td><?php echo "<form id='toggleAdmin' action='" . urlsite . "?page=toggleAdmin' name='toggleAdmin' method='POST'>
                                                <input type='hidden' id='email_admin' name='email_admin' value='$arreglo2[3]' />
                                                <button type='submit' name='toggle' class='btn btn-warning' onClick='alertaAdminDesactivar()' ><i class='fa-solid fa-circle-xmark'></i></button>
                                            </form>" ?></td>
                                            <?php } else if ($status == 'Inactivo') { ?>
                                                <td><?php echo "<form id='toggleAdmin' action='" . urlsite . "?page=toggleAdmin' name='toggleAdmin' method='POST'>
                                                <input type='hidden' id='email_admin' name='email_admin' value='$arreglo2[3]' />
                                                <button type='submit' name='toggle' class='btn btn-success' onClick='alertaAdminActivar()' ><i class='fa-solid fa-eye'></i></button>
                                            </form>" ?></td>
                                            <?php } ?>
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