<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;
use Illuminate\Support\Facades\Storage;
use Exception;

class FileAnimalService implements AnimalServiceInterface
{
    public function getAnimals(): array
    {
        // Verifica si el archivo existe en el disco local
        if (!Storage::disk('local')->exists('animals.json')) {
            return []; // Retorna un array vacío si no existe
        }

        // Obtiene el contenido del archivo
        $json = Storage::disk('local')->get('animals.json');
        
        // Lo decodifica a un array asociativo
        // El ?? [] asegura que si el archivo está vacío o es inválido, no falle
        return json_decode($json, true) ?? [];
    }
    
    public function saveAnimals(array $animals): void
    {
        // Convierte el array de animales a JSON
        $json = json_encode($animals, JSON_PRETTY_PRINT);
        
        // Guarda el JSON en el archivo animals.json en el disco local
        Storage::disk('local')->put('animals.json', $json);
    }

    public function all(): array
    {
        // Retorna todos los animales leídos del archivo
        return $this->getAnimals();
    }

    public function find(string $id): ?array
    {
        $animals = $this->getAnimals();

        if (isset($animals[$id])) {
            return $animals[$id];
        }

        // Cumple con la exigencia del PDF de lanzar excepción
        throw new Exception("El animal con ID {$id} no fue encontrado.");
    }

    public function create(array $data): string
    {
        $animals = $this->getAnimals();
        
        // Calcula el ID usando las claves, igual que en SessionAnimalService
        $newId = count($animals) > 0 ? max(array_keys($animals)) + 1 : 1;
        
        // Forzamos el ID dentro de los datos para respetar la estructura visual del PDF[cite: 3]
        $data['id'] = $newId;
        
        // Guardamos el animal usando el ID como clave principal del array
        $animals[$newId] = $data;
        
        $this->saveAnimals($animals);
        
        return (string)$newId;
    }

    public function delete(string $id): bool
    {
        $animals = $this->getAnimals();

        if (!isset($animals[$id])) {
            // Cumple con la exigencia del PDF de lanzar excepción[cite: 2]
            throw new Exception("El animal con ID {$id} no fue encontrado.");
        }

        unset($animals[$id]);
        
        $this->saveAnimals($animals);

        return true;
    }

    public function update(string $id, array $data): bool
    {
        $animals = $this->getAnimals();

        if (!isset($animals[$id])) {
            throw new Exception("El animal con ID {$id} no fue encontrado.");
        }

        // Actualiza preservando datos anteriores que no vengan en $data
        $data['id'] = $animals[$id]['id']; // Protegemos el ID para que no se modifique
        $animals[$id] = array_merge($animals[$id], $data);
        
        $this->saveAnimals($animals);

        return true; // Retorna bool correctamente
    }

    public function reset(): void
    {
        // Limpia el archivo sobrescribiéndolo con un array vacío
        $this->saveAnimals([]);
    }
}
