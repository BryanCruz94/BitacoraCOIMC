@extends('adminlte::page')

@section('title', 'INICIO')

@section('content_header')
<div style="text-align: center;">
    <h1 style="font-size: 40px;">"FUERTE MILITAR ECUADOR"</h1>
</div>

@stop

@section('content')
<div class="row">
    <div class="col ">
        <img class="img-fluid img-border img-round"
        src="{{ asset('vendor/adminlte/dist/img/FFAA_WP.jpg') }}" alt="IMAGEN FONDO">
    </div>
</div>
@stop


