<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        $empresa = "ABC";
        return view('admin.index', compact('empresa')); 
    }
}
