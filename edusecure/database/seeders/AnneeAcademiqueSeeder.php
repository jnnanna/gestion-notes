<?php

namespace Database\Seeders;

use App\Models\AnneeAcademique;
use Illuminate\Database\Seeder;

class AnneeAcademiqueSeeder extends Seeder
{
    public function run(): void
    {
        $annees = [
            [
                'code' => '2022-2023',
                'libelle' => 'Année Académique 2022-2023',
                'date_debut' => '2022-09-01',
                'date_fin' => '2023-06-30',
                'actif' => false,
            ],
            [
                'code' => '2023-2024',
                'libelle' => 'Année Académique 2023-2024',
                'date_debut' => '2023-09-01',
                'date_fin' => '2024-06-30',
                'actif' => true, // Année courante
            ],
            [
                'code' => '2024-2025',
                'libelle' => 'Année Académique 2024-2025',
                'date_debut' => '2024-09-01',
                'date_fin' => '2025-06-30',
                'actif' => false,
            ],
        ];

        foreach ($annees as $annee) {
            AnneeAcademique::create($annee);
        }
    }
}