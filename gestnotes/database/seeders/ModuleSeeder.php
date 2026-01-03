<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            [
                'code' => 'INF-101',
                'name' => 'Algorithmique I',
                'filiere_id' => 1, // Génie Informatique
                'semester' => 'S1',
                'coefficient' => 4,
                'ects' => 5,
                'responsible_user_id' => 3, // Pr. Benali (représenté par Sarah Connor)
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'INF-204',
                'name' => 'Bases de Données',
                'filiere_id' => 2, // Génie Logiciel
                'semester' => 'S3',
                'coefficient' => 4,
                'ects' => 6,
                'responsible_user_id' => 3, // Pr. Mansouri
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'CS-101',
                'name' => 'Computer Science 101',
                'filiere_id' => 1,
                'semester' => 'S1',
                'coefficient' => 3,
                'ects' => 4,
                'responsible_user_id' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'INF-301',
                'name' => 'Algorithmique Avancée',
                'filiere_id' => 1,
                'semester' => 'S5',
                'coefficient' => 4,
                'ects' => 6,
                'responsible_user_id' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'INF-302',
                'name' => 'Bases de Données Relationnelles',
                'filiere_id' => 2,
                'semester' => 'S5',
                'coefficient' => 4,
                'ects' => 6,
                'responsible_user_id' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MAT-205',
                'name' => 'Probabilités et Statistiques',
                'filiere_id' => 5, // Maths
                'semester' => 'S3',
                'coefficient' => 3,
                'ects' => 5,
                'responsible_user_id' => 4, // John Doe
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'ANG-101',
                'name' => 'Anglais Technique',
                'filiere_id' => 1,
                'semester' => 'S1',
                'coefficient' => 2,
                'ects' => 2,
                'responsible_user_id' => 3,
                'status' => 'archived',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PROJ-30',
                'name' => 'Projet Tutoré',
                'filiere_id' => 1,
                'semester' => 'S5',
                'coefficient' => 5,
                'ects' => 8,
                'responsible_user_id' => 3,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MGT-301',
                'name' => 'Management de Projet',
                'filiere_id' => 1,
                'semester' => 'S5',
                'coefficient' => 3,
                'ects' => 4,
                'responsible_user_id' => null, // Non assigné (comme dans la maquette)
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'MA',
                'name' => 'Mathématiques Avancées',
                'filiere_id' => 5,
                'semester' => 'S3',
                'coefficient' => 4,
                'ects' => 6,
                'responsible_user_id' => 4,
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'code' => 'PH',
                'name' => 'Physique Quantique',
                'filiere_id' => 6,
                'semester' => 'S1',
                'coefficient' => 4,
                'ects' => 6,
                'responsible_user_id' => 5, // Albert Einstein
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('modules')->insert($modules);
    }
}
