<?php

namespace App\Services;

use App\Contracts\SpeciesServiceInterface;
use Illuminate\Support\Facades\DB;

class SQLSpeciesService implements SpeciesServiceInterface
{
    protected string $table ='species';

    public function all(): array
    {
        $species=DB::table('species')
        ->get()//devuelve un coleccion de objetos stdclass
        ->map(fn($item) => (array) $item)//lo castea 
        ->toArray();

        return $species;
    }

    public function find(string $id): ?array
    {
      $item =DB::table($this->table)
      ->where('id',$id)
      ->first();

    //se castea  el objeto stdClass a un arreglo asociativo
      return $item ?(array) $item :null;

    }

    public function create(array $data): array
    {
        //inserta y retorna el id 
       $id = DB::table('species')->insertGetId([
      'name' => $data['name'],
        ]);

        //se guardan los datos y retorna un array 
        return $this->find($id);
    }

    public function update(string $id, array $data): ?array
    {

        DB::table('species')
        ->where('id', $id)
        ->update([
        'name' => $data['name'],
        ]);

        //se actulaliza y retorna un array
        return $this->find($id);
    }

    public function delete(string $id): bool
    {
        // Asegura existencia o lanza excepción:
        $this->find($id);

        $deleted = DB::table('species')
        ->where('id', $id)
        ->delete();

        return $deleted > 0; 
    }

    public function reset(): void
    {
        DB::table($this->table)->delete();
        // Reiniciar el puntero autoincremental de SQLite
        DB::statement( "DELETE FROM sqlite_sequence WHERE name = '{$this->table}'");

        $now = now();
        DB::table($this->table)->insert([
        ['name' => 'Perro'],
        ['name' => 'Gato' ],
        ['name' => 'Loro' ],
        ]);

    }
}
