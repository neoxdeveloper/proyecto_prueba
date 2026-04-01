<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');


Route::get('/crear-empresa', [App\Http\Controllers\EmpresaController::class, 'create'])->name('admin.index');
Route::get('/crear-empresa/estado/{id_pais}', [App\Http\Controllers\EmpresaController::class, 'buscar_estado'])->name('admin.empresas.create.buscar_estado');
Route::get('/crear-empresa/ciudad/{id_estado}', [App\Http\Controllers\EmpresaController::class, 'buscar_ciudad'])->name('admin.empresas.create.buscar_ciudad');
Route::post('/crear-empresa/create', [App\Http\Controllers\EmpresaController::class, 'store'])->name('admin.empresas.store');
