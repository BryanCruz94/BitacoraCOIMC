@extends('adminlte::page')

@section('title', 'CONSIGNAS')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>CONFIRMAR SALIDA VEHICULAR</h1>
        </div>
    </div>

@stop

@section('content')

 {{-- MODAL PARA REGISTRAR UNA SALIDA VEHICULAR --}}
 <div class=""  id="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">SALIDA VEHICULAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('vehicleLog.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div id="modificarRegistro" class="row mt-3" style="">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="departure_km">Por favor indique el kilometraje de salida:</label>
                                <input type="number" name="departure_km" id="departure_km" class="form-control" required>

                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="pass_id" value="{{$pass->id}}">
                </div>
                <div class="modal-footer">
                    <a href="{{route('vehicleLog.index')}}" type="button" class="btn btn-danger" >CANCELAR</a>
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

