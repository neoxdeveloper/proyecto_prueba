<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $empresa = \App\Models\Empresa::firstOrCreate(
            ['nombre_empresa' => 'Empresa por Defecto'],
            [
                'pais' => 'Colombia',
                'tipo_empresa' => 'General',
                'nit' => '000000000-0',
                'telefono' => '0000000',
                'correo' => 'empresa@ejemplo.com',
                'cantidad_impuesto' => 19,
                'nombre_impuesto' => 'IVA',
                'moneda' => 'COP',
                'direccion' => 'Dirección por defecto',
                'ciudad' => 'Bogotá',
                'departamento' => 'Cundinamarca',
                'codigo_postal' => '000000',
                'logo' => 'default_logo.png',
            ]
        );

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'empresa_id' => $empresa->id,
        ]);
    }
}
