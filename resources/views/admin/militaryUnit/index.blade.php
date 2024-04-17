@extends('adminlte::page')

@section('title', 'ADMINISTRADOR')


@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN DE UNIDADES MILITARES</h1>
        </div>
    </div>
    <div class="row h-100 mt-1 justify-content-center align-items-center pr-5 mr-2">
        <div class="col-4 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-success mr-5" data-toggle="modal" data-target="#modalVehIn">
                NUEVA UNIDAD MILITAR</button>
        </div>
    </div>

@stop

@section('content')

    <div class="row">

        <div class="col ">
            <div class="card">

                <div class="card-header text-center" style="padding:0; padding-top:3px">
                    <div>
                        <h3>UNIDADES DENTRO DEL FUERTE</h3>
                    </div>

                </div>

                <div class="card-body table-responsive pl-2 pr-2">
                    <table id="movVehiclesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">ORD</th>
                                <th class="text-center">NOMBRE</th>
                                <th class="text-center">ABREVIATURA</th>
                                <th class="text-center">DIRECCIÓN</th>
                                <th class="text-center">NOMBRE COMANDANTE</th>
                                <th class="text-center">ESTADO</th>
                                <th class="text-center">ACCIONES</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($militaryUnits as $i => $dato)
                                <tr>
                                    <td class="text-center align-middle">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->name }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->abbreviation }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->address }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->commander }}
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($dato->is_active == 1)
                                            <span class="badge badge-success">ACTIVO</span>
                                        @else
                                            <span class="badge badge-danger">INACTIVO</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        <form action="{{ route('military_units.edit', $dato->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    {{-- MODAL PARA REGISTRAR INGRESO DE NUEVA UNIDAD MILITAR --}}
    <div class="modal" tabindex="-1" id="modalVehIn">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVA UNIDAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forNewVehicle" action="{{ route('military_units.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div id="vehOutForm" class="row mt-3" style="">
                            <div class="col-5">
                                <div class="form-group">
                                    <label for="plate">Nombre de la Unidad: </label>
                                    <input type="text" name="name" id="name" class="form-control"
                                        placeholder="Comando de Inteligencia Conjunta" required>

                                </div>
                            </div>

                            <div class="col-3">
                                <div class="form-group">
                                    <label for="description">Abreviación: </label>
                                    <input type="text" name="abbreviation" id="abbreviation" class="form-control"
                                        placeholder="COIMC" required>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="commander">Nombre del Comandante: </label>
                                    <input type="text" name="commander" id="commander" class="form-control"
                                        placeholder="Tcrn de E.M Iturralde Miguel" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="address">Dirección: </label>
                                    <input type="text" name="address" id="address" class="form-control"
                                        placeholder="'Av Huancavilca y Chillo Jijón'" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
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
    <script>
        $("#movVehiclesTable").dataTable({
            "paging": true,
            "ordering": false,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },
            "searching": true
        });
    </script>
@stop
