<?php

namespace LuviUI\LaravelLuvi;

use App\Services\AlertCvaService;
use App\Services\BadgeCvaService;
use App\Services\ButtonCvaService;
use App\Services\DialogCvaService;
use Illuminate\Support\ServiceProvider;

class LaravelLuviServiceProvider extends ServiceProvider
{
    protected $components = [
        'accordion',
        'alert',
        'avatar',
        'badge',
        'breadcrumb',
        'button',
        'card',
        'checkbox',
        'dialog',
        'dropdown-menu',
        'form',
        'hover-card',
        'input',
        'label',
        'link',
        'menubar',
        'popover',
        'portal',
        'radio-group',
        'select',
        'separator',
        'sheet',
        'switch',
        'tabs',
        'textarea',
        'tooltip',
        'typography',
    ];

    protected $livewireComponents = [
        'combobox',
    ];

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(AlertCvaService::class, fn () => AlertCvaService::new());
        $this->app->singleton(BadgeCvaService::class, fn () => BadgeCvaService::new());
        $this->app->singleton(ButtonCvaService::class, fn () => ButtonCvaService::new());
        $this->app->singleton(DialogCvaService::class, fn () => DialogCvaService::new());
    }

    public function boot(): void
    {
        foreach ($this->components as $component) {
            $this->publishes([
                __DIR__."/../resources/views/components/{$component}" => resource_path("views/components/{$component}"),
            ], $component);
        }

        foreach ($this->livewireComponents as $livewireComponent) {
            $this->publishes([
                __DIR__."/../resources/views/livewire/{$livewireComponent}" => resource_path("views/livewire/{$livewireComponent}"),
            ], $livewireComponent);

            $this->publishes([
                __DIR__.'/../app/Livewire/Ui/'.str($livewireComponent)->ucfirst().'.php' => app_path('Livewire/Ui/'.str($livewireComponent)->ucfirst()).'.php',
            ], $livewireComponent);
        }

        $this->publishes([
            __DIR__.'/../app/Services/ButtonCvaService.php' => app_path('Services/ButtonCvaService.php'),
        ], 'button');

        $this->publishes([
            __DIR__.'/../app/Services/AlertCvaService.php' => app_path('Services/AlertCvaService.php'),
        ], 'alert');

        $this->publishes([
            __DIR__.'/../app/Services/BadgeCvaService.php' => app_path('Services/BadgeCvaService.php'),
        ], 'badge');

        $this->publishes([
            __DIR__.'/../app/Services/DialogCvaService.php' => app_path('Services/DialogCvaService.php'),
        ], 'dialog');

        $this->publishes([
            __DIR__.'/../app/Services/DialogCvaService.php' => app_path('Services/DialogCvaService.php'),
        ], 'sheet');

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

        $this->publishes([
            __DIR__.'/../resources/js/plugins/tooltip.js' => resource_path('js/plugins/tooltip.js'),
        ], 'tooltip');

        // tailwind / css
        $this->publishes([
            __DIR__.'/../tailwind.config.js' => base_path('tailwind.config.js'),
        ], 'tailwind');

        $this->publishes([
            __DIR__.'/../resources/css/luvi-ui.css' => resource_path('css/luvi-ui.css'),
        ], 'css');

    }
}
