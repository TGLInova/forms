<?php

namespace TglInova\Forms\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Formulario extends Model
{
    use SoftDeletes;

    protected $fillable = ['nome', 'descricao', 'componente', 'apresentador'];

    public function casts(): array
    {
        return ['campos' => 'json'];
    }

    public function slug(): Attribute
    {
        return Attribute::make(get: fn() => Str::slug($this->nome));
    }

    public function respostas()
    {
        return $this->hasMany(FormularioResposta::class);
    }

    public function url(): Attribute
    {
        return Attribute::make(get: fn() => route('tglinova-forms.show', [
            'formulario' => $this,
            'slug' => $this->slug
        ]));
    }
}
