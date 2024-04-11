@extends('adminlte::page')

@section('title', 'CONSIGNAS')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>REGISTRO DE MOVIMIENTO DE PERSONAL CIVIL DEL F.M "ECUADOR"</h1>
        </div>
    </div>

@stop

@section('content')

 {{-- MODAL PARA REGISTRAR UN MOMIVIENTO DE PERSONAL CIVIL --}}
 <div class=""  id="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">REGISTRAR SALIDA PERSONAL CIVIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('civilians.update', $civilian->id)}}" method="POST">
                @csrf
                <div class="modal-body">


                    <div id="modificarRegistro" class="row mt-3" style="">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="observations">Confirmar salida del Sr/Sra:</label>
                                <input type="text" class="form-control" name="data"
                                value="{{$civilian->last_names}} {{$civilian->names}}"  readonly>
                            </div>
                        </div>
                        <input type="hidden" name="id_civilian" value="{{$civilian->id}}">

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('civilians.index')}}" type="button" class="btn btn-danger" >CANCELAR</a>
                    <button type="submit" id="btnIngreso" style="" class="btn btn-success">CONFIRMAR</button>
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



    donePendingsTable
    $(document).ready(function() {
        $('#donePendingsTable').DataTable({
            "paging": true,
            "ordering": false,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },
            "searching": true
        });

    });
</script>
@stop

