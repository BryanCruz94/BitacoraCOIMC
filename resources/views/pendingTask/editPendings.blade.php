@extends('adminlte::page')

@section('title', 'CONSIGNAS')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>CONSIGNAS UFA-ESPE "SANTO DOMINGO"</h1>
        </div>
    </div>

@stop

@section('content')

 {{-- MODAL PARA REGISTRAR UNA CONSIGNA REALIZADA --}}
 <div class=""  id="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">CONSIGNA REALIZADA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('pendings.update', $pending->id)}}" method="POST">
                @csrf
                <div class="modal-body">


                    <div id="modificarRegistro" class="row mt-3" style="">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="observations">Indíque si tuvo alguna novedad realizando la
                                    consinga:</label>
                                <textarea name="observations" id="observations" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="idPendingDone" value=>

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('pending.index')}}" type="button" class="btn btn-danger" >CANCELAR</a>
                    <button type="submit" id="btnIngreso" style="" class="btn btn-success">GUARDAR</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>


</script>
@stop

