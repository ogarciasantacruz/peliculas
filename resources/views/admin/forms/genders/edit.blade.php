<div class="modal fade" id="genderEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar genero</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true" class="la la-remove"></span>
                </button>
            </div>

            <form class="kt-form kt-form--label-right" id="editFormGender" method="post" action="#">
                @method('PATCH')
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group row kt-margin-t-20">
                        <label class="col-form-label col-lg-3 col-sm-12">Nombre</label>
                        <div class="col-lg-9 col-md-9 col-sm-12 input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="flaticon-edit"></i></span>
                            </div>
							<input type="text" class="form-control" placeholder="Nombre del genero" name="name" id="nameEdit" required aria-describedby="basic-addon1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-lg-3 col-sm-12">Status</label>
                        <div class="col-lg-9 col-md-9 col-sm-12">
                            <select class="form-control kt_selectpicker" name="status" id="statusEdit">                                                                
                                <option value="Active">Activo</option>
                                <option value="Suspended">Suspendido</option>
                            </select>
                        </div>
                    </div> 
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary kt-btn" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-brand kt-btn">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
