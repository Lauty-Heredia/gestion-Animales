<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;

class SQLSpeciesService implements SpeciesServiceInterface
{
    /**
     * Obtiene todas las especies.
     */
    public function all(): array
    {
        $species = DB::select('SELECT * FROM species');
        
        // DB::select devuelve un arreglo de objetos (stdClass). 
        // Lo mapeamos para cumplir estrictamente con el tipo de retorno ': array' 
        // que espera un arreglo de arreglos.
        return array_map(fn($item) => (array) $item, $species);
    }

    /**
     * Encuentra una especie por su ID.
     */
    public function find(string $id): array
    {
        $species = DB::select('SELECT * FROM species WHERE id = ? LIMIT 1', [$id]);
        
        return !empty($species) ? (array) $species[0] : [];
    }

    /**
     * Crea una nueva especie.
     */
    public function create(array $data): array
    {
        DB::insert('INSERT INTO species (name) VALUES (?)', [$data['name']]);
        
        // Obtenemos el ID del último registro insertado para devolverlo
        $id = DB::getPdo()->lastInsertId();
        
        return $this->find((string) $id);
    }

    /**
     * Actualiza una especie existente.
     */
    public function update(string $id, array $data): array
    {
        DB::update('UPDATE species SET name = ? WHERE id = ?', [$data['name'], $id]);
        
        return $this->find($id);
    }

    /**
     * Elimina una especie por su ID.
     */
    public function delete(string $id): bool
    {
        $deleted = DB::delete('DELETE FROM species WHERE id = ?', [$id]);
        
        // Si $deleted es mayor a 0, significa que se eliminó al menos una fila.
        return $deleted > 0;
    }

    /**
     * Resetea la tabla de especies.
     * Aunque no está en la interfaz, se requiere en la clase principal.
     */
    public function reset(): void
    {
        // TRUNCATE vacía la tabla y reinicia el id autoincremental (ideal para PostgreSQL o MySQL).
        // Si tu entorno local de pruebas está utilizando SQLite, el comando TRUNCATE no funcionará, 
        // en ese caso deberías reemplazarlo por: DB::delete('DELETE FROM species');
        DB::statement('TRUNCATE TABLE species');
    }
}