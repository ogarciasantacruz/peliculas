var KTDatatableDataLocalDemo;
var datatable;

$('#releaseDate, #releaseDateEdit').datetimepicker({
    format: "dd/mm/yyyy",
    todayHighlight: true,
    autoclose: true,
    startView: 2,
    minView: 2,
    forceParse: 0,
    pickerPosition: 'bottom-left'
});



function loadMovies()
{
                        
    $.ajax({
        type: 'GET',
        dataType: 'json',
        url: '/movies/list-movies',
        beforeSend: function () {                                            
                
            notification('Cargando la información...', 'Espere un momento');
            
        }
    }).done(function (response) {

        var dataJSONArray = response.movies;

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
                        field: 'gender.name',
                        title: 'Genero'                                    
                    },
                    {
                        field: 'release_date',
                        title: 'Fecha de estreno',
                        template: function(row) {
                            return moment(row.release_date).format('DD/MM/YYYY');
                        }                             
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
                                
                            result += '<a class="dropdown-item editMovie" data-toggle="modal" data-target="#movieEditModal" data-movieId="'+ row.id  +'"  href="#"><i class="la la-edit"></i> Editar película</a>';

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
            
}



$(document).ready(function(){

    loadMovies();

    /* Store */
    $(document).on('click', '.submitBtn', function(){

        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '/movies/',
            data: {
                "title":            $('#title').val(),
                "gender":           $('#gender').val(),
                "release_date":     $('#releaseDate').val(),
                "description":      $('#description').val(),
                "_token":           _token
            },
            beforeSend: function () {

                notification('Procesando la información...', 'Espere un momento');
                
            }
        }).done(function (response) {

            if ( response.register ) {

                datatable.destroy();
                loadMovies();
                $( ".closeModal" ).trigger( "click" );      

                toastr.success('Se ha registrado una nueva película de manera exitosa', 'Películas');

            } else {

                if (response.errors != null) {

                    var errors = "";

                    $.each(response.errors, function(index, value){
                        errors += value;
                        errors += "<br />";
                    });

                    toastr.error(errors);
                }
                
            }

        }).fail(function () {

            console.log("Error al procesar la información");
        });

    });

    
    /* Edit Movie */
    $(document).on('click', '.editMovie', function(){

        var movieId =       $(this).attr('data-movieId');

        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/movies/' + movieId,
            beforeSend: function () {

                notification('Cargando la información...', 'Espere un momento');
                
            }
        }).done(function (response) {

            if ( response.exito ) {

                var title =         response.movie.title;
                var status =        response.movie.status;
                var release_date =  response.movie.release_date;
                var gender =        response.movie.gender_id;
                var description =   response.movie.description;
                
                $('#movieId').val(movieId);
                $('#titleEdit').val(title);
                $('#releaseDateEdit').val(moment(release_date).format('DD/MM/YYYY'));
                $('#descriptionEdit').val(description);

                $('#genderEdit').val(gender).prop('selected', true);
                $('#genderEdit').change();

                $('#statusEdit').val(status).prop('selected', true);
                $('#statusEdit').change();

            } else {
                toastr.error('Error al obtener la información');
            }

        }).fail(function () {

            console.log("Error al obtener la información");
        });
        
    });



    /* Update */
    $(document).on('click', '.submitBtnEdit', function(){

        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'PUT',
            dataType: 'json',
            url: '/movies-update/' + $('#movieId').val(),
            data: {
                "title":            $('#titleEdit').val(),
                "gender":           $('#genderEdit').val(),
                "release_date":     $('#releaseDateEdit').val(),
                "description":      $('#descriptionEdit').val(),
                "status":           $('#statusEdit').val(),
                "_token":           _token
            },
            beforeSend: function () {

                notification('Procesando la información...', 'Espere un momento');
                
            }
        }).done(function (response) {

            if ( response.register ) {

                datatable.destroy();
                loadMovies();
                $( ".closeModal" ).trigger( "click" );      

                toastr.success('Se ha editado la información de la película de manera exitosa', 'Películas');

            } else {

                if (response.errors != null) {

                    var errors = "";

                    $.each(response.errors, function(index, value){
                        errors += value;
                        errors += "<br />";
                    });

                    toastr.error(errors);
                }
                
            }

        }).fail(function () {

            console.log("Error al procesar la información");
        });

    });

});