<?php

namespace LuviUI\LaravelLuvi;

use App\Services\AlertCvaService;
use App\Services\BadgeCvaService;
use App\Services\ButtonCvaService;
use Illuminate\Support\ServiceProvider;

class LaravelLuviServiceProvider extends ServiceProvider
{
    protected $components = [
        'accordion',
        'alert',
        'avatar',
        'badge',
        'button',
        'card',
        'checkbox',
        'command',
        'dropdown-menu',
        'form',
        'hover-card',
        'input',
        'label',
        'menubar',
        'popover',
        'portal',
        'radio-group',
        'select',
        'separator',
        'switch',
        'tabs',
        'textarea',
        'typography',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AlertCvaService::class, fn () => AlertCvaService::new());
        $this->app->singleton(BadgeCvaService::class, fn () => BadgeCvaService::new());
        $this->app->singleton(ButtonCvaService::class, fn () => ButtonCvaService::new());
    }

    public function boot(): void
    {
        foreach ($this->components as $component) {
            $this->publishes([
                __DIR__."/../resources/views/components/{$component}" => resource_path("views/components/{$component}"),
            ], $component);
        }

        $this->publishes([
            __DIR__.'/../App/Services/ButtonCvaService.php' => app_path('Services/ButtonCvaService.php'),
        ], 'button');

        $this->publishes([
            __DIR__.'/../App/Services/AlertCvaService.php' => app_path('Services/AlertCvaService.php'),
        ], 'alert');

        $this->publishes([
            __DIR__.'/../App/Services/BadgeCvaService.php' => app_path('Services/BadgeCvaService.php'),
        ], 'badge');

        // plugins
        $this->publishes([
            __DIR__.'/../resources/js/plugins/accordion.js' => resource_path('js/plugins/accordion.js'),
            __DIR__.'/../resources/js/plugins/collapse.js' => resource_path('js/plugins/collapse.js'),
        ], 'accordion');

        $this->publishes([
            __DIR__.'/../resources/js/plugins/dropdown-menu.js' => resource_path('js/plugins/dropdown-menu.js'),
        ], 'dropdown-menu');

        $this->publishes([
            __DIR__.'/../resources/js/plugins/form.js' => resource_path('js/plugins/form.js'),
        ], 'form');

        $this->publishes([
            __DIR__.'/../resources/js/plugins/hover-card.js' => resource_path('js/plugins/hover-card.js'),
        ], 'hover-card');

        $this->publishes([
            __DIR__.'/../resources/js/plugins/menubar.js' => resource_path('js/plugins/menubar.js'),
        ], 'menubar');

        $this->publishes([
            __DIR__.'/../resources/js/plugins/searchable.js' => resource_path('js/plugins/searchable.js'),
        ], 'searchable');

        // tailwind / css
        $this->publishes([
            __DIR__.'/../tailwind.config.js' => base_path('tailwind.config.js'),
        ], 'tailwind');

        $this->publishes([
            __DIR__.'/../resources/css/luvi-ui.css' => resource_path('css/luvi-ui.css'),
        ], 'css');

    }
}
