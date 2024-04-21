@extends('adminlte::page')

@section('title', 'REPORTES')

@section('content_header')
    <div class="row justify-content-center align-items-center bg-white text-center">
        <div class="col">
            <h1 style="color: red;">SECCIÓN REPORTES</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row justify-content-around">

        <form action="{{route('reports.novelty')}}" method="POST" style="display: flex"
        class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-xs-12 justify-content-center">
            @csrf
            <div class="card card-danger align-self-center" style="max-width: 80% ; justify-self: center">
                <div class="card-header">
                    <h3 class="card-title text-center">REPORTE DE NOVEDADES</h3>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="fechaInicio">Seleccione fecha y hora de inicio de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fechaFin">Seleccione fecha y hora de fin de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" required />
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex; grid-column-gap: 20px; justify-content: center">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i>
                        GENERAR PDF
                    </button>

                </div>
            </div>
        </form>

        <form action="{{route('reports.vehicleLog')}}" method="POST" style="display: flex"
        class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-xs-12 justify-content-center">
            @csrf
            <div class="card card-danger" style="max-width: 80% ; justify-self: center">
                <div class="card-header">
                    <h3 class="card-title text-center">REPORTE DE MOVIMIENTO VEHICULAR</h3>
                </div>
                <div class="card-body">

                    <div class="form-group">

                        <label for="fechaInicio">Seleccione fecha y hora de inicio de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fechaFin">Seleccione fecha y hora de fin de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" required />
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex; grid-column-gap: 20px; justify-content: center">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i>
                        GENERAR PDF
                    </button>
                </div>
            </div>
        </form>



        <form action="{{route('reports.civilianLog')}}" method="POST" style="display: flex"
        class="col-lg-4 col-xl-4 col-md-6 col-sm-12 col-xs-12 justify-content-center">
            @csrf
            <div class="card card-danger" style="max-width: 80% ; justify-self: center">
                <div class="card-header">
                    <h3 class="card-title text-center">REPORTE DE PERSONAL CIVIL</h3>
                </div>
                <div class="card-body">

                    <div class="form-group">

                        <label for="fechaInicio">Seleccione fecha y hora de inicio de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaInicio" name="fechaInicio"
                                required />
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="fechaFin">Seleccione fecha y hora de fin de reporte:</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                            </div>
                            <input type="datetime-local" class="form-control" id="fechaFin" name="fechaFin" required />
                        </div>
                    </div>
                </div>
                <div class="form-group" style="display: flex; grid-column-gap: 20px; justify-content: center">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf"></i>
                        GENERAR PDF
                    </button>
                </div>
            </div>
        </form>
    </div>

    @include('layouts.footer')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop
