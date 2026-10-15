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
    public function run(): void
    {
        $animales = [
            ['Nombre' => 'Max', 'Especie' => 'Perro', 'Edad' => 5],
            ['Nombre' => 'Whiskers', 'Especie' => 'Gato', 'Edad' => 3],
            ['Nombre' => 'Buddy', 'Especie' => 'Perro', 'Edad' => 2],
            ['Nombre' => 'Mittens', 'Especie' => 'Gato', 'Edad' => 4],
            ['Nombre' => 'Charlie', 'Especie' => 'Perro', 'Edad' => 1],
        ];

        foreach ($animales as $animal) {
            DB::insert(
                'INSERT INTO animals (nombre, especie, edad) VALUES (?,?,?)',
                [
                    $animal['Nombre'],
                    $animal['Especie'],
                    $animal['Edad']
                ]
            );
        }

    }
}
