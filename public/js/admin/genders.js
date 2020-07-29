$(document).ready(function(){
            
    $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/genders/list-genders',
            beforeSend: function () {                                            
                    
                notification('Cargando la información...', 'Espere un momento');
                
            }
        }).done(function (response) {

            var dataJSONArray = response.genders;

            var KTDatatableDataLocalDemo = function() {
                // Private functions

                // demo initializer
                var demo = function() {

                    var datatable = $('.kt_datatable').KTDatatable({
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
                            field: 'status',
                            title: 'Status',
                            // callback function support for column rendering
                            template: function(row) {
                                var status = {
                                    Suspended: {
                                        'title': 'Suspendido',
                                        'class': ' kt-badge--metal'
                                    },
                                    Active: {
                                        'title': 'Activo',
                                        'class': ' kt-badge--success'
                                    },
                    
                                };

                                return '<span class="kt-badge ' + status[row.status].class + ' kt-badge--inline kt-badge--pill">' + status[row.status].title + '</span>';
                            },
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
                                
                                if (editInfo) {    
                                    result += '<a class="dropdown-item editGender" data-toggle="modal" data-target="#genderEditModal" data-genderId="'+ row.id  +'"  href="#"><i class="la la-edit"></i> Editar genero</a>';
                                }
                                
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




        /* Edit Gender */
        $(document).on('click', '.editGender', function(){

            var genderId =       $(this).attr('data-genderId');

            $.ajax({
                type: 'GET',
                dataType: 'json',
                url: '/genders/' + genderId,
                beforeSend: function () {

                    notification('Cargando la información...', 'Espere un momento');
                    
                }
            }).done(function (response) {

                if ( response.exito ) {

                    var name =          response.gender.name;
                    var status =        response.gender.status;
                    
                    $('#nameEdit').val(name);
                    $('#statusEdit').val(status).prop('selected', true);
                    $('#statusEdit').change();          
                    
                    document.getElementById('editFormGender').action ='/genders-update/' + genderId;

                } else {
                    toastr.error('Error al obtener la información');
                }
    
            }).fail(function () {

                console.log("Error al obtener la información");
            });
            
        });
});