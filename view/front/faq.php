<?php require "view/layouts/headerFAQ.php" ?>

<div class="container">
    <div class="row mt-5">
        <div class="col-12 mx-auto" style="max-width: 900px;">
            <div class="card">
                <div class="card-body px-4">
                    <div class="row">
                        <!-- botón de regreso -->
                        <div class="col-2">
                            <a onclick="window.history.back();" class="btn btn-dark"> <i class="fa-solid fa-arrow-left"></i> Regresar</a>
                        </div>
                        <div class="col-8">
                            <h2 class="text-center mb-3">
                                <img src="<?php echo urlsite ?>/config/img/icon.png" height="48" width="48">
                                Preguntas Frecuentes
                            </h2>
                        </div>
                    </div>
                    <!-- Ayuda General -->
                    <h3 class="mb-3">Ayuda General</h3>
                    <div class="accordion" id="ayudaGeneral">
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ag = ayuda general -->
                            <h2 class="accordion-header" id="ag1">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#agcollapseOne" aria-expanded="false" aria-controls="agcollapseOne">
                                    ¿Qué es Beginning Rise?
                                </button>
                            </h2>
                            <div id="agcollapseOne" class="accordion-collapse collapse" aria-labelledby="ag1" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Somos una empresa de desarrollo de un Sistema de Información bajo plataforma web que permite a emprendedores de venta de computadores portátiles publicar sus productos y venderlos de forma segura.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ag = ayuda general -->
                            <h2 class="accordion-header" id="ag2">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#agcollapseTwo" aria-expanded="false" aria-controls="agcollapseTwo">
                                    ¿Cómo puedo contactar al soporte?
                                </button>
                            </h2>
                            <div id="agcollapseTwo" class="accordion-collapse collapse" aria-labelledby="ag2" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Nos puedes contactar a partir de nuestro correo electrónico <span class="text-decoration-underline">g6beginningrise@gmail.com </span>
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ag = ayuda general -->
                            <h2 class="accordion-header" id="ag3">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#agcollapseThree" aria-expanded="false" aria-controls="agcollapseThree">
                                    ¿Manejan envíos internacionales?
                                </button>
                            </h2>
                            <div id="agcollapseThree" class="accordion-collapse collapse" aria-labelledby="ag3" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Por el momento, se manejarán envíos únicamente para la ciudad de Bogotá.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ayuda General -->

                    <!-- Compras -->
                    <h3 class="mt-3 mb-3">Compras</h3>
                    <div class="accordion" id="compras">
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com1">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseOne" aria-expanded="false" aria-controls="comcollapseOne">
                                    ¿Cómo puedo realizar una compra en Beginning Rise?
                                </button>
                            </h2>
                            <div id="comcollapseOne" class="accordion-collapse collapse" aria-labelledby="com1" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Ingrese al menú del sitio web donde aparecerán diferentes opciones de equipos portátiles, elige el que se acople más a sus necesidades, una vez elegido el producto, seleccionamos el botón comprar, el articulo se enviará al carrito de compras. Para acceder al carrito de compras, debe dar click en el menú desplegable que dice "Mi Perfil", y seleccionamos la opción "Carrito de compras", ya dentro del carrito de compras, se puede continuar el proceso de compra o eliminar el producto del carrito en caso de haber seleccionado un producto erróneo.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com2">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseTwo" aria-expanded="false" aria-controls="comcollapseTwo">
                                    ¿Cómo pagar por una compra?
                                </button>
                            </h2>
                            <div id="comcollapseTwo" class="accordion-collapse collapse" aria-labelledby="com2" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    El sistema cuenta únicamente medios de pago electrónicos.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com3">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseThree" aria-expanded="false" aria-controls="comcollapseThree">
                                    ¿Qué métodos de pago puedo utilizar?
                                </button>
                            </h2>
                            <div id="comcollapseThree" class="accordion-collapse collapse" aria-labelledby="com3" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Existen diferentes opciones, tarjeta de crédito/débito y transferencia bancaria de PSE.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com4">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseFour" aria-expanded="false" aria-controls="comcollapseFour">
                                    ¿Cómo realizo el seguimiento de mi compra?
                                </button>
                            </h2>
                            <div id="comcollapseFour" class="accordion-collapse collapse" aria-labelledby="com4" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Para el seguimiento de su compra diríjase a la sección compras y seleccione el producto donde podrá ver el estado ya sea <span class="fw-bold">"Pago pendiente"</span> , <span class="fw-bold">"Pago recibido"</span>, <span class="fw-bold">"En camino"</span> y <span class="fw-bold">"Entregado"</span>.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com5">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseFive" aria-expanded="false" aria-controls="comcollapseFive">
                                    ¿Cómo recibir o retirar el producto?
                                </button>
                            </h2>
                            <div id="comcollapseFive" class="accordion-collapse collapse" aria-labelledby="com5" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Cada empresa contará con su propio método de entrega, ya sea por domicilio o recoger en tienda.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com6">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseSix" aria-expanded="false" aria-controls="comcollapseSix">
                                    ¿Cómo puedo cancelar una compra?
                                </button>
                            </h2>
                            <div id="comcollapseSix" class="accordion-collapse collapse" aria-labelledby="com6" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Diríjase a la sección <span class="fw-bold">"Mis compras"</span> desde el menú desplegable <span class="fw-bold">"Mi Perfil"</span>, Encontrará una lista de los productos adquiridos y podrá cancelar aquellos que <span class="fw-bold">solo</span> tengan el estado de <span class="fw-bold">"Pago pendiente"</span>.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com7">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseSeven" aria-expanded="false" aria-controls="comcollapseSeven">
                                    ¿Cómo puedo pedir el reembolso de un producto?
                                </button>
                            </h2>
                            <div id="comcollapseSeven" class="accordion-collapse collapse" aria-labelledby="com7" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    El reembolso deberá pedirse directamente a la empresa a la cual le compró el producto, según los datos de contacto que haya publicado en la plataforma.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com8">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseEight" aria-expanded="false" aria-controls="comcollapseEight">
                                    ¿Cómo puedo ver los detalles de mi adquisición?
                                </button>
                            </h2>
                            <div id="comcollapseEight" class="accordion-collapse collapse" aria-labelledby="com8" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Para los detalles de su compra dirigirse a <span class="fw-bold">"Mis compras"</span> y seleccione la opción <span class="fw-bold">"Detalles"</span> del producto que desea consultar para encontrar los datos generales de su adquisición.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com9">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseNine" aria-expanded="false" aria-controls="comcollapseNine">
                                    ¿Cómo calificar un producto?
                                </button>
                            </h2>
                            <div id="comcollapseNine" class="accordion-collapse collapse" aria-labelledby="com9" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En la sección de detalles de cualquier producto publicado, encontrará la opción para calificarlo de 1 a 5 estrellas.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com10">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseTen" aria-expanded="false" aria-controls="comcollapseTen">
                                    ¿Cómo denunciar una publicación?
                                </button>
                            </h2>
                            <div id="comcollapseTen" class="accordion-collapse collapse" aria-labelledby="com10" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En caso de encontrar alguna irregularidad en algún producto, por favor recopile información del producto, así como de la empresa que lo vende y envíe un correo electrónico a <span class="text-decoration-underline">g6beginningrise@gmail.com</span>.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- com = compras -->
                            <h2 class="accordion-header" id="com11">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#comcollapseEleven" aria-expanded="false" aria-controls="comcollapseEleven">
                                    ¿Cómo eliminar productos de mi carrito?
                                </button>
                            </h2>
                            <div id="comcollapseEleven" class="accordion-collapse collapse" aria-labelledby="com11" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Diríjase a la sección <span class="fw-bold">"Carrito de compras"</span> desde el menú desplegable <span class="fw-bold">"Mi Perfil"</span>, Encontrará una lista de los productos dentro del carrito y podrá eliminar aquellos que desee mediante el botón <span class="fw-bold">"Eliminar"</span>.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Compras -->

                    <!-- Ventas -->
                    <h3 class="mt-3 mb-3">Ventas</h3>
                    <div class="accordion" id="ventas">
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven1">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseOne" aria-expanded="false" aria-controls="vencollapseOne">
                                    ¿Cómo puedo publicar productos en Beginning Rise?
                                </button>
                            </h2>
                            <div id="vencollapseOne" class="accordion-collapse collapse" aria-labelledby="ven1" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Para subir productos, el requisito principal es tener una empresa registrada en la Cámara de Comercio de Bogotá, registrarse como empresa en Beginning Rise y esperar a que los administradores habiliten su cuenta para poder iniciar sesión.
                                    <br>
                                    <br>
                                    Para publicar un producto, seleccione la opción <span class="fw-bold">"Subir Producto"</span> y diligencie los datos correspondientes del formulario, al llenar todos los datos requeridos obligatorios haga click en el botón de <span class="fw-bold">"Subir Producto"</span>.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven2">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseTwo" aria-expanded="false" aria-controls="vencollapseTwo">
                                    ¿Cómo modificar una publicación?
                                </button>
                            </h2>
                            <div id="vencollapseTwo" class="accordion-collapse collapse" aria-labelledby="ven2" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Para modificar un producto nos dirigimos a cuenta, seleccionamos ver/editar producto y cambiamos los datos correspondientes del formulario y al llenar todos los datos requeridos damos en el botón de modificar el producto.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven3">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseThree" aria-expanded="false" aria-controls="vencollapseThree">
                                    ¿Puedo eliminar mi publicación?
                                </button>
                            </h2>
                            <div id="vencollapseThree" class="accordion-collapse collapse" aria-labelledby="ven3" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Para eliminar un producto nos dirigimos a cuenta, seleccionamos ver/editar producto y seleccionamos el botón de eliminar el producto.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven4">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseFour" aria-expanded="false" aria-controls="vencollapseFour">
                                    ¿Qué productos no son permitidos?
                                </button>
                            </h2>
                            <div id="vencollapseFour" class="accordion-collapse collapse" aria-labelledby="ven4" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Beginning Rise es un sistema para compra y venta de <span class="fw-bold">Computadores Portátiles</span>, todo producto que no cumpla con ese requisito será eliminado por los administradores del sistema.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven5">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseFive" aria-expanded="false" aria-controls="vencollapseFive">
                                    ¿Existe reputación en el sistema?
                                </button>
                            </h2>
                            <div id="vencollapseFive" class="accordion-collapse collapse" aria-labelledby="ven5" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En base a las calificaciones de sus productos, se generará una reputación visible para todos los compradores que utilicen Beginning Rise.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven6">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseSix" aria-expanded="false" aria-controls="vencollapseSix">
                                    ¿Cómo registrar la cancelación de un producto?
                                </button>
                            </h2>
                            <div id="vencollapseSix" class="accordion-collapse collapse" aria-labelledby="ven6" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Desde su perfil de empresa, diríjase a la opción <span class="fw-bold">"Ventas"</span>, desde allí podrá registrar la cancelación de una venta en el sistema en caso de que un cliente contacte con usted para cancelar una compra.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- ven = ventas -->
                            <h2 class="accordion-header" id="ven7">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#vencollapseSeven" aria-expanded="false" aria-controls="vencollapseSeven">
                                    ¿Cómo le coloco descuentos a mis productos?
                                </button>
                            </h2>
                            <div id="vencollapseSeven" class="accordion-collapse collapse" aria-labelledby="ven7" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En la sección Ver/Editar productos, de click en el botón <span class="fw-bold">"Modificar"</span> del producto correspondiente y en el campo "Porcentaje de descuento" ingrese el valor deseado, el sistema se encargará de calcular el nuevo precio y automáticamente destacará su producto para que los compradores lo encuentren de manera más sencilla.
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Ventas -->

                    <!-- Cuenta -->
                    <h3 class="mt-3 mb-3">Cuenta</h3>
                    <div class="accordion" id="Cuenta">
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- cuen = cuenta -->
                            <h2 class="accordion-header" id="cuen1">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cuencollapseOne" aria-expanded="false" aria-controls="cuencollapseOne">
                                    ¿Cómo puedo actualizar mis datos?
                                </button>
                            </h2>
                            <div id="cuencollapseOne" class="accordion-collapse collapse" aria-labelledby="cuen1" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En el menú <span class="fw-bold">"Mi Perfil"</span>, encontrará la opción <span class="fw-bold">"Editar Perfil"</span> en donde encontrará un formulario con su información registrada para poderla actualizar.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- cuen = cuenta -->
                            <h2 class="accordion-header" id="cuen2">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cuencollapseTwo" aria-expanded="false" aria-controls="cuencollapseTwo">
                                    No puedo ingresar a mi cuenta.
                                </button>
                            </h2>
                            <div id="cuencollapseTwo" class="accordion-collapse collapse" aria-labelledby="cuen2" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    En caso de olvido de contraseña, puede ir a la opción "Olvidé mi contraseña" y continuar el proceso que indicará el sistema, en caso de que sospeche que están accediendo a su cuenta sin su autorización, póngase en contacto con los administradores del sistema mediante el correo <span class="text-decoration-underline">g6beginningrise@gmail.com </span>.
                                    <br>
                                    <br>
                                    De todas formas, si desea mejorar la seguridad de su cuenta, le dejamos las siguientes recomendaciones:
                                    <br>
                                    <ul>
                                        <li>Hacer uso de una contraseña que cuenta por lo menos con mayusculas, minusculas y números.</li>
                                        <li>No utilizar una contraseña que ya tenga en algún otro sitio.</li>
                                        <li>Contar con un antivirus o extensión en el navegador que ayude a evitar enlaces sospechosos.</li>
                                        <li>Cambiar de contraseña por lo menos cada 3 o 4 meses.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- cuen = cuenta -->
                            <h2 class="accordion-header" id="cuen3">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cuencollapseThree" aria-expanded="false" aria-controls="cuencollapseThree">
                                    ¿Cómo puedo registrar mi empresa para vender productos?
                                </button>
                            </h2>
                            <div id="cuencollapseThree" class="accordion-collapse collapse" aria-labelledby="cuen3" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Desde la página principal, haga click en el botón <span class="fw-bold">"Registrarse"</span>, seleccione el rol de Empresa, diligencie los datos y en las siguientes 24 horas un administrador del sistema se encargará de activar su cuenta y notificarle al correo electrónico que registró.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- cuen = cuenta -->
                            <h2 class="accordion-header" id="cuen4">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cuencollapseFour" aria-expanded="false" aria-controls="cuencollapseFour">
                                    Quiero eliminar mi cuenta
                                </button>
                            </h2>
                            <div id="cuencollapseFour" class="accordion-collapse collapse" aria-labelledby="cuen4" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Si desea que su cuenta sea eliminada, deberá ponerse en contacto con los administradores del sistema, para que se haga efectiva su petición.
                                </div>
                            </div>
                        </div>
                        <!-- Desplegable -->
                        <div class="accordion-item">
                            <!-- Pregunta -->
                            <!-- cuen = cuenta -->
                            <h2 class="accordion-header" id="cuen5">
                                <button class="accordion-button collapsed fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#cuencollapseFive" aria-expanded="false" aria-controls="cuencollapseFive">
                                    Recibí un correo de Beginning Rise solicitando mis datos de ingreso.
                                </button>
                            </h2>
                            <div id="cuencollapseFive" class="accordion-collapse collapse" aria-labelledby="cuen5" data-bs-parent="#accordionExample">
                                <!-- Texto -->
                                <div class="accordion-body text-justify">
                                    Beginning Rise <span class="fw-bold">NUNCA</span> lo contactará para pedirle información de su cuenta, cualquier intento de que alguien intente preguntar su información de ingreso haciéndose pasar por nosotros, será fraudulento y por su seguridad corte el contacto con dichas personas inescrupulosas.
                                </div>
                            </div>
                        </div>
                        <!-- Cuenta -->
                    </div>
                    <!-- Contacto -->
                    <div class="card-footer">
                        <h4 class="text-center mt-3">
                            ¿No encuentra lo que busca?
                        </h4>
                        <p class="text-center"><span class="fw-bold">Contáctenos: </span><a href="mailto:g6beginningrise@gmail.com">g6beginningrise@gmail.com</a></p>
                    </div>
                    <!-- Contacto -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "view/layouts/footer.php" ?>