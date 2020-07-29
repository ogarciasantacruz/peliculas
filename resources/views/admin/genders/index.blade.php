@extends('admin.layouts.app')

@section('content')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
            <div class="kt-subheader__breadcrumbs">
                <a href="/home" class="kt-subheader__breadcrumbs-home"><i class="flaticon2-shelter"></i></a>
                <span class="kt-subheader__breadcrumbs-separator"></span>
                <span class="kt-subheader__breadcrumbs-link kt-subheader__breadcrumbs-link--active">Generos</span>
            </div>
        </div>
                
    </div>
    <!-- end:: Subheader -->


    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">
        

        <div class="kt-portlet kt-portlet--mobile">
            <div class="kt-portlet__head kt-portlet__head--lg">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">Listado de generos                            
                    </h3>
                </div>
                    
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="" class="btn btn-brand btn-bold btn-upper btn-font-sm" data-toggle="modal" data-target="#genderCreateModal">
                            <i class="la la-plus"></i>
                            Nuevo genero
                        </a>
                    </div>
                </div>
            </div>
                                
            <div class="kt-portlet__body">

                <!--begin: Search Form -->
                <div class="kt-form kt-fork--label-right kt-margin-t-20 kt-margin-b-10">
                    <div class="row align-items-center">
                        <div class="col-xl-8 order-2 order-xl-1">
                            <div class="row align-items-center">
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-input-icon kt-input-icon--left">
                                        <input type="text" class="form-control" placeholder="Buscar..." id="generalSearch">
                                        <span class="kt-input-icon__icon kt-input-icon__icon--left">
                                            <span><i class="la la-search"></i></span>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-4 kt-margin-b-20-tablet-and-mobile">
                                    <div class="kt-form__group kt-form__group--inline">
                                        <div class="kt-form__label">
                                            <label>Status:</label>
                                        </div>
                                        <div class="kt-form__control">
                                            <select class="form-control bootstrap-select" id="kt_form_status">
                                                <option value="">Todos</option>
                                                <option value="Active">Activos</option>
                                                <option value="Suspended">Suspendidos</option>                                                
                                            </select>
                                        </div>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>

                <!--end: Search Form -->
            </div>
            <div class="kt-portlet__body kt-portlet__body--fit">

                <!--begin: Datatable -->
                <div class="kt_datatable" id="local_data"></div>

                <!--end: Datatable -->
            </div>
        </div>
    </div>
                                        
@endsection


@section('modals')

    @include('admin.forms.genders.create')
    @include('admin.forms.genders.edit')

@endsection


@section('scripts')
    
    <!--begin::Page Scripts(used by this page) -->
    <script type="text/javascript">

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
                                            
                                        result += '<a class="dropdown-item editGender" data-toggle="modal" data-target="#genderEditModal" data-genderId="'+ row.id  +'"  href="#"><i class="la la-edit"></i> Editar genero</a>';

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
        });

    </script>    

    <script type="text/javascript">
        $(document).ready(function(){
            
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

    </script>
@endsection