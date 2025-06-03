<?php

namespace TglInova\Forms\Models;

use Illuminate\Database\Eloquent\Model;

class FormularioResposta extends Model
{
    protected $fillable = ['formulario_id', 'dados'];

    public function casts()
    {
        return [
            'dados' => 'json'
        ];
    }
}
