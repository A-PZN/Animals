<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface; 
use Illuminate\Support\Facades\Storage;


class FileAnimalService implements AnimalServiceInterface
{
    //Nombre del archivo que se gurdara dentro de storege/app/
    private string $archJson = 'animals.json';

    //Metodos Privados 

    //Lee  decodifica el archivo json desde el disco.
    private function getAnimal() : array {

        if (!Storage:: disk('local')->exists($this->archJson)){
            return[];
        } 

       $json = Storage::disk('local')->get($this->archJson); 
       $data= json_decode($json,true)?? [];
     
      return array_values($data);
    }

    //Guarda el arrglo de animales en el archivo json.
    private function saveAnimal(array $animal):void 
    {
        $json = json_encode(array_values($animal),JSON_PRETTY_PRINT);
        Storage::disk('local')->put($this->archJson,$json);

    }
    //Buscar la poscion de un animal pos su id,Si no existe lanza un excepción.
    private function buscar_pos(int|string $id, array $animales): int
    {
         $key = array_search($id, array_column($animales, 'id')); 

        // Si key es false no lo encontro lanza la excepción.
        if ($key === false) 
        {
             throw new \Exception("El animal con id {$id} no se encuentra.");
             
        }
        //Si no reorna la posición.
        return $key;
    }

    //Metodos Publicos.

    //Retorna los animales registrados.
    public function all(): array{
        return $this->getAnimal();
    }

    //Busca el animal por id o lanza un excepción si no lo enuntra.
    public function find(int|string $id): array
    {
        $animals= $this->getAnimal();
        // Busca la posición real dentro del arreglo donde el id coincida.
        $key = $this->buscar_pos($id,$animals);
         return $animals[$key];
    }

    //Registra un nuevo animal calcualno su id. 
    public function create( array $dato ): array{
        $animals = $this->getAnimal();
     

        //Extrae solo los ids numericos actules.
        $ids = array_column($animals, 'id');

         // Si el arreglo está vacío arranca en 1; si no, toma el valor máximo y le suma 1 
        $newId = empty($ids) ? 1 : max($ids) + 1;
        
        //Une el id generado con los datos del formulario.
        $nuevoAnimal = array_merge(['id'=>$newId], $dato);
        $animals[]= $nuevoAnimal;

        //Guarda y retorna.
        $this->saveAnimal($animals);
        return $nuevoAnimal;
    }

    //Actuliza los datos de un animal existente por su id.
    public function update(string $id, array $data): bool
    { 
        $animals = $this->getAnimal();
        // Busca la posición real dentro del arreglo donde el id coincida.
        $key = $this->buscar_pos($id,$animals);

        //Si existe lo modifica 
        $animals[$key]=array_merge($animals[$key],$data);

        $this->saveAnimal($animals);
        return true;
       
    }
    //Elimina un animal del archivo mediante su id.
    public function  delete (int|string $id): bool {

        $animals = $this->getAnimal();
        // Busca la posición real dentro del arreglo donde el id coincida.
        $key = $this->buscar_pos($id,$animals);

        //Elimina en esa poscion.
        unset($animals[$key]);

        $this->saveAnimal($animals);
        return true;
        
    }

    //Limpia los datos sobrescibiendo.

    public function reset():void{
      $this->saveAnimal([]);
    }
    

}