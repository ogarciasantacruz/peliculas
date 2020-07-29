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

                @can('Registro-Catalogo-Generos')
                <div class="kt-portlet__head-toolbar">
                    <div class="kt-portlet__head-wrapper">
                        <a href="" class="btn btn-brand btn-bold btn-upper btn-font-sm" data-toggle="modal" data-target="#genderCreateModal">
                            <i class="la la-plus"></i>
                            Nuevo genero
                        </a>
                    </div>
                </div>
                @endcan
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
        var editInfo = false;

        @can('Edicion-Catalogo-Generos')
            editInfo = true;
        @endcan

    </script>    

    <script type="text/javascript" src="/js/admin/genders.js"></script>
@endsection