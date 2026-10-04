<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void

    {
        $species =[
            ['name'=>'Léon'],
            ['name'=> 'Elefante'],
            ['name'=> 'Pez Payaso'],
            ['name'=> 'Gato'],
            ['name'=> 'Perro'],
            ['name'=> 'Conejo '],
            ['name'=> 'Caballo'],
            ['name'=> 'Oso'],
            ['name'=> 'Ave'],
            ['name'=> 'Tortuga']
        ];

    foreach ($species as $spe){

            DB::insert(
                'INSERT INTO  species(name) VALUES(?)',
                [
                    $spe['name'],
                ]
            );
        }
    }
}
