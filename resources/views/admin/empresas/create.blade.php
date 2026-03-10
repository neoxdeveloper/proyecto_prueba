@extends('adminlte::master')

@php
    $authType = $authType ?? 'login';
    $dashboardUrl = View::getSection('dashboard_url') ?? config('adminlte.dashboard_url', 'home');

    if (config('adminlte.use_route_url', false)) {
        $dashboardUrl = $dashboardUrl ? route($dashboardUrl) : '';
    } else {
        $dashboardUrl = $dashboardUrl ? url($dashboardUrl) : '';
    }

    $bodyClasses = "{$authType}-page";

    if (!empty(config('adminlte.layout_dark_mode', null))) {
        $bodyClasses .= ' dark-mode';
    }
@endphp

@section('adminlte_css')
@stack('css')
@yield('css')
@stop

@section('classes_body'){{ $bodyClasses }}@stop

@section('body')
<div class="container">


    {{-- Logo personalizado --}}

    <br>
    <center>

        <img src="{{ asset('images/logo.png') }}" width="250px" alt="Logo">


    </center>
    <br>







    <div class="row">
        <div class="col-md-12">

            {{-- Card Box --}}

            <div class="card {{ config('adminlte.classes_auth_card', 'card-outline card-primary') }}" style="">

                {{-- Card Header --}}

                <div class="card-header {{ config('adminlte.classes_auth_header', '') }}">
                    <h3 class="card-title float-none text-center">
                        <b>REGISTRO DE UNA NUEVA EMPRESA</b>
                    </h3>
                </div>


                {{-- Card Body --}}
                <div class="card-body {{ $authType }}-card-body {{ config('adminlte.classes_auth_body', '') }}">
                    <form action="">

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Logo">Logo de la empresa</label>
                                    <input type="file" class="form-control" id="logo_input" name="logo">

                                    <div class="mt-3 text-center">
                                        <output id="list">
                                            <div class="p-2 border rounded bg-light"
                                                style="min-height: 150px; display: flex; align-items: center; justify-content: center;">
                                                <small class="text-muted">Vista previa del logo</small>
                                            </div>
                                        </output>
                                    </div>

                                    <script>
                                        function archivo(evt) {
                                            var files = evt.target.files;
                                            var output = document.getElementById('list');

                                            // Limpiar vista previa anterior
                                            output.innerHTML = '';

                                            for (var i = 0, f; f = files[i]; i++) {
                                                if (!f.type.match('image.*')) {
                                                    continue;
                                                }

                                                var reader = new FileReader();
                                                reader.onload = (function (theFile) {
                                                    return function (e) {
                                                        var img = document.createElement('img');
                                                        img.src = e.target.result;
                                                        img.className = 'img-thumbnail';
                                                        img.style.width = '100%';
                                                        img.title = escape(theFile.name);
                                                        output.appendChild(img);
                                                    };
                                                })(f);
                                                reader.readAsDataURL(f);
                                            }
                                        }
                                        document.getElementById('logo_input').addEventListener('change', archivo, false);
                                    </script>


                                </div>
                            </div>






                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">Pais</label>
                                            <select name="pais" id="" class="form-control">
                                                <option value="">Seleccione un pais</option>
                                                @foreach ($paises as $pais)
                                                    <option value="{{ $pais->id }}">{{ $pais->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">



                                            <label for="estados">Estado/Provincia/Región</label>
                                            <select name="estados" id="" class="form-control">
                                                <option value="">Seleccione un estado</option>
                                                @foreach ($estados as $estado)
                                                    <option value="{{ $estado->id }}">{{ $estado->name }}</option>
                                                @endforeach
                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-4">



                                        <label for="ciudad">Ciudad</label>
                                        <select name="ciudad" id="" class="form-control">
                                            <option value="">Seleccione una ciudad</option>
                                            @foreach ($ciudades as $ciudad)
                                                <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
                                            @endforeach
                                        </select>

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <label for="nombre_de_la_empresa">Nombre de la empresa</label>
                                            <input type="text" class="form-control">



                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="tipo_de_la_empresa">Tipo de la empresa</label>
                                            <input type="text" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <label for="nit">NIT</label>
                                        <input type="number" class="form-control">

                                    </div>

                                    <div class="col-md-2">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="" class="form-control">
                                            @foreach ($monedas as $moneda)
                                                <option value="{{ $moneda->id }}">{{ $moneda->name }} {{ $moneda->symbol }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <label for="nombre_impuesto">Nombre del impuesto</label>
                                            <input type="text" class="form-control">



                                        </div>
                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="cantidad_impuesto">Cantidad</label>
                                            <input type="number" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <label for="telefono_empresa">Teléfonos de la empresa</label>
                                        <input type="number" class="form-control">

                                    </div>


                                    <div class="col-md-4">

                                        <label for="correo_empresa">Correo de la empresa</label>
                                        <input type="text" class="form-control">

                                    </div>




                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <label for="direccion_empresa">Dirección de la empresa</label>
                                        <input type="text" class="form-control">



                                    </div>

                                    <div class="col-md-3">

                                        <label for="codigo_postal">Código postal</label>
                                        <select name="codigo_postal" id="" class="form-control">
                                            <option value="">Seleccione un código postal</option>
                                            @foreach ($paises as $paise)
                                                <option value="{{ $paise->phone_code }}">{{ $paise->phone_code }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>

                            </div>

                        </div>




                    </form>


                    {{-- Card Footer --}}
                    @hasSection('auth_footer')
                        <div class="card-footer {{ config('adminlte.classes_auth_footer', '') }}">
                            @yield('auth_footer')
                        </div>
                    @endif


                </div>


            </div>
        </div>








    </div>
    @stop

    @section('adminlte_js')
    @stack('js')
    @yield('js')
    @stop