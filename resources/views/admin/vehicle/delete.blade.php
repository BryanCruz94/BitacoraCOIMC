@extends('adminlte::page')

@section('title', 'ADMINISTRACIÓN VEHICULAR')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN VEHICULAR</h1>
        </div>
    </div>

@stop

@section('content')

 {{-- MODAL PARA ELIMINAR A UN VEHÍCULO --}}
 <div class=""  id="">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title">ELIMINAR VEHÍCULO MILITAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('vehicles.destroy', $vehicle->id)}}" method="POST">
                @csrf
                <div class="modal-body">


                    <div id="modificarRegistro" class="row mt-3" style="">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="observations">Confirmar que desea eliminar el vehículo:</label>
                                <input type="text" class="form-control" name="data"
                                value="{{$vehicle->description}} Placas: {{$vehicle->plate}}"  readonly>
                            </div>
                        </div>
                        <input type="hidden" name="id_civilian" value="{{$vehicle->id}}">

                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{route('vehicles.index')}}" type="button" class="btn btn-primary" >CANCELAR</a>
                    @if ($vehicle->in_barracks == 0)
                        <button type="submit" id="btnIngreso" style="" class="btn btn-danger" disabled>ELIMINAR</button>
                        <span class="text-danger" >No se puede eliminar un vehículo que se encuentra fuera del fuerte.</span>

                    @else
                        <button type="submit" id="btnIngreso" style="" class="btn btn-danger">ELIMINAR</button>
                    @endif

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

