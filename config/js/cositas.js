// Funciones Tienda
function alertaTiendaDesactivar() {
    const form = document.getElementById("desactivarTienda")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        tiendaAlertaDesactivar();
    })

}

function tiendaAlertaDesactivar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '¿Desea desactivar la tienda?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarTienda();            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'La tienda no fue desactivada',
                'error'
            )
        }
    })
}

function alertaTiendaActivar() {
    const form = document.getElementById("desactivarTienda")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        tiendaAlertaActivar();
    })

}

function tiendaAlertaActivar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '¿Desea Activar la tienda?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarTienda();            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'La tienda no fué activada',
                'error'
            )
        }
    })
}

function eliminarTienda() {

    document.getElementById('desactivarTienda').submit()
    
}
// Funciones Tienda


// Funciones Admin

function alertaAdminDesactivar() {
    const form = document.getElementById("toggleAdmin")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        adminAlertaDesactivar();
    })

}

function adminAlertaDesactivar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '¿Desea desactivar al Usuario?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            toggleAdmin();            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'El Usuario no fue desactivado',
                'error'
            )
        }
    })
}

function alertaAdminActivar() {
    const form = document.getElementById("toggleAdmin")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        adminAlertaActivar();
    })

}

function adminAlertaActivar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '¿Desea Activar al Usuario?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            toggleAdmin();            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'El Usuario no fue activado',
                'error'
            )
        }
    })
}

function toggleAdmin() {

    document.getElementById('toggleAdmin').submit()
    
}


function alertaAdminEliminar() {
    const form = document.getElementById("borrarAdmin")
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        adminAlertaEliminar();
    })

}

function adminAlertaEliminar() {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-success ms-2',
            cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: '¿Desea Eliminar al Administrador?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí',
        cancelButtonText: 'No',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            eliminarAdmin();            
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
        ) {
            swalWithBootstrapButtons.fire(
                'Cancelado',
                'El Administrador no fue eliminado',
                'error'
            )
        }
    })
}

function eliminarAdmin() {

    document.getElementById('borrarAdmin').submit()
    
}
// Funciones Admin


// Funciones Productos
function alertaProductoDesactivar(){
    const form = document.getElementById('toggleProducto')
    form.addEventListener("submit", function (a) {
        a.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ms-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
    
        swalWithBootstrapButtons.fire({
            title: '¿Desea desactivar el Producto?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('toggleProducto').submit()
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El Producto no fue desactivado',
                    'error'
                )
            }
        })
    })
}

function alertaProductoActivar(){
    const form = document.getElementById('toggleProducto')
    form.addEventListener("submit", function (a) {
        a.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: 'btn btn-success ms-2',
                cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
    
        swalWithBootstrapButtons.fire({
            title: '¿Desea Activar el Producto?',
            text: "",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('toggleProducto').submit()
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'El Producto no fue Activado',
                    'error'
                )
            }
        })
    })
}