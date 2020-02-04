<?php

namespace Kdion4891\LaravelLivewireForms\Providers;

use Illuminate\Support\ServiceProvider;
use Kdion4891\LaravelLivewireForms\Commands\MakeForm;

class FormServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([MakeForm::class]);
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laravel-livewire-forms');
        $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');

        $this->publishes([__DIR__ . '/../../config/laravel-livewire-forms.php' => config_path('laravel-livewire-forms.php')], 'form-config');
        $this->publishes([__DIR__ . '/../../resources/views' => resource_path('views/vendor/laravel-livewire-forms')], 'form-views');
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/laravel-livewire-forms.php', 'laravel-livewire-forms');
    }
}
