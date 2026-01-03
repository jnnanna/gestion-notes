<?php

namespace Database\Factories;

use App\Models\Filiere;
use App\Models\Module;
use App\Models\Semestre;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ModuleFactory extends Factory
{
    protected $model = Module::class;

    public function definition(): array
    {
        return [
            'code' => strtoupper($this->faker->unique()->lexify('???-??? ')),
            'nom' => $this->faker->words(4, true),
            'description' => $this->faker->sentence(),
            'filiere_id' => Filiere::factory(),
            'semestre_id' => Semestre:: inRandomOrder()->first()?->id ??  1,
            'responsable_id' => null,
            'coefficient' => $this->faker->numberBetween(1, 5),
            'credit_ects' => $this->faker->randomFloat(2, 1, 10),
            'actif' => true,
        ];
    }
}