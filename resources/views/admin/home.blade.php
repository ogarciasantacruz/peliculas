@extends('admin.layouts.app')

@section('content')
    <!-- begin:: Subheader -->
    <div class="kt-subheader   kt-grid__item" id="kt_subheader">
        <div class="kt-subheader__main">
            <h3 class="kt-subheader__title">Dashboard</h3>
            <span class="kt-subheader__separator kt-hidden"></span>
        </div>
        <div class="kt-subheader__toolbar">
            <div class="kt-subheader__wrapper">
                
            </div>
        </div>
    </div>
    <!-- end:: Subheader -->

    <!-- begin:: Content -->
    <div class="kt-content  kt-grid__item kt-grid__item--fluid" id="kt_content">

        <form class="kt-form" method="post" action="/favorites">
            @method('PATCH')
            {{ csrf_field() }}
            <div class="kt-portlet">                                            
                <!--begin::Form-->                
                    <div class="kt-portlet__body">
                        <div class="form-group form-group-last">
                            <div class="alert alert-secondary" role="alert">
                                <div class="alert-icon"><i class="flaticon-warning kt-font-brand"></i></div>
                                <div class="alert-text">
                                    Selecciona tus películas favoritas y da click en Guardar
                                </div>
                            </div>
                        </div>                        
                    </div>
                <!--end::Form-->
            </div>

            <!--begin::Row-->
            <div class="row">
        
                @foreach($movies AS $movie)
                <div class="col-lg-6 col-xl-4 order-lg-1 order-xl-1">
                    <!--begin::Portlet-->
                    <div class="kt-portlet kt-portlet--height-fluid kt-widget-12">
                        <div class="kt-portlet__body">
                            <div class="kt-widget-12__body">
                                <div class="kt-widget-12__head">
                                    <div class="kt-widget-12__date kt-widget-12__date--success">
                                        <span class="kt-widget-12__day">{{ $movie->release_date->format('d') }}</span>
                                        <span class="kt-widget-12__month">{{ $movie->release_date->format('M') }}</span>
                                    </div>
                                    <div class="kt-widget-12__label">
                                        <h3 class="kt-widget-12__title">{{ $movie->title }}</h3>
                                    </div>
                                </div>
                                <div class="kt-widget-12__info">
                                    {{ $movie->description }}
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot kt-portlet__foot--md">
                            <div class="kt-portlet__foot-wrapper">
                                <div class="kt-portlet__foot-info">
                                    
                                </div>
                                <div class="kt-portlet__foot-toolbar">
                                    <label class="kt-checkbox kt-checkbox--bold kt-checkbox--success">
                                        <input type="checkbox" name="movies[]" value="{{ $movie->id }}" @if(in_array($movie->id, $favorites)) checked="checked" @endif> Selecciona
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Portlet-->
                </div>
                @endforeach
                
                
            </div>
            <!--end::Row-->


            <div class="kt-portlet">
                <!--begin::Form-->                    
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            <button type="reset" class="btn btn-secondary">Cancelar</button>
                        </div>
                    </div>
                <!--end::Form-->
            </div>
        </form>

    <!--end::Dashboard 2-->
    </div>

    <!-- end:: Content -->
@endsection