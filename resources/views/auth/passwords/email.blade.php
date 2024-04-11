@extends('layouts.app')

@section('content')
<body style="background-image: url('{{ asset('images/fondo1.jpg') }}'); background-size: cover; background-position: center; height: 100vh; margin: 0; padding: 0;">
    <div class="container"style="margin-top: 150px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header text-center">{!! __('<strong>Recuperar Usuario</strong>') !!}</div>
                    <div style="text-align: center;">
                        {{ __('Contacte al administrador del sistema') }}<br>
                        {{ __('1800-TICS-COIMCE') }}
                    </div>
                </div>
            </div>
        </div>
    </div> 
     <!-- Iconos de imágenes en la parte inferior centrada -->
     <div style="position: fixed; bottom: 20px; width: 100%; text-align: center;">
        <img src="{{ asset('images/geo.png') }}" alt="Icono 1" style="width: 100px; height: 100px; margin: 0 20px;">
        <img src="{{ asset('images/im.png') }}" alt="Icono 2" style="width: 100px; height: 100px; margin: 0 20px;">
        <img src="{{ asset('images/uempe.png') }}" alt="Icono 3" style="width: 100px; height: 120px; margin: 0 20px;">
    </div>   
</body>
@endsection
