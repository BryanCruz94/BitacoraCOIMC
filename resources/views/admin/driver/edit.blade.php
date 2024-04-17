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

    {{-- MODAL PARA EDITAR UN CONDUCTOR --}}
    <div class="" id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">REGISTRO NUEVO CONDUCTOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container">
                    <form id="forNewVehicle" class ="row" action="{{ route('drivers.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $driver->id }}">

                        <div class="form-group col-6">
                            <label for="names">Nombres:</label>
                            <input type="text" name="names" class="form-control" value="{{ $driver->names }}" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="last_names">Apellidos:</label>
                            <input type="text" name="last_names" class="form-control" value="{{ $driver->last_names }}"
                                required>
                        </div>

                        <div class="form-group col-6">
                            <label for="identification_card">Identificación:</label>
                            <input type="text" name="identification_card" class="form-control"
                                value="{{ $driver->identification_card }}" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" class="form-control" value="{{ $driver->phone }}" required>
                        </div>

                        @if ($roleUser == 'Admin')
                            <div class="form-group col-3">
                                <label for="rank_id">Unidad:</label>
                                <select name="military_unit_id" class="form-control" required>
                                    @foreach ($military_units as $unit)
                                        <option value="{{ $unit->id }}"
                                            @if ($unit->id == $driver->military_unit_id) selected @endif>{{ $unit->abbreviation }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-3">
                            <label for="rank_id">Rango:</label>
                            <select name="rank_id" class="form-control" required>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->code }}" @if ($rank->code == $driver->rank_id) selected @endif>
                                        {{ $rank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="blood_type">Tipo de Sangre:</label>
                            <select name="blood_type" class="form-control" value="{{ $driver->blood_type }}" required>
                                <option value="A+">A+</option>
                                <option value="A-">A-</option>
                                <option value="B+">B+</option>
                                <option value="B-">B-</option>
                                <option value="AB+">AB+</option>
                                <option value="AB-">AB-</option>
                                <option value="O+">O+</option>
                                <option value="O-">O-</option>
                            </select>
                        </div>
                        <div class="form-group col-3">
                            <label for="license_type">Tipo de Licencia:</label>
                            <select name="license_type" class="form-control" value="{{ $driver->license_type }}" required>
                                <option value="A">Tipo A - Motocicletas</option>
                                <option value="B">Tipo B - Automóviles y camionetas</option>
                                <option value="C">Tipo C - Vehículos pesados y buses</option>
                                <option value="D">Tipo D - Transporte público de pasajeros</option>
                                <option value="E">Tipo E - Remolques y semirremolques</option>
                                <option value="F">Tipo F - Maquinaria y equipo especial</option>
                            </select>
                        </div>
                        <div class="p-4 bg-white rounded shadow-sm mx-auto" style="max-width: 400px;">
                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ route('drivers.index') }}" class="btn btn-danger m-2">Regresar</a>
                                <button class="btn btn-success m-2">Editar</button>
                            </div>
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
