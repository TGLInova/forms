<?php

namespace TglInova\Forms;

use Illuminate\Support\Facades\Blade;
use Livewire\Livewire;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;
use TglInova\Forms\Livewire\Components;

class FormServiceProvider extends ServiceProvider
{
    protected array $components = [
        'seguro-saude'      => Components\SeguroSaude::class,
        'seguro-auto'       => Components\SeguroAuto::class,
        'seguro-condominio' => Components\SeguroCondominio::class,
    ];

    public function boot()
    {
        $this->setupMigrations();
    }

    public function register()
    {

        $this->setupConfig();

        $this->setupViews();

        $this->callAfterResolving(BladeCompiler::class, function () {

            $config = $this->app->config['tglinova_forms'];

            foreach ($this->components as $name => $component) {

                $fullname = $config['prefix'] . $name;

                Livewire::component($fullname, $component);
            }

            Route::middleware('web')
                ->prefix($config['route_prefix'])
                ->group(__DIR__ . '/../routes/web.php');
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

    protected function setupConfig()
    {
        $path = __DIR__ . '/../config/tglinova_forms.php';

        $this->mergeConfigFrom($path, 'tglinova_forms');

        $this->publishes([
            $path => config_path('tglinova_forms.php')
        ], 'tglinova-forms-config');
    }

    protected function setupViews()
    {
        $path = __DIR__ . '/../resources/views';

        $this->loadViewsFrom($path, 'tglinova_forms');

        Blade::anonymousComponentPath($path . '/components', 'tglinova-forms');

        $this->publishes([
            $path => resource_path('views/vendor/tglinova_forms'),
        ], 'tglinova-forms-view');
    }
}
