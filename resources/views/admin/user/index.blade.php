@extends('adminlte::page')

@section('title', 'ADMINISTRADOR')


@section('content_header')
    <div class="row justify-content-center align-item-center">
        <div class="col text-center">
            <h1>ADMINISTRACIÓN DE USUARIOS</h1>
        </div>
    </div>

@stop

@section('content')

    <div class="row">

        <div class="col ">
            <div class="card">

                <div class="card-body table-responsive pl-2 pr-2">
                    <table id="movVehiclesTable" class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th class="text-center">ORD</th>
                                <th class="text-center">UNIDAD</th>
                                <th class="text-center">GRADO</th>
                                <th class="text-center">APELLIDOS Y NOMBRES</th>
                                <th class="text-center">CÉDULA</th>
                                <th class="text-center">CORREO</th>
                                <th class="text-center">FUNCIÓN</th>
                                <th class="text-center">ACTIVO</th>
                                <th class="text-center">ACCIONES</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $i => $dato)
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
                                    <td class="align-middle text-wrap">
                                        {{ $dato->user }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->identification_card }}
                                    </td>
                                    <td class="text-center align-middle">
                                        {{ $dato->email }}
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($dato->role == 'Admin')
                                            <span class="badge badge-danger">Administrador</span>
                                        @elseif ($dato->role == 'Commander')
                                            <span class="badge badge-success">Comandante</span>
                                        @elseif ($dato->role == 'Logistic')
                                            <span class="badge badge-info">Logístico</span>
                                        @elseif ($dato->role == 'Guard')
                                            <span class="badge badge-secondary">Usuario</span>
                                        @endif
                                    </td>
                                    <td class="text-center align-middle">
                                        @if ($dato->is_active == 1)
                                            <span class="badge badge-success">Activo</span>
                                        @else
                                            <span class="badge badge-danger">Inactivo</span>
                                        @endif
                                    </td>


                                    <td class="text-center align-middle">
                                        <form action="{{ route('users.edit', $dato->id) }}" method="POST">
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
            // Función para validar el formato de placa
            function validarPlate(plate) {
                var regex = /^(?:[A-Z]{3}-\d{4}|[A-Z]{2}\d{3}[A-Z])$/;
                return regex.test(plate);
            }

            // Evento input en el campo de placa
            $('#plate').on('input', function() {
                var plateValue = $(this).val();

                if (validarPlate(plateValue)) {
                    // El valor es válido, aplicar estilo de éxito
                    $(this).removeClass('is-invalid').addClass('is-valid');
                } else {
                    // El valor no es válido, aplicar estilo de error
                    $(this).removeClass('is-valid').addClass('is-invalid');
                }
            });

            // Evento submit en el formulario
            $('#forNewVehicle').submit(function(e) {
                e.preventDefault(); // Evitar el envío del formulario por defecto

                var plateValue = $('#plate').val();

                if (validarPlate(plateValue)) {
                    // La placa es válida, permitir el envío del formulario
                    this.submit();
                } else {
                    // Mostrar mensaje de error y evitar el envío del formulario
                    alert('La placa no cumple con el formato requerido (AAA-0000 o AA000A).');
                }
            });
        });
    </script>
@stop
