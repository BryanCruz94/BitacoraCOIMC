@extends('adminlte::page')

@section('title', 'CONSIGNAS')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>CONSIGNAS F.M.E "ECUADOR"</h1>
        </div>
    </div>
    <div class="row h-100 mt-1">
        <div class="col-10 offset-1 d-flex align-items-center justify-content-center">
            <button class="btn btn-lg btn-success" mr-5" data-toggle="modal" data-target="#modalNewPendding">NUEVA
                CONSIGNA</button>
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
                            <th class="text-center">HORA</th>
                            <th class="text-center">DESCRIPCIÓN</th>
                            <th class="text-center">REMITENTE</th>
                            <th class="text-center">REALIZADA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $ord = 0; ?>
                        @foreach ($penddings as $item)
                            <tr>
                                <td class="text-center">
                                    {{ ++$ord }}
                                </td>
                                <td class="text-center">
                                    {{ $item->hour_create }}
                                </td>
                                <td style="max-width: 800px; min-width: 200px;
                            ">
                                    {{ $item->pending_task }}
                                </td>
                                <td class="text-center">
                                    {{ $item->guardCreate }}
                                </td>
                                <td class="text-center">

                                    <form action="{{route ('pendings.editDone', $item->id)}}" method="POST">
                                        @csrf
                                        <input type="submit" class="btn btn-danger" data-toggle="modal"
                                         data-target="#modalPenddingDone" value= "REALIZADA"></input>

                                    </form>


                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>

        </div>

        {{-- TABLA CONSIGNAS REALIZADAS --}}
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


    </div>

    {{-- MODAL PARA REGISTRAR UNA NUEVA CONSIGNA --}}
    <div class="modal" tabindex="-1" id="modalNewPendding">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-success">
                    <h5 class="modal-title">NUEVA CONSIGNA</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('pending.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div id="modificarRegistro" class="row mt-3" style="">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="newPendding">Detalle la consigna:</label>
                                    <textarea name="newPendding" id="newPendding" class="form-control" rows="3" required></textarea>
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
