@extends('adminlte::page')

@section('title', 'CONSIGNAS')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>SALVOCONDUCTOS</h1>
        </div>
    </div>
    @can('pass.create')
        <div class="row h-100 mt-1">
            <div class="col-10 offset-1 d-flex align-items-center justify-content-center">
                <button class="btn btn-lg btn-success" mr-5" data-toggle="modal" data-target="#modalSalvoconducto">REALIZAR
                    SALVOCONDUCTO</button>
            </div>
        </div>
    @endcan


@stop

@section('content')

    <div class="row justify-content-center">

        {{-- TABLA SUPERIOR --}}
        <div class="card col-11">

            <div class="card-body table-responsive pl-2 pr-2">
                <table id="passes" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">ORD</th>
                            <th class="text-center">VEHÍCULO</th>
                            <th class="text-center">CONDUCTOR</th>
                            <th class="text-center">DESTINO</th>
                            <th class="text-center">MISIÓN</th>
                            <th class="text-center">FECHA</th>
                            <th class="text-center">GENERADOR</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">AUTORIZA</th>
                            <th class="text-center">ACCIONES</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($passes as $item)
                            <tr>
                                <td class="text-sm text-center align-middle">
                                    {{ ++$ord }}
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item->vehicle }}
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item->driver }}
                                </td>
                                <td class="text-sm text-center text-wrap align-middle">
                                    {{ $item->destination }}
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item->mission }}
                                </td>
                                <td class="text-sm text-wrap align-middle" style="min-width: 80px">
                                    {{ $item->created_at }}
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item->userLog }}
                                </td>
                                <td class="align-middle">
                                    @if ($item->authorized_commander == 1 && $item->ejecuted == 0)
                                        <span class="badge badge-success">Autorizado</span>
                                    @elseif ($item->authorized_commander == 0)
                                        <span class="badge badge-warning">Pendiente</span>
                                    @elseif ($item->authorized_commander == 1 && $item->ejecuted == 1)
                                        <span class="badge badge-primary">Ejecutado</span>
                                    @endif
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item->userAuth }}
                                </td>

                                <td class="text-xs text-center align-middle">
                                    @if ($item->authorized_commander == 0)
                                        <form action="{{ route('passes.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-danger text-xs" value= "ELIMINAR"></input>
                                        </form>
                                    @elseif($roleUser == 'Commander' && $item->ejecuted == 0)
                                        <form action="{{ route('passes.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            <input type="submit" class="btn btn-danger text-xs" value= "ELIMINAR"></input>
                                        </form>
                                    @elseif ($item->ejecuted == 1)
                                        <form action="{{ route('reports.pass', $item->id) }}" method="POST"
                                            class="mt-1">
                                            @csrf
                                            <input type="submit" class="btn btn-info text-xs" value= "PDF"></input>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary text-xs" disabled>ELIMINAR</button>
                                        <button class="btn btn-secondary text-xs" disabled>PDF</button>
                                    @endif

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>
    </div>

    {{-- MODAL PARA REGISTRAR NUEVO SALVOCONDUCTO --}}
    <div class="modal" tabindex="-1" id="modalSalvoconducto">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">GENERAR SALVOCONDUCTO</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="forNewVehicle" action="{{ route('passes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">

                        <div id="vehOutForm" class="row mt-3" style="">
                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="destination">Destino: </label>
                                    <input type="text" name="destination" id="destination" class="form-control"
                                        placeholder="Quito" required>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="mission">Misión: </label>
                                    <input type="text" name="mission" id="mission" class="form-control"
                                        placeholder="Entregar Documentación" required>

                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="military_unit_id">Vehículo: </label>
                                    <select name="vehicle_id" id="vehicle_id" class="form-control">
                                        @foreach ($vehicles as $vehicle)
                                            <option value="{{ $vehicle->id }}">{{ $vehicle->plate }} -
                                                {{ $vehicle->description }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <label for="military_unit_id">Conductor: </label>
                                    <select name="driver_id" id="driver_id" class="form-control">
                                        @foreach ($drivers as $driver)
                                            <option value="{{ $driver->id }}">{{ $driver->names }}
                                            </option>
                                        @endforeach
                                    </select>
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

    @include('layouts.footer')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        passes
        $(document).ready(function() {
            $('#passes').DataTable({
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
