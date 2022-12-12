<?php
    session_start();
    $user = $_SESSION['login'];
    // Valido POST para el Buscador
    if ($_POST) {
        $busqueda = strtolower($_REQUEST['busqueda']);
    }
    // Conexión
    $connect = new Conexion();
    $connect->conectar();
    // Total de Registros
    $query = $connect->conexion->prepare(
        "SELECT count(*) as totalRegistros from administradores"
    );
    $query->execute();
    $arreglo = $query->fetch();
    // Almaceno el total en una variable
    $totalRegistros = $arreglo["totalRegistros"];
    // Asigno un máximo de Registros
    $maximoRegistros = 5;
    // Valido GET para la página del paginador
    if (empty($_GET['pagina'])) 
    {
        $pagina = 1;
    } else {
        $pagina = $_GET['pagina'];
    }
    $desde = ($pagina - 1) * $maximoRegistros;
    $totalPaginas = ceil($totalRegistros / $maximoRegistros);
    if (!empty($_POST['search'])) 
    {
        // Barra de Búsqueda Paginador
        $cuentaBusqueda = $connect->conexion->prepare(
            "SELECT count(administradores.email_administrador) as totalBusqueda, 
            persona.tipo_documento_persona, 
            persona.num_doc_persona, 
            persona.nombre_persona, 
            persona.email_persona, 
            persona.foto_perfil, 
            persona.estado 
            from administradores 
            INNER JOIN persona ON administradores.email_administrador = persona.email_persona 
            where persona.num_doc_persona like '%$busqueda%' 
            or persona.nombre_persona like '%$busqueda%' 
            or persona.email_persona like '%$busqueda%' 
            or persona.tipo_documento_persona like '%$busqueda%' 
            or persona.estado like '%$busqueda%'"
        );
        $cuentaBusqueda->execute();
        $arregloBusqueda = $cuentaBusqueda->fetch();
        $totalBusqueda = $arregloBusqueda['totalBusqueda'];
        $maximoRegistrosBusqueda = 5;
        if (empty($_GET['pagina'])) 
        {
            $pagina = 1;
        } else {
            $pagina = $_GET['pagina'];
        }
        $desde = ($pagina - 1) * $maximoRegistrosBusqueda;
        $totalPaginas = ceil($totalBusqueda / $maximoRegistrosBusqueda);
        // Barra de Búsqueda
        $query2 = $connect->conexion->prepare(
            "SELECT persona.tipo_documento_persona, 
            persona.num_doc_persona, 
            persona.nombre_persona, 
            administradores.email_administrador, 
            persona.foto_perfil, 
            persona.estado 
            from administradores 
            INNER JOIN persona ON administradores.email_administrador = persona.email_persona 
            where persona.num_doc_persona like '%$busqueda%' 
            or persona.nombre_persona like '%$busqueda%' 
            or persona.email_persona like '%$busqueda%' 
            or persona.tipo_documento_persona like '%$busqueda%' 
            or persona.estado like '%$busqueda%' 
            limit $desde,$maximoRegistros"
        );
        $query2->execute();
        $arreglo2 = $query2->fetch();
    } else {
        // Consulta
        $query2 = $connect->conexion->prepare(
            "SELECT persona.tipo_documento_persona, 
            persona.num_doc_persona, 
            persona.nombre_persona, 
            administradores.email_administrador, 
            persona.foto_perfil, 
            persona.estado 
            from administradores 
            INNER JOIN persona ON administradores.email_administrador = persona.email_persona 
            and persona.estado = '1' 
            limit $desde,$maximoRegistros"
        );
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
                <form action="<?php echo urlsite ?>?page=admin&opcion=listaAdmin" class="d-flex" role="search" method="POST">
                    <input type="search" id="buscar" class="form-control me-2" name="busqueda" placeholder="Buscar Usuario" aria-label="Search" />
                    <button type="submit" name="search" role="button" class="btn btn-outline-primary" value="Buscar">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <a href="<?php echo urlsite ?>?page=admin&opcion=listaAdmin" class="btn btn-outline-warning ms-2">
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
                                <td colspan="6" class="p-3 mb-2">
                                    <h5>
                                        Lista de Administradores
                                    </h5>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="table-secondary">
                                <!-- Títulos de las columnas -->
                                <th scope="col">
                                    Tipo Documento
                                </th>
                                <th scope="col">
                                    Número Documento
                                </th>
                                <th scope="col">
                                    Nombre
                                </th>
                                <th scope="col">
                                    Correo electrónico
                                </th>
                                <th scope="col">
                                    Foto de perfil
                                </th>
                                <th scope="col">
                                    Estado
                                </th>
                                <th scope="col">
                                    Activar/<br>Desactivar
                                </th>
                                <th scope="col">
                                    Eliminar
                                </th>
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
                                    if ($arreglo2[5] == 0) {
                                        $status = 'Inactivo';
                                    } else if ($arreglo2[5] == 2) {
                                        $status = 'En Oferta';
                                    } else {
                                        $status = 'Activo';
                                    }
                                ?>
                                    <tr>
                                        <td>
                                            <?php echo $arreglo2[0] ?>
                                        </td>
                                        <td>
                                            <?php echo $arreglo2[1] ?>
                                        </td>
                                        <td>
                                            <?php echo $arreglo2[2] ?>
                                        </td>
                                        <td>
                                            <?php echo $arreglo2[3] ?>
                                        </td>
                                        <td>
                                            <img class="rounded-circle" src="<?php echo $arreglo2[4] ?>" alt="" width="80px" height="80px">
                                        </td>
                                        <td><?php echo $status ?></td>
                                        <?php if ($arreglo2[3] == $user) { ?>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        <?php } else { ?>
                                            <!-- Activar / Desactivar Admin -->
                                            <?php if ($status == 'Activo') { ?>
                                                <td>
                                                    <?php echo "
                                                        <form id='toggleAdmin' action='" . urlsite . "?page=toggleAdmin' name='toggleAdmin' method='POST'>
                                                            <input type='hidden' id='email_admin' name='email_admin' value='$arreglo2[3]' />
                                                            <button type='submit' name='toggle' class='btn btn-warning' onClick='alertaAdminDesactivar()' >
                                                                <i class='fa-solid fa-circle-xmark'></i>
                                                            </button>
                                                        </form>" 
                                                    ?>
                                                </td>
                                            <?php } else if ($status == 'Inactivo') { ?>
                                                <td>
                                                    <?php echo "
                                                        <form id='toggleAdmin' action='" . urlsite . "?page=toggleAdmin' name='toggleAdmin' method='POST'>
                                                            <input type='hidden' id='email_admin' name='email_admin' value='$arreglo2[3]' />
                                                            <button type='submit' name='toggle' class='btn btn-success' onClick='alertaAdminActivar()' >
                                                                <i class='fa-solid fa-eye'></i>
                                                            </button>
                                                        </form>" 
                                                    ?>
                                                </td>
                                            <?php } ?>
                                            <!-- Borrar Admin -->
                                            <td>
                                                <?php echo "
                                                    <form id='borrarAdmin' name='borrarAdmin' action='" . urlsite . "?page=admin&opcion=borrarAdmin' method='POST'>
                                                        <input type='hidden' id='correo_admin' name='correo_admin' value='$arreglo2[3]' />
                                                        <button type='submit' name='eliminar' class='btn btn-danger' onClick='alertaAdminEliminar()'>
                                                            <i class='fa-solid fa-trash-can'></i>
                                                        </button>
                                                    </form>"
                                                ?>
                                            </td>
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
                            <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=<?php echo 1; ?>">
                                <i class="fa-solid fa-backward-fast"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=<?php echo $pagina - 1; ?>">
                                <i class="fa-solid fa-backward-step"></i>
                            </a>
                        </li>
                    <?php
                    }
                    for ($i = 1; $i <= $totalPaginas; $i++) {
                        if ($i == $pagina) {
                            echo '
                                <li class="page-item active" aria-current="page">
                                    <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=' . $i . '">
                                        ' . $i . '
                                    </a>
                                </li>';
                        } else {
                            echo '
                                <li class="page-item ">
                                    <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=' . $i . '">
                                        ' . $i . '
                                    </a>
                                </li>';
                        }
                    }
                    if ($pagina != $totalPaginas) {
                    ?>
                        <li class="page-item">
                            <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=<?php echo $pagina + 1; ?>">
                                <i class="fa-solid fa-forward-step"></i>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="?page=admin&opcion=listaTiendas&pagina=<?php echo $totalPaginas; ?>">
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