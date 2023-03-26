// Cerrar Sesión
function alertaCerrarSesion() {
    Swal.fire({
        title: '¿Desea Cerrar Sesión?',
        text: "",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Sí',
        cancelButtonText: 'No'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = "?page=logout"
        }
    })
}
// Cerrar Sesión

// Admin
function alertaAñadirAdmin() {
    const form = document.getElementById("newAdmin");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Completar Registro?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function alertaModificarAdmin() {
    const form = document.getElementById("editarAdmin");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Actualizar Datos?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function confirmarDesactivarAdmin(id) {
    Swal.fire({
        title: '¿Desea desactivar al Administrador?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                email_admin: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=admin&opcion=toggleAdmin',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}

function confirmarActivarAdmin(id) {
    Swal.fire({
        title: '¿Desea Activar al Administrador?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                email_admin: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=admin&opcion=toggleAdmin',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}

function confirmarEliminarAdmin(id) {
    Swal.fire({
        title: '¿Desea Eliminar al Administrador?',
        text: "Esta acción NO se puede deshacer",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                correo_admin: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=admin&opcion=borrarAdmin',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}
// Fin Admin

// Tienda
function alertaAñadirTienda() {
    const form = document.getElementById("newTienda");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Completar Registro?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function alertaModificarTienda() {
    const form = document.getElementById("editarTienda");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Actualizar Datos?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function confirmarDesactivarTienda(id) {
    Swal.fire({
        title: '¿Desea Desactivar la Empresa?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                nit: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleTienda',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}

function confirmarActivarTienda(id) {
    Swal.fire({
        title: '¿Desea Activar la Empresa?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                nit: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleTienda',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}
// Fin Tienda

// Comprador

function alertaAñadirComprador() {
    const form = document.getElementById("newComprador");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Completar Registro?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function alertaModificarComprador() {
    const form = document.getElementById("editarComprador");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Actualizar Datos?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function confirmarDesactivarComprador(id) {
    Swal.fire({
        title: '¿Desea Desactivar al Comprador?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                email: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleComprador',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}

function confirmarActivarComprador(id) {
    Swal.fire({
        title: '¿Desea Activar al Comprador?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                email: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleComprador',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}
// Fin Comprador


// Producto
function alertaAñadirProducto() {
    const form = document.getElementById("newProducto");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Completar Registro?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function alertaModificarProducto() {
    const form = document.getElementById("editarProducto");
    form.addEventListener("submit", function (e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Actualizar Datos?',
            text: "",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        })
    });
}

function confirmarDesactivarProducto(nit, idProducto) {
    Swal.fire({
        title: '¿Desea Desactivar el Producto?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                nit: nit,
                idProducto: idProducto
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleProducto',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}

function confirmarActivarProducto(nit, id) {
    Swal.fire({
        title: '¿Desea Activar el Producto?',
        text: "",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Aceptar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            let listData = {
                nit: nit,
                idProducto: id
            }
            $.ajax({
                type: 'POST',
                url: '?page=toggleProducto',
                data: listData,
                success: function (data) {
                    swal.fire({
                        position: 'center',
                        icon: 'info',
                        title: data,
                        showConfirmButton: false,
                        timer: 2000
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 2500);
                }
            });
        }
    })
}
// Fin Producto