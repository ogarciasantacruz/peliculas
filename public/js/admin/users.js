                        
$.ajax({
    type: 'GET',
    dataType: 'json',
    url: '/api/users',
    beforeSend: function () {                                            
            
        notification('Cargando la información...', 'Espere un momento');
        
    }
}).done(function (response) {

    var dataJSONArray = response.users;

    console.log(dataJSONArray);

    KTDatatableDataLocalDemo = function() {
        // Private functions

        // demo initializer
        var demo = function() {

            datatable = $('.kt_datatable').KTDatatable({
                // datasource definition
                data: {
                    type: 'local',
                    source: dataJSONArray,
                    pageSize: 10,
                },

                // layout definition
                layout: {
                    scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
                    // height: 450, // datatable's body's fixed height
                    footer: false, // display/hide footer
                },

                // column sorting
                sortable: true,
                pagination: true,
                search: {
                    input: $('#generalSearch'),
                },
                // columns definition
                columns: [
                {
                    field: 'name',
                    title: 'Nombre'                                    
                }, 
                {
                    field: 'last_name',
                    title: 'Apellido'                                    
                },
                {
                    field: 'phone',
                    title: 'Teléfono'                                    
                },
                {
                    field: 'email',
                    title: 'Email'                                    
                },
                {
                    field: 'Actions',
                    title: 'Acciones',
                    sortable: false,
                    width: 110,
                    overflow: 'visible',
                    autoHide: false,
                    template: function(row) {
                        var result = '\
                        <div class="dropdown">\
                            <a href="javascript:;" class="btn btn-sm btn-clean btn-icon btn-icon-md" data-toggle="dropdown">\
                                <i class="la la-cog"></i>\
                            </a>\
                            <div class="dropdown-menu dropdown-menu-right">';
                        
                        result += '<a class="dropdown-item editMovie" href="/users/'+ row.id +'/movies"><i class="la la-eye"></i> Ver películas favoritas</a>';

                        result += '</div></div>';

                        return result;
                    },
                }],
            });

            $('#kt_form_status').on('change', function() {
                
                datatable.search($(this).val(), 'status');
            });                            

            $('#kt_form_status,#kt_form_type').selectpicker();

        };

        return {
            // Public functions
            init: function() {
                // init dmeo
                demo();
            }
        };
    }();

    jQuery(document).ready(function() {
        KTDatatableDataLocalDemo.init();
    });

}).fail(function () {

    console.log("Error al obtener la información");
});