<?php

namespace TglInova\Forms\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Formulario extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'descricao', 'componente'];

    public function respostas()
    {
        return $this->hasMany(FormularioResposta::class);
    }
}
