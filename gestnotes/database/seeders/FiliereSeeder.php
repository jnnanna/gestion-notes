<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            ['name' => 'Génie Informatique', 'code' => 'GI', 'department_id' => 1, 'level' => 'L3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Génie Logiciel', 'code' => 'GL', 'department_id' => 1, 'level' => 'L3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Big Data', 'code' => 'BD', 'department_id' => 1, 'level' => 'M1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Systèmes Embarqués', 'code' => 'SE', 'department_id' => 1, 'level' => 'L3', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Mathématiques Appliquées', 'code' => 'MA', 'department_id' => 2, 'level' => 'L2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Physique Quantique', 'code' => 'PQ', 'department_id' => 3, 'level' => 'M1', 'created_at' => now(), 'updated_at' => now()],
        ];

        DB::table('filieres')->insert($filieres);
    }
}
