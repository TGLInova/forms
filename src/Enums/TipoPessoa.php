<?php
namespace TglInova\Forms\Enums;

enum TipoPessoa: string
{
    case PESSOA_FISICA = 'F';
    case PESSOA_JURIDICA = 'J';

    public function getLabel(): ?string
    {
        return match($this) {
            static::PESSOA_FISICA => 'Pessoa Física',
            static::PESSOA_JURIDICA => 'Pessoa Jurídica',
            default => null,
        };
    }
}
