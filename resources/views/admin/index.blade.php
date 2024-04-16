@extends('adminlte::page')

@section('title', 'ADMINISTRADOR')

@section('content_header')

<div class="row justify-content-center align-items-center bg-white text-center" >
    <div class="col">
        <h1 style="color: black; font-weight: bold;">SECCIÓN ADMINISTRADOR</h1>
    </div>
</div>

@stop

@section('content')
<div class="main-content" style="background-image: url('{{ asset('vendor/adminlte/dist/img/home.jpg') }}'); background-size: cover; padding: 60px;">
    <div class="row justify-content-center">
            <div class="col-lg-6 col-sm-12 col-md-7 mb-5">
                <a href="{{route('vehicles.index')}}" class="btn btn-lg d-flex flex-column align-items-center">
                <img src="{{ asset('vendor/adminlte/dist/img/vehiculo.png') }}" alt="Conductor" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20%;">
                    <span style="font-size: 15px; color: black; font-weight: bold;">VEHICULAR </span>
                </a>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-7 mb-5">
                <a href="#" class="btn btn-lg d-flex flex-column align-items-center">
                <img src="{{ asset('vendor/adminlte/dist/img/conductor.png') }}" alt="Conductor" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20%;">
                    <span style="font-size: 15px; color: black; font-weight: bold;">CONDUCTORES</span>
                </a>
            </div>

            <div class="col-lg-6 col-sm-12 col-md-7 mb-5">
                <a href="#" class="btn btn-lg d-flex flex-column align-items-center">
                <img src="{{ asset('vendor/adminlte/dist/img/usuario.png') }}" alt="Conductor" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20%;">
                    <span style="font-size: 15px; color: black; font-weight: bold;">USUARIOS</span>
                </a>
            </div>
            <div class="col-lg-6 col-sm-12 col-md-7 mb-5">
                <a href="#" class="btn btn-lg d-flex flex-column align-items-center">
                <img src="{{ asset('vendor/adminlte/dist/img/cuartel.png') }}" alt="Conductor" style="width: 100px; height: 100px; object-fit: cover; border-radius: 20%;">
                    <span style="font-size: 15px; color: black; font-weight: bold;">UNIDAD MILITAR</span>
                </a>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>

@stop

