<?php

namespace Database\Seeders;

use App\Models\Filiere;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    public function run(): void
    {
        $filiereGL = Filiere::where('code', 'GL')->first();
        $filiereBD = Filiere:: where('code', 'BD')->first();
        
        $enseignants = User::role('enseignant')->get();

        $modules = [
            // Génie Logiciel - S5
            [
                'code' => 'INF-301',
                'nom' => 'Algorithmique Avancée',
                'description' => 'Structures de données complexes et algorithmes',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 4,
                'credit_ects' => 6,
                'actif' => true,
            ],
            [
                'code' => 'INF-302',
                'nom' => 'Bases de Données Relationnelles',
                'description' => 'SQL, normalisation et optimisation',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 4,
                'credit_ects' => 6,
                'actif' => true,
            ],
            [
                'code' => 'INF-303',
                'nom' => 'Génie Logiciel',
                'description' => 'UML, design patterns et méthodologies agiles',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 3,
                'credit_ects' => 5,
                'actif' => true,
            ],
            [
                'code' => 'INF-304',
                'nom' => 'Développement Web',
                'description' => 'HTML, CSS, JavaScript, PHP et frameworks',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 3,
                'credit_ects' => 5,
                'actif' => true,
            ],
            [
                'code' => 'MAT-201',
                'nom' => 'Probabilités et Statistiques',
                'description' => 'Théorie des probabilités et statistiques descriptives',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 2,
                'credit_ects' => 4,
                'actif' => true,
            ],
            [
                'code' => 'ANG-101',
                'nom' => 'Anglais Technique',
                'description' => 'Communication professionnelle en anglais',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 5,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 2,
                'credit_ects' => 3,
                'actif' => true,
            ],

            // Génie Logiciel - S6
            [
                'code' => 'INF-401',
                'nom' => 'Architecture Logicielle',
                'description' => 'Architectures distribuées et microservices',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 6,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 4,
                'credit_ects' => 6,
                'actif' => true,
            ],
            [
                'code' => 'INF-402',
                'nom' => 'Développement Mobile',
                'description' => 'Applications Android et iOS',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 6,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 3,
                'credit_ects' => 5,
                'actif' => true,
            ],
            [
                'code' => 'INF-403',
                'nom' => 'Sécurité Informatique',
                'description' => 'Cryptographie et sécurité des systèmes',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 6,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 3,
                'credit_ects' => 5,
                'actif' => true,
            ],
            [
                'code' => 'PROJ-301',
                'nom' => 'Projet Tutoré',
                'description' => 'Projet de développement en équipe',
                'filiere_id' => $filiereGL?->id,
                'semestre_id' => 6,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 5,
                'credit_ects' => 8,
                'actif' => true,
            ],

            // Big Data - S1 (Master)
            [
                'code' => 'BD-501',
                'nom' => 'Introduction au Big Data',
                'description' => 'Écosystème Hadoop et technologies NoSQL',
                'filiere_id' => $filiereBD?->id,
                'semestre_id' => 1,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 4,
                'credit_ects' => 6,
                'actif' => true,
            ],
            [
                'code' => 'BD-502',
                'nom' => 'Machine Learning',
                'description' => 'Apprentissage supervisé et non supervisé',
                'filiere_id' => $filiereBD?->id,
                'semestre_id' => 1,
                'responsable_id' => $enseignants->random()->id,
                'coefficient' => 5,
                'credit_ects' => 7,
                'actif' => true,
            ],
        ];

        foreach ($modules as $module) {
            Module::create($module);
        }
    }
}