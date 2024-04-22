@extends('adminlte::page')

@section('title', 'AUTORIZACIÓN SALIDA')

@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>AUTORIZACIÓN SALVOCONDUCTOS</h1>
        </div>
    </div>
@stop

@section('content')

    <div class="row justify-content-center">

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
                                <td class="text-sm align-middle">
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

                                <td class="text-xs text-center align-middle">
                                    <form action="{{ route('passes.destroy2', $item->id) }}" method="POST">
                                        @csrf

                                        <input type="submit" class="btn btn-danger text-xs" onclick="confirmDelete({{ $item->id }})" value= "ELIMINAR"></input>
                                    </form>

                                    <form action="{{ route('passes.authorize', $item->id) }}" method="POST" class="mt-1">
                                        @csrf
                                        <input type="submit" class="btn btn-success text-xs" value= "AUTORIZAR"></input>
                                    </form>
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>

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

        function confirmDelete(itemId) {
            if (confirm('¿Estás seguro de que quieres eliminar este elemento?')) {
                document.getElementById('deleteForm' + itemId).submit();
            }
        }
    </script>
@stop
