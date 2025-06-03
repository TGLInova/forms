<?php

namespace TglInova\Forms\Enums;

use TglInova\Forms\Enums\Contracts\ContainsLabelList;

enum EstadoCivil: string implements ContainsLabelList
{
    case Solteiro = 'S';
    case Casado = 'C';
    case Viuvo = 'V';
    case Divorciado = 'D';

    public function getLabel(): ?string
    {
        return match($this) {
            static::Viuvo => 'Viúvo',
            default       => $this->name
        };
    }

    public static function getLabels(): array
    {
        return array_map(fn (self $enum) => ['label' => $enum->getLabel(), 'value' => $enum->value], static::cases());
    }
}
