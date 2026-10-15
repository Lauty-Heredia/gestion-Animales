<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;
use Illuminate\Support\Facades\DB;
use App\Exceptions\AnimalNotFoundException; // Asegúrate de que esta ruta sea correcta

class SQLAnimalService implements AnimalServiceInterface
{
   public function all(): array
    {
        $rows = DB::select('SELECT id, nombre, especie, edad FROM animals');

        $result = [];
        foreach ($rows as $row) {
            // Forzamos que la clave del array sea el ID real de la base de datos
            $result[$row->id] = (array) $row;
        }

        return $result;
    }

    public function find(string $id): ?array
    {
        $row = DB::select('SELECT id, nombre, especie, edad FROM animals WHERE id = ?', [$id]);

        if (empty($row)) {
            throw AnimalNotFoundException::forId($id);
        }

        // Retornamos el primer elemento casteado a array
        return (array) $row[0]; 
    }

    public function create(array $data): array
    {
        DB::insert(
            'INSERT INTO animals (nombre, especie, edad) VALUES (?,?,?)',
            [$data['nombre'], $data['especie'], $data['edad']]
        );

        $id = DB::getPdo()->lastInsertId();
        
        return $this->find((string) $id);
    }

    public function update(string $id, array $data): array
    {
        $this->find($id); // Valida que exista

        DB::update(
            'UPDATE animals SET nombre = ?, especie = ?, edad = ? WHERE id = ?',
            [$data['nombre'], $data['especie'], $data['edad'], $id]
        );

        return $this->find($id);
    }

    public function delete(string $id): bool
    {
        $this->find($id); // Valida que exista y lanza excepción si no

        $affected = DB::delete('DELETE FROM animals WHERE id = ?', [$id]);

        return $affected > 0;
    }

    public function reset(): void
    {
        DB::statement('DELETE FROM animals');
        DB::statement('DELETE FROM sqlite_sequence WHERE name = "animals"');
    }
}