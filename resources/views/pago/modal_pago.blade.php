<!-- Modal -->
<div class="modal fade" id="pagoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Pago de cuota</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Grupo-Orden Titular</label>
                                <input  readonly="true" id="datosplan" name="datosplan" class="form-control" value="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Gestión</label>
                                <select class="form-control" id="selectgestion" name="selectgestion">
                                    @foreach($gestiones as $gestion)
                                        <option value="{{$gestion->id}}">{{$gestion->descripcion}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            @php
                                $dateActual = date('Y-m-d');
                            @endphp
                            <div class="form-group">
                                <label>Fecha de confirmación</label>
                                <input name="fechaconfirmacion" id="fechaconfirmacion" required
                                       class="form-control"
                                       {{--type="date" value="{{date('Y-m-d', strtotime('-1 year', strtotime($dateActual)))}}">--}}
                                       type="date" value="{{$dateActual}}">
                            </div>
                            <div class="form-group">
                                <label>Observación</label>
                                <textarea name="contenido" id="contenido" class="form-control"></textarea>
                            </div>
                        </div>

                        <input hidden id="numsoliges" name="numsoliges" value="">
                        <input hidden id="grupogestion" name="grupogestion" value="">
                        <input hidden id="ordengestion" name="ordengestion" value="">
                        <input hidden id="soliedit" name="soliedit" value="">
                        <input hidden id="modulogestion" name="modulogestion" value="">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>