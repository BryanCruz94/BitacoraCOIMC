@extends('layouts.app')

@section('content')
<body style="background-image: url('{{ asset('images/fondo1.jpg') }}'); background-size: 90% 150%; margin: 0; padding: 0;">
    <div class="container"style="margin-top: 60px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header text-center">{!! __('<strong>Registrar</strong>') !!}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

            

                                    <div class="form-group row mb-2">
                                        <label for="names" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                                        <div class="col-md-6">
                                            <input id="names" type="text" class="form-control @error('names') is-invalid @enderror" name="names" value="{{ old('names') }}" required autocomplete="names" autofocus>

                                            @error('names')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>




                                    <div class="form-group row mb-2">
                                        <label for="last_names" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                                        <div class="col-md-6">
                                            <input id="last_names" type="text" class="form-control @error('last_names') is-invalid @enderror" name="last_names" value="{{ old('last_names') }}" required autocomplete="last_names">

                                            @error('last_names')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>



                                    <div class="form-group row mb-2">
                                        <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                                        <div class="col-md-6">
                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="identification_card" class="col-md-4 col-form-label text-md-right">{{ __('Número de Identificación') }}</label>

                                        <div class="col-md-6">
                                            <input id="identification_card" type="text" class="form-control @error('identification_card') is-invalid @enderror" name="identification_card" value="{{ old('identification_card') }}" required autocomplete="identification_card">

                                            @error('identification_card')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="form-group row mb-2">
                                        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo Electrónico') }}</label>

                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row mb-2">
                                        <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <img id="user-photo">
                                        <label for="btn-photo" class="col-md-4 col-form-label text-md-right">{{ __('Selecciona una imagen') }}</label>
                                        <div class="col-md-6">
                                            <input id="btn-photo" type="file" class="form-control @error('user-photo') is-invalid @enderror" name="image" required autofocus onchange="previewImage(event)">
                                            @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    

                                    <div class="col-4">
                                        <div class="form-group">
                                                <label for="rank_id">Seleccione su grado:</label>
                                                <select name="rank_id" id="rank_id" required>
                                                    <option value=1 select>S.P</option>
                                                    <option value=2 >SLDO</option>
                                                    <option value=3>CBOS</option>
                                                    <option value=4>CBOP</option>
                                                    <option value=5>SGOS</option>
                                                    <option value=6>SGOP</option>
                                                    <option value=7>SUBS</option>
                                                    <option value=8>SUBS</option>
                                                    <option value=9>SUBP</option>
                                                    <option value=10>SUBT</option>
                                                    <option value=11>TNTE</option>
                                                    <option value=12>CAPT</option>
                                                    <option value=13>MAYO</option>
                                                    <option value=14>TCRN</option>
                                                    <option value=15>GRAB</option>                                                   
                                                </select>
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                                <label for="military_unit_id">Seleccione su unidad:</label>
                                                <select name="military_unit_id" id="military_unit_id" required>
                                                    <option value=1 select>COIMC</option>
                                                    <option value=2 >GMREC</option>
                                                    <option value=3>GEO</option>
                                                    <option value=4>UEMPE</option>                                                                                   
                                                </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-0">
                                        <div class="col-md-6 offset-md-4 d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary">
                                                    {{ __('Registrar') }}
                                            </button>
                                        </div>
                                    </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{--

    <!-- Iconos de imágenes en la parte inferior centrada -->
    <div style="position: fixed; bottom: 20px; width: 100%; text-align: center;">
        <img src="{{ asset('images/geo.png') }}" alt="Icono 1" style="width: 100px; height: 100px; margin: 0 20px;">
        <img src="{{ asset('images/im.png') }}" alt="Icono 2" style="width: 100px; height: 100px; margin: 0 20px;">
        <img src="{{ asset('images/uempe.png') }}" alt="Icono 3" style="width: 100px; height: 120px; margin: 0 20px;">
    </div>
--}}

<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript"></script>
<script src="resources/js/servicio-imagen.js"></script>

</body>


@endsection
