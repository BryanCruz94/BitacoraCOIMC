@extends('adminlte::page')

@section('title', 'ADMINISTRACIÓN VEHICULAR')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN DE USUARIO</h1>
        </div>
    </div>

@stop

@section('content')

    {{-- MODAL PARA EDITAR UN CONDUCTOR --}}
    <div class="" id="">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">EDITAR USUARIO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container">
                    <form id="forNewVehicle" class ="row" action="{{ route('users.update') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-group col-6">
                            <label for="names">Nombres:</label>
                            <input type="text" name="names" class="form-control" value="{{ $user->names }}" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="last_names">Apellidos:</label>
                            <input type="text" name="last_names" class="form-control" value="{{ $user->last_names }}"
                                required>
                        </div>

                        <div class="form-group col-6">
                            <label for="identification_card">Identificación:</label>
                            <input type="text" name="identification_card" class="form-control"
                                value="{{ $user->identification_card }}" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="email">Correo:</label>
                            <input type="mail" name="email" class="form-control" value="{{ $user->email }}" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="password">Contraseña:</label>
                            <input type="password" name="password" class="form-control">
                            {{-- Mostrar mensaje de error si las contraseñas no coinciden --}}
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group col-6">
                            <label for="password_confirmation">Confirmar Contraseña:</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>


                        <div class="form-group col-3">
                            <label for="rank_id">Unidad:</label>
                            <select name="military_unit_id" class="form-control" required>
                                @foreach ($military_units as $unit)
                                    <option value="{{ $unit->id }}" @if ($unit->id == $user->military_unit_id) selected @endif>
                                        {{ $unit->abbreviation }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="rank_id">Rango:</label>
                            <select name="rank_id" class="form-control" required>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->code }}" @if ($rank->code == $user->rank_id) selected @endif>
                                        {{ $rank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="role_id">Rol:</label>
                            <select name="role_id" class="form-control" required>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if ($role->id == $role_id->role_id) selected @endif>
                                        {{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="is_active">Estado:</label>
                            <select name="is_active" class="form-control" required>
                                <option value="1" @if ($user->is_active == 1) selected @endif>Activo</option>
                                <option value="0" @if ($user->is_active == 0) selected @endif>Inactivo</option>
                            </select>
                        </div>


                        <div class="p-4 bg-white rounded shadow-sm mx-auto" style="max-width: 400px;">
                            <div class="form-group d-flex justify-content-between">
                                <a href="{{ route('users.index') }}" class="btn btn-danger m-2">Regresar</a>
                                <button class="btn btn-success m-2">Guardar Cambios</button>
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
