
// Click en botón de mostrar ingredientes de un plato
$(document).on('click','.ingredientesPlato',function(){

    let idMenu = $(this).attr('idMenu');

    $.ajax({
        url: servidor+'menus/'+idMenu,
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            
            $('#modalIngredientesLabel').html($dres.menu.nombre);

            let lineIngredientes = '';

            $.each($dres.ingredientes, function(key, value) {
                lineIngredientes += `<tr>
                                        <td>${value.nombre}</td>
                                        <td class="text-center">1</td>
                                     </tr>`;
            });

            $('#tbodyIngredientes').html(lineIngredientes);

        }
    }).done(function() {
        const myModal = new bootstrap.Modal('#modalIngredientes', {
            keyboard: false
        });
        myModal.show();
    });

});

// Click en botón de pedir un plato
$(document).on('click','#btnPedirPlato',function(){

    $.ajax({
        url: servidor+'solicitar-plato',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            if( $dres.error == 1 ){
                toastr.error($dres.message, 'Solicitud de plato', {timeOut: 5000});
            } else {
                toastr.success($dres.message, 'Solicitud de plato', {timeOut: 5000});
            }            
        }
    }).done(function() {
        actualizarTablas();
    });

});

// Click en botón de reprocesar órdenes
$(document).on('click','#btnReprocesarOrdenes',function(){

    $.ajax({
        url: servidor+'reprocesar-solicitudes',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            toastr.success($dres.message, 'Reprocesando órdenes', {timeOut: 5000});
        }
    }).done(function() {
        actualizarTablas();
    });

});

// Click en botón de comprar en mercado
$(document).on('click','#btnComprarMercado',function(){

    $.ajax({
        url: servidor+'comprar-mercado',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            toastr.success($dres.message, 'Comprando en mercado', {timeOut: 5000});
        }
    }).done(function() {
        actualizarTablas();
    });

});

// Click en botón de solicitar ingredientes
$(document).on('click','#btnSolicitarIngredientes',function(){

    $.ajax({
        url: servidor+'solicitar-compra',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            toastr.success($dres.message, 'Solicitud de ingredientes', {timeOut: 5000});
        }
    }).done(function() {
        actualizarTablas();
    });

});

// Click en botón de renovar inventario de mercado
$(document).on('click','#btnRenovarMercado',function(){

    $.ajax({
        url: servidor+'actualizar-mercado',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        success: function($dres) {
            toastr.success($dres.message, 'Renovar stock de mercado', {timeOut: 5000});
        }
    }).done(function() {
        actualizarTablas();
    });

});

function actualizarTablas(){
    loadOrdenesCocina();
    loadOrdenesCompra();
    loadInventario();
    loadMercado();
}