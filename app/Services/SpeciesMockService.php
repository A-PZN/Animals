<?php
namespace App\Services;
use App\Contracts\SpeciesServiceInterface;
use App\Exceptions\SessionNotFoundException;


class SpeciesMockService implements SpeciesServiceInterface {

//es un metodo portegido la session nesesita una clave  ventaja lo modofoco en un solo lugar 
 protected string $sessionKey = 'species';
 /*protected array $defaultSpecies = [
    
    '1' => [ 'name' => 'Perro'],
    '2' =>  ['name' => 'Gato'],
    '3' =>  ['name' => 'Ave'],

 ];*/
 public function __construct() {
// cargar  
    if (!session()->has($this->sessionKey)) {
       $this->reset();
     }
    }

public function all(): array
 {
    return session()->get($this->sessionKey, []);
 }


 //recupera lo items y recorre los items y  convertirlo en coleecion nosda flexibilidad.
 public function find(string $id): ?array
 {
      $items = $this->all();
        if (!isset($items[$id])) {
            throw SessionNotFoundException::forId($id);
        }
        return $items[$id] ?? null;
 }


 public function create(array $data): array {
        $items = $this->all();
        $newId = uniqid();
        $items[$newId] = $data;

       session([$this->sessionKey => $items]);
       return ['id' => $newId] + $data;
 }

 public function update(string $id, array $data): ?array {

        $items = session($this->sessionKey, []);
        if (!isset($items[$id])) {
            throw new \Exception("El animal con ID \"$id\" no fue encontrado.");
        }
        $items[$id] = $data;
        session([$this->sessionKey => $items]);
        return ['id' => $id] + $data;
    }


 

public function delete(string $id): bool {
    $items = $this->all();
   
    $filtered = array_values(array_filter($items, fn($i) => $i['id']!== $id));
 if (count($filtered) !== count($items)) {
    session()->put($this->sessionKey, $filtered);
    return true;
 }
    return false;
}

public function reset(): void {
   session()->forget($this->sessionKey);
}

}