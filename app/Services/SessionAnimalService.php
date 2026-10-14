<?php

namespace App\Services;

use App\Contracts\AnimalServiceInterface;

class SessionAnimalService implements AnimalServiceInterface
{
    public function all(): array
    {
        return session('animales', []);
    }

    public function find(string $id): ?array
    {
        $animales = session('animales', []);
        return $animales[$id] ?? null;
    }

    public function create(array $data): string
    {
        $animales = session('animales', []);
        $nuevoId = count($animales) > 0 ? max(array_keys($animales)) + 1 : 1;
        $animales[$nuevoId] = $data;
        session(['animales' => $animales]);
        return (string)$nuevoId;
    }

    public function update(string $id, array $data): bool
    {
        $animales = session('animales', []);
        if (isset($animales[$id])) {
            $animales[$id] = $data;
            session(['animales' => $animales]);
            return true;
        }
        return false;
    }

    public function delete(string $id): bool
    {
        $animales = session('animales', []);
        if (isset($animales[$id])) {
            unset($animales[$id]);
            session(['animales' => $animales]);
            return true;
        }
        return false;
    }

    public function reset(): void
    {
        session()->forget('animales');
    }
}
