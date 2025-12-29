<?php

namespace Database\Factories;

use App\Enums\StatutNote;
use App\Models\Etudiant;
use App\Models\Module;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

class NoteFactory extends Factory
{
    protected $model = Note::class;

    public function definition(): array
    {
        $noteExamen = $this->faker->randomFloat(2, 0, 20);
        $noteCC = $this->faker->randomFloat(2, 0, 20);
        $notTP = $this->faker->optional()->randomFloat(2, 0, 20);

        $notes = collect([$noteExamen, $noteCC, $notTP])->filter();
        $moyenne = round($notes->avg(), 2);

        return [
            'etudiant_id' => Etudiant::factory(),
            'module_id' => Module::factory(),
            'feuille_note_id' => null,
            'note_examen' => $noteExamen,
            'note_cc' => $noteCC,
            'note_tp' => $notTP,
            'moyenne' => $moyenne,
            'statut' => $this->faker->randomElement(StatutNote::cases()),
            'commentaire' => $this->faker->optional()->sentence(),
        ];
    }
}