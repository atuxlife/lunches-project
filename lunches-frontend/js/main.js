
const servidor = 'http://localhost:8000/api/';

const loader = `<div class="row">
                    <div class="col-12">
                        <div class="d-flex justify-content-center">
                            <div class="spinner-border text-info" style="width: 4rem; height: 4rem;" role="status">
                                <span class="sr-only"></span>
                            </div>
                        </div>
                    </div>
                </div>`;

$(document).ready(function() {
    loadMenus();
    loadOrdenesCocina();
    loadOrdenesCompra();
    loadInventario();
    loadMercado();
});

function loadMenus(){

    let targetMenu = '#listMenu';
    
    $.ajax({
        url: servidor+'menus',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        beforeSend: function(){
            $(targetMenu).html(loader).fadeIn('slow');
            destroyTable('#tabMenu');
        },
        success: function($dres) {
            
            let lineMenu = ``;
            
            $.each($dres, function( key, value ) {
                lineMenu += `<tr>
                                <td class="text-center">${value.id}</td>
                                <td>${value.nombre}</td>
                                <td class="text-center">
                                    <button type="button" idMenu="${value.id}" class="btn btn-success btn-sm ingredientesPlato">Ver</button>
                                </td>
                            </tr>`;
            });
            
            let tableMenu = `<table id="tabMenu" class="table table-bordered">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">#</th>
                                        <th scope="col" class="text-center" width="80%">Plato</th>
                                        <th scope="col" class="text-center" width="15%">Ingredientes</th>
                                    </tr>
                                </thead>
                                <tbody>${lineMenu}</tbody>
                            </table>`;

            $(targetMenu).html(tableMenu);
            renderDT('#tabMenu');
        }
    }).done(function() {
        $(targetMenu).fadeIn('slow');
    });

}

function loadOrdenesCocina(){

    let targetOrder = '#listOrders';
    
    $.ajax({
        url: servidor+'solicitudes',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        beforeSend: function(){
            $(targetOrder).html(loader).fadeIn('slow');
            destroyTable('#tabOrder');
        },
        success: function($dres) {
            
            let lineOrder = ``;
            
            $.each($dres, function( key, value ) {
                lineOrder += `<tr>
                                <td class="text-center">${value.Id}</td>
                                <td>${value.Order}</td>
                                <td class="text-center">${value.Status}</td>
                              </tr>`;
            });
            
            let tableOrder = `<table id="tabOrder" class="table table-bordered">
                                <thead class="bg-secondary">
                                    <tr>
                                        <th scope="col" class="text-center" width="5%">#</th>
                                        <th scope="col" class="text-center" width="80%">Plato</th>
                                        <th scope="col" class="text-center" width="15%">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>${lineOrder}</tbody>
                            </table>`;

            $(targetOrder).html(tableOrder);
            renderDT('#tabOrder');
        }
    }).done(function() {
        $(targetOrder).fadeIn('slow');
    });

}

function loadOrdenesCompra(){

    let targetPurchaseOrder = '#listPurchaseOrders';
    
    $.ajax({
        url: servidor+'ordenes-compra',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        beforeSend: function(){
            $(targetPurchaseOrder).html(loader).fadeIn('slow');
            destroyTable('#tabPurchaseOrder');
        },
        success: function($dres) {
            
            let linePurchaseOrder = ``;
            
            $.each($dres, function( key, value ) {
                linePurchaseOrder += `<tr>
                                        <td class="text-center">${value.Id}</td>
                                        <td>${value.Ingredient}</td>
                                        <td class="text-center">${value.Qty}</td>
                                        <td class="text-center">${value.Status}</td>
                                      </tr>`;
            });
            
            let tablelinePurchaseOrder = `<table id="tabPurchaseOrder" class="table table-bordered">
                                            <thead class="bg-secondary">
                                                <tr>
                                                    <th scope="col" class="text-center" width="5%">#</th>
                                                    <th scope="col" class="text-center" width="65%">Ingredient</th>
                                                    <th scope="col" class="text-center" width="15%">Qty</th>
                                                    <th scope="col" class="text-center" width="15%">Estado</th>
                                                </tr>
                                            </thead>
                                            <tbody>${linePurchaseOrder}</tbody>
                                          </table>`;

            $(targetPurchaseOrder).html(tablelinePurchaseOrder);
            renderDT('#tabPurchaseOrder');
        }
    }).done(function() {
        $(targetPurchaseOrder).fadeIn('slow');
    });

}

function loadInventario(){

    let targetInventario = '#listInventario';
    
    $.ajax({
        url: servidor+'ingredientes',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        beforeSend: function(){
            $(targetInventario).html(loader).fadeIn('slow');
            destroyTable('#tabInventario');
        },
        success: function($dres) {
            
            let lineInventario = ``;
            
            $.each($dres, function( key, value ) {
                lineInventario += `<tr>
                                        <td class="text-center">${value.Id}</td>
                                        <td>${value.Ingredient}</td>
                                        <td class="text-center">${value.Stock}</td>
                                    </tr>`;
            });
            
            let tableInventario = `<table id="tabInventario" class="table table-bordered">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th scope="col" class="text-center" width="5%">#</th>
                                                <th scope="col" class="text-center" width="80%">Ingredient</th>
                                                <th scope="col" class="text-center" width="15%">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>${lineInventario}</tbody>
                                    </table>`;

            $(targetInventario).html(tableInventario);
            renderDT('#tabInventario');
        }
    }).done(function() {
        $(targetInventario).fadeIn('slow');
    });

}

function loadMercado(){

    let targetMercado = '#listMercado';
    
    $.ajax({
        url: servidor+'mercado',
        type: 'GET',
        dataType: 'json',
        cache: false, // Appends _={timestamp} to the request query string
        beforeSend: function(){
            $(targetMercado).html(loader).fadeIn('slow');
            destroyTable('#tabMercado');
        },
        success: function($dres) {
            
            let lineMercado = ``;
            
            $.each($dres, function( key, value ) {
                lineMercado += `<tr>
                                    <td class="text-center">${value.Id}</td>
                                    <td>${value.Ingredient}</td>
                                    <td class="text-center">${value.Stock}</td>
                                </tr>`;
            });
            
            let tableInventario = `<table id="tabMercado" class="table table-bordered">
                                        <thead class="bg-secondary">
                                            <tr>
                                                <th scope="col" class="text-center" width="5%">#</th>
                                                <th scope="col" class="text-center" width="80%">Ingredient</th>
                                                <th scope="col" class="text-center" width="15%">Stock</th>
                                            </tr>
                                        </thead>
                                        <tbody>${lineMercado}</tbody>
                                    </table>`;

            $(targetMercado).html(tableInventario);
            renderDT('#tabMercado');
        }
    }).done(function() {
        $(targetMercado).fadeIn('slow');
    });

}