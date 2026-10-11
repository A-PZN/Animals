<?php

namespace Database\Seeders;

use App\Contracts\SpeciesServiceInterface;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SpeciesSeeder extends Seeder
{
    //se invoca la interfaz 
    protected SpeciesServiceInterface $speciesService;

    public function __construct(SpeciesServiceInterface $speciesService){
        $this->speciesService=$speciesService;
    }



    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $species =[
            ['name'=>'Léon'],
            ['name'=> 'Elefante'],
            ['name'=> 'Pez Payaso'],
        
        ];

        //para que se pueda insertar todaas las veces la miama cantidad de elmentos 
        //se llamara el rest del servicio 
        $this->speciesService->reset();
        
        foreach ($species as $spe){
            $this->speciesService->create($spe);

        }
    }
}
