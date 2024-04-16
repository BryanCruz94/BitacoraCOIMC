@extends('adminlte::page')

@section('title', 'ADMINISTRACIÓN VEHICULAR')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN DE CONDUCTORES</h1>
        </div>
    </div>

@stop

@section('content')

    {{-- MODAL PARA ELIMINAR A UN VEHÍCULO --}}
    <div class="" id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">ELIMINAR CONDUCTOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('drivers.destroy', $driver->id) }}" method="POST">
                    @csrf
                    <div class="modal-body">


                        <div id="modificarRegistro" class="row mt-3" style="">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observations">Confirmar que desea eliminar el conductor:</label>
                                    <input type="text" class="form-control" name="data"
                                        value="{{ $driver->ranks }} {{ $driver->last_names }} {{ $driver->names }}"
                                        readonly>
                                </div>
                            </div>
                            <input type="hidden" name="id_civilian" value="{{ $driver->id }}">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('drivers.index') }}" type="button" class="btn btn-primary">CANCELAR</a>

                        <button type="submit" id="btnIngreso" style="" class="btn btn-danger">ELIMINAR</button>

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
