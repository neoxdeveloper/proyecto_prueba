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
                                    <label for="Logo">Nombre</label>
                                    <input type="file" class="form-control" id="nombre" name="nombre">
                                </div>
                            </div>






                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="pais">Pais</label>
                                            <select name="pais" id="" class="form-control">
                                                <option value="Pais">Seleccione un pais</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Ecuador">Ecuador</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="nombre_empresa">Nombre de la empresa</label>
                                            <input type="text" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <label for="tipo_de_la_empresa">Tipo de la empresa</label>
                                        <input type="text" class="form-control">

                                    </div>


                                </div>


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nit">NIT</label>
                                            <input type="text" class="form-control">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="telefono">Telefonos de la Empresa</label>
                                            <input type="text" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <label for="correo">Correo de la empresa</label>
                                        <input type="email" class="form-control">

                                    </div>


                                </div>





                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="cantidad_impuesto">Cantidad de impuesto</label>
                                            <input type="number" class="form-control">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="nombre_impuesto">Nombre del impuesto</label>
                                            <input type="text" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <label for="moneda">Moneda</label>
                                        <select name="moneda" id="" class="form-control">
                                            <option value="Bs">Bs</option>
                                            <option value="Dolar">Dolar</option>
                                            <option value="Euros">Euros</option>
                                        </select>

                                    </div>


                                </div>




                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="direccion">Direccion</label>
                                            <input type="text" class="form-control">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="form-group">

                                            <label for="ciudad">Ciudad</label>
                                            <input type="text" class="form-control">

                                        </div>

                                    </div>

                                    <div class="col-md-4">

                                        <label for="departamento">Departamento/Provincia/Región</label>
                                        <input type="text" class="form-control">

                                    </div>


                                </div>



                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo_postal">Codigo Postal</label>
                                            <input type="number" class="form-control">

                                            </select>
                                        </div>
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