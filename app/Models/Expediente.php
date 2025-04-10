<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Estatus;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'numero_expediente',
        'asunto',
        'fecha_inicio',
        'id_estatus',
        'id_usuario_registra',

    ];

    public function estatus()
    {
        return $this->belongsTo(Estatus::class, 'id_estatus');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario_registra');
    }
}
