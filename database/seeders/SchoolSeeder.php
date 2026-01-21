<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        School::create([
            'id' => 1,
            'name' => 'Colégio Itaqua',
        ]);

        School::create([
            'id' => 2,
            'name' => 'Liceu Itaqua',
        ]);
        School::create([
            'id' => 3,
            'name' => 'Liceu Suzano',
        ]);
        School::create([
            'id' => 4,
            'name' => 'Liceu Aruja',
        ]);

        School::create([
            'id' => 5,
            'name' => 'Colegio Doremi',
        ]);
        School::create([
            'id' => 6,
            'name' => 'Colegio Pequeno Principe',
        ]);

        School::create([
            'id' => 7,
            'name' => 'Fisk Itaqua',
        ]);
        School::create([
            'id' => 8,
            'name' => 'Fisk Suzano',
        ]);
    }
}
