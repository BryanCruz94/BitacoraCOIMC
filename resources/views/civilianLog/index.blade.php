@extends('adminlte::page')

@section('title', 'MOVIMIENTO CIVIL')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h3>REGISTRO DE MOVIMIENTO DE PERSONAL CIVIL DEL F.M.E "ECUADOR"</h3>
        </div>
    </div>
    <div class="row h-100 mt-1">
        <div class="col-10 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-success" mr-5" data-toggle="modal" data-target="#modalNewPendding">NUEVO
                INGRESO DE PERSONAL</button>
        </div>
    </div>

@stop

@section('content')

    <div class="row justify-content-center">

        {{-- TABLA SUPERIOR --}}
        <div class="card col-12">

            <div class="card-body table-responsive pl-2 pr-2">
                <table id="pendingsTable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-sm text-center align-middle">ORD</th>
                            <th class="text-sm text-center text-wrap ">APELLIDOS Y NOMBRES</th>
                            <th class="text-sm text-center align-middle">CÉDULA</th>
                            <th class="text-sm text-center align-middle">HORA DE INGRESO</th>
                            <th class="text-sm text-center align-middle">ACTIVIDAD</th>
                            <th class="text-sm text-center align-middle">TRANSPORTE</th>
                            <th class="text-sm text-center text-wrap">GUARDIA DE INGRESO</th>
                            <th class="text-sm text-center align-middle">SALIDA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($civilianLogs as $item)
                            <tr class="align-middle">
                                <td class="text-sm text-center align-middle">
                                    {{ ++$ord }}
                                </td>
                                <td class="text-sm align-middle">
                                    {{ $item->civilian }}
                                </td>
                                <td class="text-sm text-center align-middle">
                                    {{ $item->identification_card }}
                                </td>
                                <td class="text-sm text-center align-middle">
                                    {{ $item->hour_in }}
                                </td>
                                <td class="text-sm align-middle">
                                    {{ $item->activity }}
                                </td>
                                <td class="text-sm text-center align-middle">
                                    {{ $item->transport }}
                                </td>
                                <td class="text-sm align-middle">
                                    {{ $item->user }}
                                </td>
                                <td class="text-center align-middle">

                                    <form action="{{route ('civilians.edit', $item->id)}}" method="POST">
                                        @csrf
                                        <input type="submit" class="text-xs text-wrap btn btn-danger" data-toggle="modal"
                                         data-target="#modalPenddingDone" value= "Registrar Salida"></input>

                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        {{-- TABLA CONSOLIDADO --}}
        <div class="card col-12">
            <div class="card-header text-center" style="padding:0; padding-top:3px">
                <div>
                    <h4>CONSOLIDADO MOVIMIENTO DE PERSONAL CIVIL</h4>
                </div>
                <div class="card-tools" style=" ">
                </div>
            </div>
            <div class="card-body table-responsive pl-2 pr-2">
                <table id="donePendingsTable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-sm text-center align-middle text-wrap">ORD</th>
                            <th class="text-sm text-center text-wrap" style="">APELLLIDOS Y NOMBRES</th>
                            <th class="text-sm text-center align-middle text-wrap" style="">CÉDULA</th>
                            <th class="text-sm text-center text-wrap align-middle" style="">HORA INGRESO</th>
                            <th class="text-sm text-center text-wrap align-middle" style="">HORA SALIDA</th>
                            <th class="text-sm text-center text-wrap align-middle" style="">ACTIVIDAD</th>
                            <th class="text-sm text-center text-wrap align-middle" style="">TRANSPORTE</th>
                            <th class="text-sm text-center text-wrap " style="">RESPONSABLE INGRESO</th>
                            <th class="text-sm text-center text-wrap" style="">RESPONSABLE SALIDA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($civiliansOut as $item2)
                            <tr>
                                <td class="text-sm align-middle text-wrap" >
                                    {{ ++$ord }}
                                </td>
                                <td class="text-sm text-wrap align-middle">
                                    {{ $item2->civilian }}
                                </td>
                                <td class="text-sm text-center text-wrap align-middle">
                                    {{ $item2->identification_card }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle text-center" style="min-width: 100px; max-width:300px">
                                    {{ $item2->hour_in }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle text-center" style="min-width: 100px; max-width:300px">
                                    {{ $item2->hour_out }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle" style="min-width: 100px; max-width:300px">
                                    {{ $item2->activity }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle" style="min-width: 100px; max-width:300px">
                                    {{ $item2->transport }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle text-center" style="min-width: 100px; max-width:300px">
                                    {{ $item2->user_in }}
                                </td>
                                <td class="text-sm align-middle text-wrap align-middle text-center" style="min-width: 100px; max-width:300px">
                                    {{ $item2->user_out }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>



    </div>

    {{-- MODAL PARA REGISTRAR UN NUEVO INGRESO DE CIVIL --}}
    <div class="modal" tabindex="-1" id="modalNewPendding">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">Registre Ingreso de Personal Civil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('civilians.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div id="modificarRegistro" class="row mt-3" style="">
                            <div class="col-lg-6 col-sm-12 ">
                                <div class="form-group">
                                    <label for="names">Nombres:</label>
                                    <input type="text" class="form-control" name="names" id="names" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="last_names">Apellidos:</label>
                                    <input type="text" class="form-control" name="last_names" id="last_names" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="identification_card">Cédula de Identidad:</label>
                                    <input type="number" class="form-control" name="identification_card"
                                    id="identification_card" maxlength="10" minlength="10" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="activity">Actividad:</label>
                                    <input type="text" class="form-control" name="activity" id="activity" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="transport">Transporte:</label>
                                    <input type="text" class="form-control" name="transport" id="transport" required>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">CANCELAR</button>
                        <button type="submit" id="btnIngreso" style="" class="btn btn-success">GUARDAR</button>
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
