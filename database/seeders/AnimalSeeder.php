<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnimalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    //se crea un metodo run que  muetra los  datos iniciales 
    public function run(): void
    {
        $animals = [
            ['name' => 'Milo', 'species' => 'Perro', 'age' => 5],
            ['name' => 'Luna', 'species' => 'Gato', 'age' => 2],
            ['name' => 'Paco', 'species' => 'Loro', 'age' => 12],
     ];

     //para cada ani
 foreach ($animals as $animal) {

    DB::insert(
 '      INSERT INTO animals (name, species, age) VALUES(?, ?, ?)',
            [
                $animal['name'],
                $animal['species'], 
                $animal['age']
                
            ]
        );
        }
        }
    }

