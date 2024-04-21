@extends('adminlte::page')

@section('title', 'ADMINISTRADOR')


@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN DE CONDUCTORES</h1>
        </div>
    </div>
    <div class="row h-100 mt-1 justify-content-center align-items-center pr-5 mr-2">
        <div class="col-4 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-success mr-5" data-toggle="modal" data-target="#modalVehIn">
                REGISTRAR NUEVO CONDUCTOR</button>
        </div>
    </div>

@stop

@section('content')

    <div class="row">

        <div class="col ">
            <div class="card">

                <div class="card-header text-center" style="padding:0; padding-top:3px">
                    <div>
                        <h3>CONDUCTORES REGISTRADOS</h3>
                    </div>

                </div>

                <div class="card-body table-responsive pl-2 pr-2">
                    <table id="movVehiclesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">ORD</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">GRADO</th>
                                <th class="text-center">APELLIDOS Y NOMBRES</th>
                                <th class="text-center">CÉDULA</th>
                                <th class="text-center">TELÉFONO</th>
                                <th class="text-center">TIPO SANGRE</th>
                                <th class="text-center">TIPO LICENCIA</th>
                                <th class="text-center">EDITAR</th>
                                <th class="text-center">ELIMINAR</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($drivers as $i => $dato)
                                <tr>
                                    <td class="text-center align-middle">
                                        {{ $i + 1 }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->unit }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->ranks }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->driver }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->identification_card }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->phone }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->blood_type }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->license_type }}
                                    </td>


                                    <td class="text-center align-middle">
                                        <form action="{{ route('drivers.edit', $dato->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-secondary btn-sm" data-toggle="modal">
                                                <span class="fas fa-user-edit"></span>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="text-center align-middle">
                                        <form action="{{ route('drivers.delete', $dato->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <span class="fas fa-user-times"></span>
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


    {{-- MODAL PARA REGISTRAR INGRESO DE NUEVO VEHÍCULO --}}
    <div class="modal" tabindex="-1" id="modalVehIn">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">REGISTRO NUEVO CONDUCTOR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="container">
                    <form id="forNewVehicle" class ="row" action="{{ route('drivers.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="form-group col-6">
                            <label for="names">Nombres:</label>
                            <input type="text" name="names" class="form-control" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="last_names">Apellidos:</label>
                            <input type="text" name="last_names" class="form-control" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="identification_card">Identificación:</label>
                            <input type="text" name="identification_card" class="form-control" minlength="10"
                                maxlength="10" required>
                        </div>

                        <div class="form-group col-6">
                            <label for="phone">Teléfono:</label>
                            <input type="text" name="phone" class="form-control" minlength="10" maxlength="10"
                                required>
                        </div>

                        @if ($roleUser == 'Admin')
                            <div class="form-group col-3">
                                <label for="rank_id">Unidad:</label>
                                <select name="military_unit_id" class="form-control" required>
                                    @foreach ($military_units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->abbreviation }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <div class="form-group col-3">
                            <label for="rank_id">Rango:</label>
                            <select name="rank_id" class="form-control" required>
                                @foreach ($ranks as $rank)
                                    <option value="{{ $rank->code }}">{{ $rank->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-3">
                            <label for="blood_type">Tipo de Sangre:</label>
                            <select name="blood_type" class="form-control" required>
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
                            <select name="license_type" class="form-control" required>
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
                                <button class="btn btn-success m-2">Agregar</button>
                            </div>
                        </div>
                    </form>
                </div>
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
