<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = [
            [
                'matricule' => '2023-0492',
                'first_name' => 'Alice',
                'last_name' => 'Lemoine',
                'email' => 'alice.lemoine@student.edu',
                'filiere_id' => 1,
                'promotion_year' => 2023,
                'group' => 'Groupe A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => '2023-0105',
                'first_name' => 'Bastien',
                'last_name' => 'Girard',
                'email' => 'bastien.girard@student.edu',
                'filiere_id' => 1,
                'promotion_year' => 2023,
                'group' => 'Groupe A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => '2023-0881',
                'first_name' => 'Chloé',
                'last_name' => 'Rousseau',
                'email' => 'chloe.rousseau@student.edu',
                'filiere_id' => 1,
                'promotion_year' => 2023,
                'group' => 'Groupe B',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'matricule' => '2023-CS-482',
                'first_name' => 'Jean',
                'last_name' => 'Dupont',
                'email' => 'jean.dupont.student@student.edu',
                'filiere_id' => 1,
                'promotion_year' => 2023,
                'group' => 'Groupe A',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        // Ajouter plus d'étudiants pour atteindre 240 (comme dans les maquettes)
        // On commence à 1000 pour éviter les conflits avec les matricules déjà définis
        for ($i = 1000; $i <= 1236; $i++) {
            $students[] = [
                'matricule' => '2023-' . str_pad($i, 4, '0', STR_PAD_LEFT),
                'first_name' => 'Étudiant' . ($i - 995),
                'last_name' => 'Test' . ($i - 995),
                'email' => "etudiant" . ($i - 995) . "@student.edu",
                'filiere_id' => rand(1, 4),
                'promotion_year' => 2023,
                'group' => ['Groupe A', 'Groupe B'][rand(0, 1)],
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('students')->insert($students);
    }
}
