@extends('adminlte::page')

@section('title', 'BITÁCORA')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>BITÁCORA NOVEDADES F.M.E "ECUADOR"</h1>
        </div>
    </div>
    @can('guard.index')
        <div class="row h-100 mt-1">
            <div class="col-10 offset-1 d-flex align-items-center justify-content-center">
                <button class="btn btn-lg btn-success" mr-5" data-toggle="modal" data-target="#modalRegistro">REGISTRAR
                    NOVEDAD</button>
            </div>
        </div>
    @endcan

@stop


@section('content')

    <div class="row">

        <div class="col ">
            {{-- TABLA SUPERIOR --}}
            <div class="card">

                <div class="card-header ">

                    <div class="card-tools">
                    </div>
                </div>

                <div class="card-body table-responsive pl-2 pr-2">
                    <table id="binnacleTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center align-middle">ORD</th>
                                <th class="text-center align-middle" colspan="2">NOVEDADES</th>
                                <th class="text-center align-middle">FECHA/HORA</th>
                                <th class="text-center align-middle text-wrap">GUARDIA TURNO</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $ord = 0; ?>
                            @foreach ($novelties as $item)
                                <tr>
                                    <td class="align-middle text-center text-sm">
                                        {{ ++$ord }}
                                    </td>
                                    <td class="text-wrap text-sm" style="min-width: 100px; max-width: 300px;">
                                        {{ $item->novelty }}
                                    </td>
                                    <td class="align-middle" style="min-width: 10px; max-width: 30px;">
                                        <div class="btnCopiar">
                                            <button style="border: none; background: transparent;">
                                                <i class="fa-solid fa-copy fa-lg" style="color: #3b9834;"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <td class="align-middle text-wrap text-center text-sm">
                                        {{ $item->hour }}
                                    </td>
                                    <td class="align-middle text-wrap text-center text-sm"
                                        style="min-width: 50px; max-width: 300px;">
                                        {{ $item->Guard }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </div>

    {{-- MODAL PARA REGISTRAR UNA NUEVA NOVEDAD --}}
    <div class="modal" tabindex="-1" id="modalRegistro">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">NUEVA NOVEDAD</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('novelty.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">

                        <div id="modificarRegistro" class="row mt-3" style="">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="novelty">Detalle la novedad: </label>
                                    <textarea name="novelty" id="novelty" class="form-control" rows="3" required></textarea>
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
        binnacleTable
        $("#binnacleTable").dataTable({
            "paging": true,
            "ordering": false,
            "language": {
                url: 'https://cdn.datatables.net/plug-ins/1.11.3/i18n/es_es.json'
            },
            "searching": true
        });

        $(document).ready(function() {
            $('.btnCopiar').on('click', function() {
                // Encuentra la celda a la izquierda del botón clickeado
                var celda = $(this).closest('tr').find('td').eq(-4); // -2 apunta a la celda a la izquierda

                // Obtiene el texto de la celda
                var texto = celda.text().trim();


                // Crea un elemento de textarea temporal para copiar el texto al portapapeles
                var textareaTemp = $('<textarea>').val(texto).appendTo('body').select();



                // Copia el texto al portapapeles
                document.execCommand('copy');

                // Elimina el elemento de textarea temporal
                textareaTemp.remove();


            });
        });
    </script>
    <script src="https://kit.fontawesome.com/ad292c2512.js" crossorigin="anonymous"></script>
@stop
