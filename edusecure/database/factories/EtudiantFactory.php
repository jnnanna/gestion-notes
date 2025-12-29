<?php

namespace Database\Factories;

use App\Models\Etudiant;
use App\Models\Filiere;
use Illuminate\Database\Eloquent\Factories\Factory;

class EtudiantFactory extends Factory
{
    protected $model = Etudiant::class;

    public function definition(): array
    {
        $niveaux = ['L1', 'L2', 'L3', 'M1', 'M2'];
        $groupes = ['A', 'B', 'C'];

        return [
            'matricule' => $this->faker->unique()->numerify('2023-####'),
            'nom' => $this->faker->lastName(),
            'prenom' => $this->faker->firstName(),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone' => $this->faker->phoneNumber(),
            'date_naissance' => $this->faker->date('Y-m-d', '-18 years'),
            'lieu_naissance' => $this->faker->city(),
            'filiere_id' => Filiere::factory(),
            'niveau' => $this->faker->randomElement($niveaux),
            'groupe' => $this->faker->randomElement($groupes),
            'photo_url' => null,
            'actif' => true,
        ];
    }
}