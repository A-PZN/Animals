<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use App\Contracts\SpeciesServiceInterface;
use App\Services\SQLSpeciesService;

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
           SpeciesServiceInterface::class,
           SQLSpeciesService::class

           
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
