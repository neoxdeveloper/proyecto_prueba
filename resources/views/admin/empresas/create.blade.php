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
                    <form action="{{ route('admin.empresas.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="Logo">Logo de la empresa</label>
                                    <input type="file" class="form-control" id="logo_input" name="logo"
                                        accept=".jpg, .png, .jpeg, .gif, .webp" required>
                                    @error('logo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror




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
                                            <select name="pais" id="select_pais" class="form-control" required>
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
                                            <div id="respuesta_pais">

                                            </div>

                                        </div>

                                    </div>

                                    <div class="col-md-4">



                                        <label for="ciudad">Ciudad</label>
                                        <div id="respuesta_estado">

                                        </div>

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">

                                            <label for="nombre_de_la_empresa">Nombre de la empresa</label>
                                            <input type="text" value="{{ old('nombre_empresa') }}" name="nombre_empresa"
                                                class="form-control" required>
                                            @error('nombre_empresa')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror



                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="tipo_de_la_empresa">Tipo de la empresa</label>
                                            <input type="text" value="{{ old('tipo_empresa') }}" name="tipo_empresa"
                                                class="form-control" required>
                                            @error('tipo_empresa')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <label for="nit">NIT</label>
                                        <input type="number" value="{{ old('nit') }}" name="nit" class="form-control"
                                            required>
                                        @error('nit')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>

                                    <div class="col-md-2">
                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="" class="form-control" required>
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
                                            <input type="text" value="{{ old('nombre_impuesto') }}"
                                                name="nombre_impuesto" class="form-control" required>
                                            @error('nombre_impuesto')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror



                                        </div>
                                    </div>

                                    <div class="col-md-2">

                                        <div class="form-group">

                                            <label for="cantidad_impuesto">Cantidad</label>
                                            <input type="number" value="{{ old('cantidad_impuesto') }}"
                                                name="cantidad_impuesto" class="form-control" required>
                                            @error('cantidad_impuesto')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col-md-3">

                                        <label for="telefono_empresa">Teléfonos de la empresa</label>
                                        <input type="number" value="{{ old('telefono_empresa') }}"
                                            name="telefono_empresa" class="form-control" required>
                                        @error('telefono_empresa')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>


                                    <div class="col-md-4">

                                        <label for="correo_empresa">Correo de la empresa</label>
                                        <input type="text" value="{{ old('correo_empresa') }}" name="correo_empresa"
                                            class="form-control" required>
                                        @error('correo_empresa')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>




                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <label for="direccion">Dirección de la empresa</label>
                                        <input id="pac-input" class="form-control" name="direccion" type="text"
                                            value="{{ old('direccion') }}" placeholder="Buscar Dirección">
                                        @error('direccion')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                        <br>
                                        <div id="map"
                                            style="height: 400px; width: 100%; border: 1px solid #ccc; border-radius: 8px;">
                                        </div>
                                    </div>

                                    <div class="col-md-3">

                                        <label for="codigo_postal">Código postal</label>
                                        <select name="codigo_postal" id="" class="form-control" required>
                                            <option value="">Seleccione un código postal</option>
                                            @foreach ($paises as $paise)
                                                <option value="{{ $paise->phone_code }}">{{ $paise->phone_code }}</option>
                                            @endforeach
                                        </select>

                                    </div>

                                </div>

                                <hr>

                                <div>
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-lg btn-primary btn-block">Crear
                                            empresa</button>
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
    <script async defer
        src="https://maps.googleapis.com/maps/api/js?key={{ config('services.google_maps.key') }}&libraries=places&callback=initAutocomplete"></script>


    <script>
        function initAutocomplete() {
            const map = new google.maps.Map(document.getElementById("map"), {
                center: { lat: -33.4489, lng: -70.6693 },
                zoom: 13,
                mapTypeId: "roadmap",
            });

            // Create the search box and link it to the UI element.
            const input = document.getElementById("pac-input");
            const searchBox = new google.maps.places.SearchBox(input);

            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Bias the SearchBox results towards current map's viewport.
            map.addListener("bounds_changed", () => {
                searchBox.setBounds(map.getBounds());
            });

            let markers = [];

            // Listen for the event fired when the user selects a search box result.
            searchBox.addListener("places_changed", () => {
                const places = searchBox.getPlaces();

                if (places.length == 0) {
                    return;
                }

                // Clear out the old markers.
                markers.forEach((marker) => {
                    marker.setMap(null);
                });
                markers = [];

                // For each place, get the icon, name, and location.
                const bounds = new google.maps.LatLngBounds();

                places.forEach((place) => {
                    if (!place.geometry || !place.geometry.location) {
                        console.log("Returned place has no geometry");
                        return;
                    }

                    const icon = {
                        url: place.icon,
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(35, 35),
                        scaledSize: new google.maps.Size(25, 25),
                    };

                    // Create a marker for each place.
                    markers.push(
                        new google.maps.Marker({
                            map,
                            icon,
                            title: place.name,
                            position: place.geometry.location,
                        })
                    );

                    if (place.geometry.viewport) {
                        // Only geocodes have this property
                        bounds.union(place.geometry.viewport);
                    } else {
                        bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
            });
        }
    </script>

    <script>
        $('#select_pais').on('change', function () {
            var id_pais = $('#select_pais').val();
            if (id_pais) {
                $.ajax({
                    url: "{{ url('/crear-empresa/estado/') }}/" + id_pais,
                    type: "GET",
                    success: function (data) {
                        $('#respuesta_pais').html(data);
                    }
                });
            } else {
                alert('Debe seleccionar un pais');
            }
        });
    </script>


    <script>
        $(document).on('change', '#select_estado', function () {
            var id_estado = $('#select_estado').val();

            $.ajax({
                url: "{{ url('/crear-empresa/ciudad/') }}/" + id_estado,
                type: "GET",
                success: function (data) {
                    $('#respuesta_estado').html(data);
                }
            });
        });
    </script>




    @stop