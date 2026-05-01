<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Empresa;
class AdminController extends Controller
{
    public function index(){
        // Usamos la relación definida en el modelo User para obtener la empresa
        $empresa = Auth::user()->empresa;
        
        return view('admin.index', compact('empresa'));
    }
}
