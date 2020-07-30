                        
$.ajax({
    type: 'GET',
    dataType: 'json',
    url: '/api/users/' + userId,
    beforeSend: function () {                                            
            
        notification('Cargando la información...', 'Espere un momento');
        
    }
}).done(function (response) {

    var dataJSONArray = response.user.movies_user;
    
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
                    field: 'title',
                    title: 'Título'                                    
                }, 
                {
                    field: 'release_date',
                    title: 'Fecha de estreno',
                    template: function(row) {
                        return moment(row.release_date).format('DD/MM/YYYY');
                    }
                },
                {
                    field: 'gender.name',
                    title: 'Genero'                                    
                },
                {
                    field: 'description',
                    title: 'Descripción'                                    
                }
                ],
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