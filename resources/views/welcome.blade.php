@extends('adminlte::page')

@section('title', 'INICIO')

@section('content_header')
    <div style="text-align: center;">
        <h1 style="font-size: 40px;">"FUERTE MILITAR ECUADOR"</h1>
    </div>

@stop

@section('content')
    <div class="row">
        @can('new.index')
        <div class="col-12 text-center bg-info text-white p-2  m-1 rounded">
            <p>Bienvenido al Sistema Argos. Por favor, comuníquese con el encargado de la guardia de TIC's para que sea
                habilitado su usuario.</p>
            <div>
                <p>Celular: 095 886 7101</p>
            </div>
        </div>
        @endcan

        <div class="col-12 ">
            <img class="img-fluid img-border img-round" src="{{ asset('vendor/adminlte/dist/img/FFAA_WP.jpg') }}"
                alt="IMAGEN FONDO">
        </div>
    </div>

    @include('layouts.footer')

@stop
