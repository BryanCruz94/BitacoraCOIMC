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

    {{-- MODAL PARA EDITAR UN VEHÍCULO --}}
    <div class="" id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title">Editar Vehículo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forEditVehicle" action="{{ route('vehicles.update') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div id="vehOutForm" class="row mt-3" style="">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="plate">Placa: </label>
                                    <input type="text" name="plate" id="plate" class="form-control"
                                        value="{{ $vehicle->plate }}" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="description">Descripción: </label>
                                    <input type="text" name="description" id="description" class="form-control"
                                        value="{{ $vehicle->description }}" required>

                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="lugar">Dentro del Fuerte: </label>
                                    @if ($vehicle->in_barracks == 0)
                                        <input type="checkbox" name="in_barracks" id="in_barracks" class="form-control">
                                    @else
                                        <input type="checkbox" name="in_barracks" id="in_barracks" class="form-control"
                                            checked>
                                    @endif

                                </div>
                            </div>

                            @if ($roleUser == 'Admin')
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="military_unit_id">Unidad Militar: </label>
                                        <select name="military_unit_id" id="military_unit_id" class="form-control">
                                            @foreach ($military_units as $military_unit)
                                                <option value="{{ $military_unit->id }}"
                                                    @if ($vehicle->military_unit_id == $military_unit->id) selected @endif>
                                                    {{ $military_unit->abbreviation }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            {{-- YA NO SE GUARDARÁ IMÁGENES --}}
                            {{-- <div class="col-4">
                                <div class="form-group">
                                    <label for="image">Imagen: </label>
                                    <input type="file" name="image" id="image" class="form-control">
                                </div>
                            </div> --}}

                            <input type="hidden" name="id" value="{{ $vehicle->id }}">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" href="{{ route('vehicles.index') }}" class="btn btn-danger"
                            data-dismiss="modal">CANCELAR</a>
                        <button type="submit" id="btnIngreso" class="btn btn-success">ACTUALIZAR</button>
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
