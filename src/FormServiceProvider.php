<?php

namespace TglInova\Forms;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use Livewire\Livewire;

class FormServiceProvider extends ServiceProvider
{
    protected array $components = [
        'seguro-vida' => \TglInova\Forms\Livewire\Components\SeguroVida::class,
        'seguro-auto' => \TglInova\Forms\Livewire\Components\SeguroAuto::class,
    ];

    public function boot()
    {
        $this->setupMigrations();
    }

    public function register()
    {

        $this->mergeConfigFrom(__DIR__ . '/../config/tglinova_forms.php', 'tglinova_forms');

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'tglinova_forms');

        $this->callAfterResolving(BladeCompiler::class, function () {

            $config = $this->app->config['tglinova_forms'];

            foreach ($this->components as $name => $component) {

                $fullname = $config['prefix'] . $name;

                Livewire::component($fullname, $component);
            }
        });
    }

    protected function setupMigrations()
    {
        $path = __DIR__ . '/../database/migrations';

        $this->loadMigrationsFrom($path);

        $this->publishesMigrations([
            $path => database_path('migrations'),
        ]);
    }
}
