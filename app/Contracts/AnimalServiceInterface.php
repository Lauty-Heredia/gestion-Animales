<?php

namespace App\Contracts;

interface AnimalServiceInterface
{
    public function all(): array;

    public function find(string $id): ?array;

    public function create(array $data): string;

    public function update(string $id, array $data): bool;

    public function delete(string $id): bool;

    public function reset(): void;
}
