@extends('adminlte::page')

@section('title', 'MOVIMIENTO CIVIL')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>REGISTRO DE MOVIMIENTO DE PERSONAL CIVIL DEL F.M.E "ECUADOR"</h1>
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
        <div class="card col-11">

            <div class="card-body table-responsive pl-2 pr-2">
                <table id="pendingsTable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="text-center">ORD</th>
                            <th class="text-center">APELLIDOS Y NOMBRES</th>
                            <th class="text-center">HORA DE INGRESO</th>
                            <th class="text-center">ACTIVIDAD</th>
                            <th class="text-center">TRANSPORTE</th>
                            <th class="text-center">GUARDIA DE INGRESO</th>
                            <th class="text-center">SALIDA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($civilianLogs as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ++$ord }}
                                </td>
                                <td class="text-center">
                                    {{ $item->civilian }}
                                </td>
                                <td style="max-width: 800px; min-width: 200px;
                            ">
                                    {{ $item->hour_in }}
                                </td>
                                <td class="text-center">
                                    {{ $item->activity }}
                                </td>
                                <td class="text-center">
                                    {{ $item->transport }}
                                </td>
                                <td class="text-center">
                                    {{ $item->user }}
                                </td>
                                <td class="text-center">

                                    <form action="{{route ('pendings.editDone', $item->id)}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" data-toggle="modal"
                                         data-target="#modalPenddingDone" value= "Registrar Salida"></input>

                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        {{-- TABLA CONSIGNAS REALIZADAS
        <div class="card col-12">
            <div class="card-header text-center" style="padding:0; padding-top:3px">
                <div>
                    <h3>CONSIGNAS REALIZADAS</h3>
                </div>
                <div class="card-tools" style=" ">
                </div>
            </div>
            <div class="card-body table-responsive pl-2 pr-2">
                <table id="donePendingsTable" class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th class="align-middle text-wrap">ORD</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">DESCRIPCIÓN</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">HORA ASIGNACIÓN</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">HORA REALIZADO</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">REMITENTE</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">REALIZADO POR</th>
                            <th class="align-middle text-wrap" style="min-width: 100px; max-width:300px">NOVEDADES</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($penddingsDone as $item2)
                            <tr>
                                <td class="align-middle text-wrap" >
                                    {{ ++$ord }}
                                </td>
                                <td>
                                    {{ $item2->pending_task }}
                                </td>
                                <td class="align-middle text-wrap" style="min-width: 100px; max-width:300px">
                                    {{ $item2->hour_create }}
                                </td>
                                <td class="align-middle text-wrap" style="min-width: 100px; max-width:300px">
                                    {{ $item2->hour_done }}
                                </td>
                                <td class="align-middle text-wrap" style="min-width: 100px; max-width:300px">
                                    {{ $item2->guardCreate }}
                                </td>
                                <td class="align-middle text-wrap" style="min-width: 100px; max-width:300px">
                                    {{ $item2->guardDone }}
                                </td>
                                <td class="align-middle text-wrap" style="min-width: 100px; max-width:300px">
                                    {{ $item2->observations }}
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>

            </div>

        </div>
        --}}


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
                            <div class="col-6">
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
