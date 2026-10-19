<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpeciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = [
            ['name' => 'Perro'],
            ['name' => 'Gato'],
            ['name' => 'Loro'],
            ['name' => 'Hámster'],
            ['name' => 'Tortuga'],
            ['name' => 'Conejo'],
            ['name' => 'Pez Dorado'],
            ['name' => 'Iguana'],
            ['name' => 'Canario'],
            ['name' => 'Caballo'],
        ];

        // Sembrar la tabla usando DB Facade
        DB::table('species')->insert($species);
    }
}