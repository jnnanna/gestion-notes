<?php

namespace Database\Factories;

use App\Models\Departement;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartementFactory extends Factory
{
    protected $model = Departement::class;

    public function definition(): array
    {
        $departements = [
            ['code' => 'INFO', 'nom' => 'Département Informatique', 'desc' => 'Sciences du numérique et technologies de l\'information'],
            ['code' => 'MATH', 'nom' => 'Département Mathématiques', 'desc' => 'Mathématiques pures et appliquées'],
            ['code' => 'PHYS', 'nom' => 'Département Physique', 'desc' => 'Physique fondamentale et sciences de la matière'],
            ['code' => 'CHIM', 'nom' => 'Département Chimie', 'desc' => 'Chimie organique, inorganique et analytique'],
            ['code' => 'BIO', 'nom' => 'Département Biologie', 'desc' => 'Sciences de la vie et biotechnologies'],
        ];

        static $index = 0;
        $dept = $departements[$index % count($departements)];
        $index++;

        return [
            'code' => $dept['code'],
            'nom' => $dept['nom'],
            'description' => $dept['desc'],
            'chef_id' => null, // À assigner manuellement
            'actif' => true,
        ];
    }
}