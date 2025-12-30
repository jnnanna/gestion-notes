<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    public function run(): void
    {
        $deptInfo = Departement::where('code', 'INFO')->first();
        $deptMath = Departement::where('code', 'MATH')->first();
        $deptPhys = Departement:: where('code', 'PHYS')->first();

        $chefFiliere = User::role('chef-filiere')->first();

        $filieres = [
            // Informatique
            [
                'code' => 'GL',
                'nom' => 'Génie Logiciel',
                'description' => 'Formation en développement logiciel et ingénierie des systèmes',
                'niveau' => 'Licence 3',
                'departement_id' => $deptInfo?->id,
                'chef_id' => $chefFiliere?->id,
                'actif' => true,
            ],
            [
                'code' => 'BD',
                'nom' => 'Big Data & Intelligence Artificielle',
                'description' => 'Science des données et apprentissage automatique',
                'niveau' => 'Master 1',
                'departement_id' => $deptInfo?->id,
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'RT',
                'nom' => 'Réseaux & Télécommunications',
                'description' => 'Infrastructure réseau et systèmes de communication',
                'niveau' => 'Licence 3',
                'departement_id' => $deptInfo?->id,
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'SE',
                'nom' => 'Systèmes Embarqués',
                'description' => 'Informatique embarquée et IoT',
                'niveau' => 'Master 2',
                'departement_id' => $deptInfo?->id,
                'chef_id' => null,
                'actif' => true,
            ],

            // Mathématiques
            [
                'code' => 'MA',
                'nom' => 'Mathématiques Appliquées',
                'description' => 'Modélisation mathématique et calcul scientifique',
                'niveau' => 'Licence 2',
                'departement_id' => $deptMath?->id,
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'STAT',
                'nom' => 'Statistiques & Data Science',
                'description' => 'Analyse statistique et science des données',
                'niveau' => 'Master 1',
                'departement_id' => $deptMath?->id,
                'chef_id' => null,
                'actif' => true,
            ],

            // Physique
            [
                'code' => 'PH',
                'nom' => 'Physique Fondamentale',
                'description' => 'Mécanique quantique et physique des particules',
                'niveau' => 'Master 2',
                'departement_id' => $deptPhys?->id,
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'PM',
                'nom' => 'Physique des Matériaux',
                'description' => 'Science des matériaux et nanotechnologies',
                'niveau' => 'Licence 3',
                'departement_id' => $deptPhys?->id,
                'chef_id' => null,
                'actif' => true,
            ],
        ];

        foreach ($filieres as $filiere) {
            Filiere::create($filiere);
        }
    }
}