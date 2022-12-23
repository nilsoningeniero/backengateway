<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propietario extends Model
{
    protected $table = 'propietario';

    protected $connection  = 'mysql';
    const CREATED_AT = 'fechacreacion';
    const UPDATED_AT = 'fechamodificacion';
    
    protected $fillable = [
        'tipo_documento',
        'documento',
        'nombres',
        'apellidos',
        'direccion',
        'telefono',
        'email',
        'fechacreacion',
        'usuariocreacion',
        'fechamodificacion',
        'usuariomodificacion',
        'ipcreacion',
        'ipmodificacion'
    ];
}
