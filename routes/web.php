<?php

use Illuminate\Support\Facades\Route;
use TglInova\Forms\Models\Formulario;

Route::get('{formulario}/{slug?}', function (Formulario $formulario, ?string $slug = null) {

    if ($formulario->slug !== $slug) {
        return redirect()
            ->route('tglinova-forms.show', ['formulario' => $formulario, 'slug' => $formulario->slug], 301);
    }

    return view('tglinova_forms::presenter', compact('formulario'));
})->name('tglinova-forms.show');
