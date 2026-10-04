<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
//importamos el contrato 
use App\Contracts\AnimalServiceInterface;
//importamos el servicio de archivos planos 
use App\Services\SQLAnimalService;
// \App\Services\SessionAnimalService;

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

        //vinculamos la clase con la interfaz 
        $this->app->bind(
           AnimalServiceInterface::class,
           SQLAnimalService::class
           
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
