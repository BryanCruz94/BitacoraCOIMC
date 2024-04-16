@extends('adminlte::page')

@section('title', 'ADMINISTRADOR')


@section('content_header')
<div class="row justify-content-center align-items-center bg-white text-center" >
    <div class="col">
        <h1 style="color: black;">SECCIÓN ADMINISTRADOR</h1>
    </div>
</div>

@stop

@section('content')

    <div class="row justify-content-center">
        <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
            <a href="{{route('vehicles.index')}}" class="btn btn-primari btn-lg d-flex flex-column align-items-center">
                <i class="fas fa-car fa-3x mb-2"></i> <!-- Icono de Font Awesome -->
                <span style="font-size: 15px; color: black;">VEHICULAR </span>
            </a>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
            <a href="{{route('drivers.index')}}" class="btn btn-dangerR btn-lg d-flex flex-column align-items-center">
            <i class="fas fa-user fa-3x mb-2"></i>
                <span style="font-size: 15px; color: black;">CONDUCTORES</span>
            </a>
        </div>

        <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
            <a href="#" class="btn btn-warnin btn-lg d-flex flex-column align-items-center">
                <i class="fas fa-user fa-3x mb-2"></i>
                <span style="font-size: 15px; color: black;">USUARIOS</span>
            </a>
        </div>
        <div class="col-lg-6 col-sm-12 col-md-6 mb-2">
            <a href="#" class="btn btn-succes btn-lg d-flex flex-column align-items-center">
            <i class="fas fa-home fa-3x mb-2"></i>
                <span style="font-size: 15px; color: black;">UNIDAD MILITAR</span>
            </a>
        </div>
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
