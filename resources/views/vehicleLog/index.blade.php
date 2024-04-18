@extends('adminlte::page')

@section('title', 'MOVIMIENTO VEHICULAR')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>BITÁCORA DE MOVIMIENTO VEHICULAR F.M "ECUADOR"</h1>
        </div>
    </div>
    <div class="row h-100 mt-1 justify-content-center align-items-center pr-5 mr-2">
        <div class="col-4 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-danger" mr-5" data-toggle="modal" data-target="#modalVehOut">REGISTRAR
                SALIDA</button>
        </div>
        <div class="col-4 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-success" mr-5" data-toggle="modal" data-target="#modalVehIn">REGISTRAR
                INGRESO</button>
        </div>
    </div>

@stop

@section('content')
    {{-- ESPACIO DE BOTÓN PARA REGISTRAR NOVEDADES --}}

    <div class="row">

        <div class="col ">
            {{-- TABLA SUPERIOR --}}
            <div class="card">
                <div class="card-header text-center" style="padding:0; padding-top:3px">
                    <div>
                        <h3 class="text-lg">MOVIMIENTO</h3>
                    </div>
                    <div class="card-tools" style=" ">
                    </div>
                </div>
                <div class="card-body table-responsive pl-2 pr-2">
                    <table id="movVehiclesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center text-sm">ORD</th>
                                <th class="text-center text-sm">UNIDAD</th>
                                <th class="text-center text-sm">PLACA</th>
                                <th class="text-center text-sm">DESCRIPCIÓN</th>
                                <th class="text-center text-sm">CONDUCTOR</th>
                                <th class="text-center text-sm">HORA SALIDA</th>
                                <th class="text-center text-sm">HORA ENTRADA</th>
                                <th class="text-center text-sm">DESTINO</th>
                                <th class="text-center text-sm">MISIÓN</th>
                                <th class="text-center text-sm">OBSERVACIÓN</th>
                                <th class="text-center text-sm">KM RECORRIDO</th>
                                <th class="text-center text-sm">GUARDIA SALIDA</th>
                                <th class="text-center text-sm">GUARDIA ENTRADA</th>

                            </tr>
                        </thead>

                        <div style="display: none"> {{ $i = 1 }} </div>

                        <tbody>
                            @foreach ($vehicleLogs as $item)
                                <tr>
                                    <td class="text-xs text-center align-middle">
                                        {{ $i++ }}
                                    </td>
                                    <td class="text-xs text-center align-middle">
                                        {{ $item->abbreviation }}
                                    </td>
                                    <td class="text-xs text-center align-middle">
                                        {{ $item->plate }}
                                    </td>
                                    <td class="text-xs text-center align-middle">
                                        {{ $item->description }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->driver }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->departure_time }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->entry_time }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->destination }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->mission }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->observation }}
                                    </td>
                                    <td class="text-xs text-center align-middle">
                                        {{ $item->totalKm }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->guardOut }}
                                    </td>
                                    <td class="text-xs text-center align-middle text-wrap">
                                        {{ $item->guardIn }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>

            {{-- TABLA INFERIOR --}}
            <div class="card">

                <div class="card-header text-center" style="padding:0; padding-top:3px">
                    <div>
                        <h4 class="text-lg">VEHÍCULOS FUERA DEL FUERTE</h4>
                    </div>
                    <div class="card-tools" style=" ">
                    </div>
                </div>

                <div class="card-body table-responsive p-0">
                    <table id="vehiclesOutTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class='text-center text-sm'>ORD</th>
                                <th class='text-center text-sm'>UNIDAD</th>
                                <th class='text-center text-sm'>PLACA</th>
                                <th class='text-center text-sm'>DESCRIPCIÓN</th>
                                <th class='text-center text-sm'>CONDUCTOR</th>
                                <th class='text-center text-sm'>SALIDA</th>
                                <th class='text-center text-sm'>DESTINO</th>
                                <th class='text-center text-sm'>MISIÓN</th>
                                <th class='text-center text-sm'>GUARDIA SALIDA</th>

                            </tr>
                        </thead>
                        <tbody>
                            <div style="display: none"> {{ $j = 1 }} </div>
                            @foreach ($vehiclesToOut as $vehicle)
                                <tr>
                                    <td class="text-center text-sm align-middle">
                                        {{ $j++ }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->abbreviation }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->plate }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->description }}
                                    </td>
                                    <td class="text-center text-sm align-middle text-wrap">
                                        {{ $vehicle->driver }}
                                    </td>
                                    <td class="text-center text-sm align-middle text-wrap">
                                        {{ $vehicle->departure_time }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->destination }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->mission }}
                                    </td>
                                    <td class="text-center text-sm align-middle">
                                        {{ $vehicle->guardOut }}
                                    </td>
                            @endforeach

                        </tbody>
                    </table>

                </div>

            </div>



        </div>
    </div>

    {{-- MODAL PARA REGISTRAR SALIDA VEHICULAR --}}
    <div class="modal" tabindex="-1" id="modalVehOut">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">REGISTRO SALIDA VEHICULAR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <table id="vehiclesOutTable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class='text-center text-sm'>ORD</th>
                            <th class='text-center text-sm'>UNIDAD</th>
                            <th class='text-center text-sm'>VEHÍCULO</th>
                            <th class='text-center text-sm'>CONDUCTOR</th>
                            <th class='text-center text-sm'>DESTINO</th>
                            <th class='text-center text-sm'>MISIÓN</th>
                            <th class='text-center text-sm'>AUTORIZADO POR</th>
                            <th class='text-center text-sm'>ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        <div style="display: none"> {{ $j = 1 }} </div>
                        @foreach ($passes as $pass)
                            <tr>
                                <td class="text-center text-sm align-middle">
                                    {{ $j++ }}
                                </td>
                                <td class="text-center text-sm align-middle">
                                    {{ $pass->unit }}
                                </td>
                                <td class="text-center text-sm align-middle text-wrap">
                                    {{ $pass->vehicle }}
                                </td>
                                <td class="text-center text-sm align-middle text-wrap">
                                    {{ $pass->driver }}
                                </td>
                                <td class="text-center text-sm align-middle">
                                    {{ $pass->destination }}
                                </td>
                                <td class="text-center text-sm align-middle text-wrap">
                                    {{ $pass->mission }}
                                </td>
                                <td class="text-center text-sm align-middle">
                                    {{ $pass->userAuth }}
                                </td>
                                <td class="text-center text-sm align-middle">
                                    <form action="{{ route('vehicleLog.create', $pass->id) }}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger text-xs text-wrap p-0 m-0"
                                            value= "Registrar Salida"></input>
                                    </form>
                                </td>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- MODAL PARA REGISTRAR INGRESO VEHICULAR --}}
    <div class="modal" tabindex="-1" id="modalVehIn">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">REGISTRO INGRESO VEHICULAR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{route('vehicleLog.update')}}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div id="vehOutForm" class="row mt-3" style="">
                            <div class="col-6">
                                <div class="form-group row">
                                    <label for="plateIn" class="col-12">Placa: </label>
                                    <input type="text" name="plateIn" id="plateIn" class="col-6 form-control">
                                    <button id="btnBuscar" class="col-5 ml-1 btn btn-primary ">Buscar</button>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="vehicle">Vehículo: </label>
                                    <input type="text" name="vehicle" id="vehicle" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="unit">Unidad: </label>
                                    <input type="text" name="unit" id="unit" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="destination">Destino: </label>
                                    <input type="text" name="destination" id="destination" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-4">
                                <div class="form-group">
                                    <label for="mission">Misión: </label>
                                    <input type="text" name="mission" id="mission" class="form-control"
                                        readonly>
                                </div>
                            </div>

                            <div class="col-12">
                                <div id="errorContainer" class="form-group text-danger">

                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="departure_km">KM Salida: </label>
                                    <input type="number" name="departure_km" id="departure_km" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="form-group">
                                    <label for="entry_km">KM Ingreso: </label>
                                    <input type="number" name="entry_km" id="entry_km" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="observation">Observaciones:</label>
                                    <textarea name="observation" id="observation" class="form-control" rows="3" required></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" name="id_vehicle_log" id="id_vehicle_log" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
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
        $("#movVehiclesTable").dataTable({
            "paging": true,
            "ordering": false,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },
            "searching": true
        });

        $(document).ready(function() {


            $('#btnBuscar').click(function() {
                var selectedPlateId = $('#plateIn').val();
                selectedPlateId = selectedPlateId.toUpperCase().trim();
                console.log("la placa es" + selectedPlateId);
                $.ajax({
                    type: 'GET',
                    url: '/obtener-datos-vehiculo/' + selectedPlateId,
                    success: function(response) {
                        console.log(response);
                        $('#unit').val(response.unit);
                        $('#vehicle').val(response.description);
                        $('#destination').val(response.destination);
                        $('#mission').val(response.mission);
                        $('#id_vehicle_log').val(response.id);
                        $('#departure_km').val(response.departure_km);
                        $('#errorContainer').empty(); // Limpiar mensajes de error

                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        $('#unit').val('');
                        $('#vehicle').val('');
                        $('#destination').val('');
                        $('#mission').val('');
                        $('#id_vehicle_log').val('');
                        $('#departure_km').val('');
                        $('#errorContainer').html('<p>Error: No se encontró el vehículo con la placa especificada.</p>');
                    }
                });
            });



        });
    </script>
@stop
