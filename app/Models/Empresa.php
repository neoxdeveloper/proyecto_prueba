<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'pais',
        'nombre_empresa',
        'tipo_empresa',
        'nit',
        'telefono',
        'correo',
        'cantidad_impuesto',
        'nombre_impuesto',
        'moneda',
        'direccion',
        'ciudad',
        'departamento',
        'codigo_postal',
        'logo',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
    //
}
