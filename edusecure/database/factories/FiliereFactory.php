<?php

namespace Database\Factories;

use App\Models\Departement;
use App\Models\Filiere;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class FiliereFactory extends Factory
{
    protected $model = Filiere::class;

    public function definition(): array
    {
        $niveaux = ['Licence 1', 'Licence 2', 'Licence 3', 'Master 1', 'Master 2'];

        return [
            'code' => strtoupper($this->faker->unique()->lexify('??? -??')),
            'nom' => $this->faker->words(3, true),
            'description' => $this->faker->sentence(),
            'niveau' => $this->faker->randomElement($niveaux),
            'departement_id' => Departement::factory(),
            'chef_id' => null,
            'actif' => true,
        ];
    }
}