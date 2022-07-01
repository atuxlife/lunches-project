
function renderDT(tableId){
    $(tableId).dataTable({
        'aLengthMenu'       : [[5,10, 25, 50, -1], [5,10, 25, 50, "Todos"]],
        //'aLengthMenu'       : [[5], [5]],
        'iDisplayStart'     :   0,
        'iDisplayLength'    :   10,
        'aaSorting'         :   [[ 0, 'desc' ]],
        "oLanguage" : {
            "sProcessing"       :   "Procesando...",
            "sLengthMenu"       :   "Mostrar _MENU_ artículos",
            "sZeroRecords"      :   "No se encontraron resultados",
            "sEmptyTable"       :   "Ningún dato disponible en esta tabla",
            "sInfo"             :   "Artículos del _START_ al _END_ de un total de _TOTAL_ artículos",
            "sInfoEmpty"        :   "Artículos del 0 al 0 de un total de 0 artículos",
            "sInfoFiltered"     :   "(filtrado de un total de _MAX_ artículos)",
            "sInfoPostFix"      :   "",
            "sSearch"           :   "Buscar:",
            "sUrl"              :   "",
            "sInfoThousands"    :   ",",
            "sLoadingRecords"   :   "Cargando...",
            "oPaginate": {
                "sFirst"    :   "Primero",
                "sLast"     :   "Último",
                "sNext"     :   "Sig.",
                "sPrevious" :   "Ant."
            },
            "oAria": {
                "sSortAscending"    :   ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending"   :   ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
}

function destroyTable(tableId){
    $(tableId).DataTable().destroy();
}