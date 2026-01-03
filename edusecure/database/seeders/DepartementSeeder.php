<?php

namespace Database\Seeders;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    public function run(): void
    {
        $chefDept = User::role('chef-departement')->first();

        $departements = [
            [
                'code' => 'INFO',
                'nom' => 'Département Informatique',
                'description' => 'Sciences du numérique et technologies de l\'information',
                'chef_id' => $chefDept?->id,
                'actif' => true,
            ],
            [
                'code' => 'MATH',
                'nom' => 'Département Mathématiques',
                'description' => 'Mathématiques pures et appliquées',
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'PHYS',
                'nom' => 'Département Physique',
                'description' => 'Physique fondamentale et sciences de la matière',
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'CHIM',
                'nom' => 'Département Chimie',
                'description' => 'Chimie organique, inorganique et analytique',
                'chef_id' => null,
                'actif' => true,
            ],
            [
                'code' => 'BIO',
                'nom' => 'Département Biologie',
                'description' => 'Sciences de la vie et biotechnologies',
                'chef_id' => null,
                'actif' => true,
            ],
        ];

        foreach ($departements as $dept) {
            Departement::create($dept);
        }
    }
}