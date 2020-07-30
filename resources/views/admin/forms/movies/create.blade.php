<div class="modal fade" id="movieCreateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Nueva película</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <form class="kt-form kt-form--label-right" method="post" id="newMovie">
                <div class="modal-body">
                    <div class="form-group row kt-margin-t-20">
                        <label class="col-form-label col-lg-3 col-sm-12">Título</label>
                        <div class="col-lg-9 col-md-9 col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="flaticon-edit"></i></span>
                            </div>
							<input type="text" class="form-control" placeholder="Título de la película" name="title" id="title" required aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Genero</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control kt_selectpicker" name="gender" id="gender" required>  
                                <option value="">Selecciona una opción</option>
                                @foreach($genders->sortBy('name') AS $gender)
                                    <option value="{{ $gender->id }}">{{ $gender->name }}</option>
                                @endforeach                                
                            </select>
                        </div>
                    </div> 

                    <div class="form-group row kt-margin-t-20">
                        <label class="col-form-label col-lg-3 col-sm-12">Fecha de estreno</label>
                        <div class="col-lg-9 col-md-9 col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="la la-calendar"></i></span>
                            </div>
							<input type="text" class="form-control" name="release_date" required id="releaseDate" readonly="" placeholder="Selecciona la fecha de estreno">
                        </div>
                    </div>

                    <div class="form-group row kt-margin-t-20">
                        <label class="col-form-label col-lg-3 col-sm-12">Descripción</label>
                        <div class="col-lg-9 col-md-9 col-sm-12 input-group">
                            <textarea class="form-control" name="description" id="description" rows="10"></textarea>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary kt-btn closeModal" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-brand kt-btn submitBtn">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
