<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Contracts\SpeciesServiceInterface;
use App\Contracts\AnimalServiceInterface;
use App\Services\SQLSpeciesService;
use App\Services\SQLAnimalService;

//clase 9 use App\Services\SpeciesMockService;




class AppServiceProvider extends ServiceProvider

{
    /**
     * Register any application services.
     */
    public function register(): void

    {
        // $this->app->bind(
        // AnimalServiceInterface::class,
        // SessionAnimalService::class);
        $this->app->bind(
            AnimalServiceInterface::class, 
            SQLAnimalService::class
            );

        // Vinculamos la interfaz al Mock como singleton:
        $this->app->singleton(SpeciesServiceInterface::class, SQLSpeciesService::class);
    }

    /**
     * Bootstrap any application services.
     */
   
    public function boot(): void
{
    // Esta línea es la clave: le dice a Laravel qué carpeta usar para componentes
    $this->loadViewsFrom(base_path('resources/views/components'), 'components');
}
}
