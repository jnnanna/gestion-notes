<?php

namespace Database\Seeders;

use App\Models\Semestre;
use Illuminate\Database\Seeder;

class SemestreSeeder extends Seeder
{
    public function run(): void
    {
        $semestres = [
            ['code' => 'S1', 'nom' => 'Semestre 1', 'ordre' => 1],
            ['code' => 'S2', 'nom' => 'Semestre 2', 'ordre' => 2],
            ['code' => 'S3', 'nom' => 'Semestre 3', 'ordre' => 3],
            ['code' => 'S4', 'nom' => 'Semestre 4', 'ordre' => 4],
            ['code' => 'S5', 'nom' => 'Semestre 5', 'ordre' => 5],
            ['code' => 'S6', 'nom' => 'Semestre 6', 'ordre' => 6],
        ];

        foreach ($semestres as $semestre) {
            Semestre::create($semestre);
        }
    }
}