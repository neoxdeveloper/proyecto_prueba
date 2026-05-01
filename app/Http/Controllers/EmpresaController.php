<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class EmpresaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $paises = DB::table('countries')->get();
        $monedas = DB::table('currencies')->get();

        return view('admin.empresas.create', compact('paises', 'monedas'));
    }

    public function buscar_estado($id_pais)
    {

        try {
            $estados = DB::table('states')->where('country_id', $id_pais)->get();

            return view('admin.empresas.cargar_estados', compact('estados'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function buscar_ciudad($id_estado)
    {
        try {
            $ciudades = DB::table('cities')->where('state_id', $id_estado)->get();

            return view('admin.empresas.cargar_ciudades', compact('ciudades'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pais' => 'required',
            'nombre_empresa' => 'required',
            'tipo_empresa' => 'required',
            'nit' => 'required|unique:empresas,nit',
            'telefono_empresa' => 'required',
            'correo_empresa' => 'required|email|unique:empresas,correo',
            'cantidad_impuesto' => 'required',
            'nombre_impuesto' => 'required',
            'moneda' => 'required',
            'ciudades' => 'required',
            'estados' => 'required',
            'codigo_postal' => 'required',
            'direccion' => 'nullable',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $empresa = new Empresa;

        $empresa->pais = $request->pais;
        $empresa->nombre_empresa = $request->nombre_empresa;
        $empresa->tipo_empresa = $request->tipo_empresa;
        $empresa->nit = $request->nit;
        $empresa->telefono = $request->telefono_empresa;
        $empresa->correo = $request->correo_empresa;
        $empresa->cantidad_impuesto = $request->cantidad_impuesto;
        $empresa->nombre_impuesto = $request->nombre_impuesto;
        $empresa->moneda = $request->moneda;
        $empresa->direccion = $request->direccion;
        $empresa->ciudad = $request->ciudades;
        $empresa->departamento = $request->estados;
        $empresa->codigo_postal = $request->codigo_postal;

        if ($request->hasFile('logo')) {
            $empresa->logo = $request->file('logo')->store('logos', 'public');
        }

        $empresa->save();

        $usuario = new user();
        $usuario->name = "Admin";
        $usuario->email = $request->correo_empresa;
        $usuario->password = Hash::make($request['nit']);
        $usuario->empresa_id = $empresa->id;
        $usuario->save();

        Auth::Login($usuario);


        return redirect()->route('admin.index')
            ->with('mensaje', 'Se registró la empresa correctamente')
            ->with('icono', 'success');
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view ('admin.configuraciones.edit', compact('empresa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Empresa $empresa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Empresa $empresa)
    {
        //
    }
}
