@extends('adminlte::page')

@section('title', 'ADMINISTRACIÓN UNIDADES')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>UNIDADES MILITARES</h1>
        </div>
    </div>

@stop

@section('content')

    {{-- MODAL PARA EDITAR UNA UNIDAD --}}
    <div class="" id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDITAR UNIDAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forNewVehicle" action="{{ route('military_units.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <input type="hidden" name="id" id="id" value="{{$unit->id}}">
                        <div id="vehOutForm" class="row mt-3" style="">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="plate">Nombre de la Unidad: </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        value="{{$unit->name}}" required>

                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="description">Abreviación: </label>
                                    <input type="text" name="abbreviation" id="abbreviation" class="form-control"
                                    value="{{$unit->abbreviation}}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="commander">Nombre del Comandante: </label>
                                    <input type="text" name="commander" id="commander" class="form-control"
                                    value="{{$unit->commander}}" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Dirección: </label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        value="{{$unit->address}}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group
                                    ">
                                    <label for="is_active">Activo: </label>
                                    @if ($unit->is_active == 0)
                                        <input type="checkbox" name="is_active" id="is_active" class="form-control">
                                    @else
                                        <input type="checkbox" name="is_active" id="is_active" class="form-control" checked>
                                    @endif
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="{{ route('military_units.index') }}" class="btn btn-danger m-2">Regresar</a>
                        <button type="submit" id="btnIngreso" class="btn btn-success">GUARDAR</button>
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
    <script></script>
@stop
