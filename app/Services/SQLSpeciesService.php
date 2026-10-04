<?php

namespace App\Services;

use App\Contracts\SpeciesServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Exceptions\AnimalNotFoundException;

class SQLSpeciesService implements SpeciesServiceInterface
{

    public function all(): array
    {
        $rows = DB::select('SELECT id, name FROM species');

        $result = array_map(function ($row) {
            return (array) $row;
        }, $rows);

        return $result;
    }

    public function find(string $id): array
    {
        $row = DB::selectOne('SELECT id, name  FROM species WHERE id = ?', [$id]);

        if (!$row) {
            AnimalNotFoundException::forId($id);
        }

        return (array) $row;
    }

    public function create(array $data): array
    {
        DB::insert( 'INSERT INTO species (name) VALUES (?)',[$data['name']]);

        $id = DB::getPdo()->lastInsertId();

        return $this->find($id);
    }

    public function update(string $id, array $data): array
    {
        // 1. Verificación previa (falla rápido con 404):
        $this->find($id);

        // 2. Sentencia SQL con los nuevos datos:
        DB::update( 'UPDATE species SET name = ?  WHERE id = ?',
            [
                $data['name'],
                $id
            ]
        );

        return $this->find($id);
    }

    public function delete(string $id): bool
    {
        // Asegura existencia o lanza excepción:
        $this->find($id);

        $affected = DB::delete(
            'DELETE FROM species WHERE id = ?',
            [$id]
        );

        return $affected > 0;
    }

    public function reset(): void
    {
        DB::statement('DELETE FROM species');
        // Reiniciar el puntero autoincremental de SQLite
        DB::statement( "DELETE FROM sqlite_sequence WHERE name = 'species'");
    }
}
